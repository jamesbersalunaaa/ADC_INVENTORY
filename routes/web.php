<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\InventoryItem;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Invalid credentials');
    }

    Session::put('user_id', $user->id);
    Session::put('role', $user->role);

    AuditLog::create([
        'module' => 'Auth',
        'action' => 'Login',
        'description' => 'User logged in: ' . $user->email,
        'user_id' => $user->id,
        'user_name' => $user->email,
    ]);

    return $user->role === 'admin'
        ? redirect('/admin/dashboard')
        : redirect('/user/dashboard');
});

/*
|--------------------------------------------------------------------------
| USER INVENTORY
|--------------------------------------------------------------------------
*/

Route::get('/user/inventory', function (Request $request) {

    if (!Session::has('user_id')) {
        return redirect('/');
    }

    $query = InventoryItem::query();

    if ($request->search) {
        $query->where('item_description', 'like', '%' . $request->search . '%')
              ->orWhere('category', 'like', '%' . $request->search . '%');
    }

    if ($request->category) {
        $query->where('category', $request->category);
    }

    $perPage = $request->input('per_page', 10);

    $items = $query->orderBy('category')
        ->orderBy('item_description')
        ->paginate($perPage);

    $categories = InventoryItem::select('category')
        ->distinct()
        ->orderBy('category')
        ->pluck('category');

    return view('user.inventory', compact('items', 'categories'));
});

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', function () {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $items = InventoryItem::orderBy('category')
        ->orderBy('item_description')
        ->get();

    $totalItems = $items->count();
    $totalStock = $items->sum('quantity');
    $lowStock = $items->where('quantity', '<=', 5)->count();

    $totalValue = $items->sum(fn($item) => $item->quantity * $item->cost);

    $categoryLabels = $items->groupBy('category')->keys()->values();

    $categoryStocks = $items->groupBy('category')
        ->map(fn($group) => $group->sum('quantity'))
        ->values();

    return view('admin.dashboard', compact(
        'items',
        'totalItems',
        'totalStock',
        'lowStock',
        'totalValue',
        'categoryLabels',
        'categoryStocks'
    ));
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::get('/logout', function () {

    $user = User::find(Session::get('user_id'));

    if ($user) {
        AuditLog::create([
            'module' => 'Auth',
            'action' => 'Logout',
            'description' => 'User logged out: ' . $user->email,
            'user_id' => $user->id,
            'user_name' => $user->email,
        ]);
    }

    Session::flush();

    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| INVENTORY
|--------------------------------------------------------------------------
*/

Route::get('/admin/inventory', function (Request $request) {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $query = InventoryItem::query();

    if ($request->search) {
        $query->where('item_description', 'like', '%' . $request->search . '%');
    }

    if ($request->category) {
        $query->where('category', $request->category);
    }

    $perPage = $request->input('per_page', 10);

    $items = $query->orderBy('category')
        ->orderBy('item_description')
        ->paginate($perPage);

    $categories = InventoryItem::select('category')
        ->distinct()
        ->pluck('category');

    return view('admin.inventory', compact('items', 'categories'));
});

/*
|--------------------------------------------------------------------------
| ADD ITEM
|--------------------------------------------------------------------------
*/

Route::post('/admin/inventory/add', function (Request $request) {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $request->validate([
        'item_description' => 'required',
        'category' => 'required',
        'quantity' => 'required|numeric',
        'unit' => 'required',
        'cost' => 'required|numeric',
    ]);

    $item = InventoryItem::create([
        'item_description' => $request->item_description,
        'category' => $request->category,
        'quantity' => $request->quantity,
        'unit' => $request->unit,
        'cost' => $request->cost,
    ]);

    $user = User::find(Session::get('user_id'));

    AuditLog::create([
        'module' => 'Inventory',
        'action' => 'Add Item',
        'description' => 'Added item: ' . $item->item_description,
        'user_id' => $user->id ?? null,
        'user_name' => $user->email ?? 'Unknown',
    ]);

    return back()->with('success', 'Item added successfully');
});

/*
|--------------------------------------------------------------------------
| UPDATE ITEM
|--------------------------------------------------------------------------
*/

Route::post('/admin/inventory/update/{id}', function (Request $request, $id) {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $request->validate([
        'item_description' => 'required',
        'category' => 'required',
        'quantity' => 'required|numeric',
        'unit' => 'required',
        'cost' => 'required|numeric',
    ]);

    $item = InventoryItem::findOrFail($id);

    $oldName = $item->item_description;
    $oldQuantity = $item->quantity;
    $oldCost = $item->cost;

    $item->update([
        'item_description' => $request->item_description,
        'category' => $request->category,
        'quantity' => $request->quantity,
        'unit' => $request->unit,
        'cost' => $request->cost,
    ]);

    $user = User::find(Session::get('user_id'));

    AuditLog::create([
        'module' => 'Inventory',
        'action' => 'Edit Item',
        'description' => 'Updated item: ' . $oldName .
            ' | Quantity: ' . $oldQuantity .
            ' to ' . $item->quantity .
            ' | Cost: ' . $oldCost .
            ' to ' . $item->cost,
        'user_id' => $user->id ?? null,
        'user_name' => $user->email ?? 'Unknown',
    ]);

    return back()->with('success', 'Item updated successfully');
});

/*
|--------------------------------------------------------------------------
| DELETE ITEM
|--------------------------------------------------------------------------
*/

Route::post('/admin/inventory/delete/{id}', function ($id) {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $item = InventoryItem::findOrFail($id);

    $itemName = $item->item_description;
    $itemQuantity = $item->quantity;
    $itemUnit = $item->unit;

    $item->delete();

    $user = User::find(Session::get('user_id'));

    AuditLog::create([
        'module' => 'Inventory',
        'action' => 'Delete Item',
        'description' => 'Deleted item: ' . $itemName .
            ' | Last stock: ' . $itemQuantity . ' ' . $itemUnit,
        'user_id' => $user->id ?? null,
        'user_name' => $user->email ?? 'Unknown',
    ]);

    return back()->with('success', 'Item deleted');
});

/*
|--------------------------------------------------------------------------
| EXPORT PDF
|--------------------------------------------------------------------------
*/

Route::get('/admin/inventory/export/all', function () {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $items = InventoryItem::orderBy('category')
        ->orderBy('item_description')
        ->get();

    $pdf = Pdf::loadView('admin.inventory_pdf', [
        'items' => $items,
        'title' => 'All Inventory Items'
    ])->setPaper('a4', 'landscape');

    return $pdf->download('all_inventory_items.pdf');
});

Route::post('/admin/inventory/export/selected', function (Request $request) {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $request->validate([
        'selected_items' => 'required|array',
    ]);

    $items = InventoryItem::whereIn('id', $request->selected_items)
        ->orderBy('category')
        ->orderBy('item_description')
        ->get();

    $pdf = Pdf::loadView('admin.inventory_pdf', [
        'items' => $items,
        'title' => 'Selected Inventory Items'
    ])->setPaper('a4', 'landscape');

    return $pdf->download('selected_inventory_items.pdf');
});

/*
|--------------------------------------------------------------------------
| STOCK IN / OUT
|--------------------------------------------------------------------------
*/

Route::get('/admin/stockinout', function () {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $items = InventoryItem::orderBy('category')
        ->orderBy('item_description')
        ->get();

    $categories = InventoryItem::select('category')
        ->distinct()
        ->pluck('category');

    return view('admin.stockinout', compact('items', 'categories'));
});

Route::post('/admin/stockinout/update', function (Request $request) {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $request->validate([
        'item_id' => 'required|exists:inventory_items,id',
        'type' => 'required|in:in,out',
        'quantity' => 'required|numeric|min:1',
    ]);

    $item = InventoryItem::findOrFail($request->item_id);

    $previousQuantity = $item->quantity;

    if ($request->type === 'in') {

        $item->quantity += $request->quantity;

        $action = 'Stock In';

        $description = 'Added ' . $request->quantity .
            ' ' . $item->unit .
            ' to ' . $item->item_description;

    } else {

        if ($item->quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $item->quantity -= $request->quantity;

        $action = 'Stock Out';

        $description = 'Deducted ' . $request->quantity .
            ' ' . $item->unit .
            ' from ' . $item->item_description;
    }

    $item->save();

    $user = User::find(Session::get('user_id'));

    AuditLog::create([
        'module' => 'Stock',
        'action' => $action,
        'description' => $description .
            ' | Previous Stock: ' . $previousQuantity .
            ' | New Stock: ' . $item->quantity,
        'user_id' => $user->id ?? null,
        'user_name' => $user->email ?? 'Unknown',
    ]);

    return back()->with('success', 'Stock updated successfully');
});

/*
|--------------------------------------------------------------------------
| USERS MODULE
|--------------------------------------------------------------------------
*/

Route::get('/admin/users', function () {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $users = User::orderBy('role')
        ->orderBy('name')
        ->get();

    return view('admin.users', compact('users'));
});

Route::post('/admin/users/add', function (Request $request) {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,user',
    ]);

    $newUser = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    $user = User::find(Session::get('user_id'));

    AuditLog::create([
        'module' => 'Users',
        'action' => 'Add User',
        'description' => 'Added user: ' . $newUser->email,
        'user_id' => $user->id ?? null,
        'user_name' => $user->email ?? 'Unknown',
    ]);

    return back()->with('success', 'User added successfully');
});

Route::post('/admin/users/update/{id}', function (Request $request, $id) {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $targetUser = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $targetUser->id,
        'role' => 'required|in:admin,user',
        'password' => 'nullable|min:6',
    ]);

    $oldEmail = $targetUser->email;
    $oldRole = $targetUser->role;

    $targetUser->name = $request->name;
    $targetUser->email = $request->email;
    $targetUser->role = $request->role;

    if ($request->filled('password')) {
        $targetUser->password = Hash::make($request->password);
    }

    $targetUser->save();

    $user = User::find(Session::get('user_id'));

    AuditLog::create([
        'module' => 'Users',
        'action' => 'Edit User',
        'description' => 'Updated user: ' . $oldEmail .
            ' | Role: ' . $oldRole .
            ' to ' . $targetUser->role,
        'user_id' => $user->id ?? null,
        'user_name' => $user->email ?? 'Unknown',
    ]);

    return back()->with('success', 'User updated successfully');
});

Route::post('/admin/users/delete/{id}', function ($id) {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    if ((int) Session::get('user_id') === (int) $id) {
        return back()->with('error', 'You cannot delete your own account.');
    }

    $targetUser = User::findOrFail($id);

    $deletedEmail = $targetUser->email;
    $deletedRole = $targetUser->role;

    $targetUser->delete();

    $user = User::find(Session::get('user_id'));

    AuditLog::create([
        'module' => 'Users',
        'action' => 'Delete User',
        'description' => 'Deleted user: ' . $deletedEmail .
            ' | Role: ' . $deletedRole,
        'user_id' => $user->id ?? null,
        'user_name' => $user->email ?? 'Unknown',
    ]);

    return back()->with('success', 'User deleted successfully');
});

/*
|--------------------------------------------------------------------------
| USER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/user/dashboard', function () {

    if (!Session::has('user_id')) {
        return redirect('/');
    }

    if (Session::get('role') !== 'user') {
        return redirect('/');
    }

    $items = InventoryItem::orderBy('category')
        ->orderBy('item_description')
        ->get();

    $totalItems = $items->count();
    $totalStock = $items->sum('quantity');
    $lowStock = $items->where('quantity', '<=', 5)->count();

    $totalValue = $items->sum(function ($item) {
        return $item->quantity * $item->cost;
    });

    $categories = $items->groupBy('category');

    return view('user.dashboard', compact(
        'items',
        'totalItems',
        'totalStock',
        'lowStock',
        'totalValue',
        'categories'
    ));
});

/*
|--------------------------------------------------------------------------
| AUDIT PAGE
|--------------------------------------------------------------------------
*/

Route::get('/admin/audit', function () {

    if (Session::get('role') !== 'admin') {
        return redirect('/');
    }

    $audits = AuditLog::latest()->get();

    return view('admin.audit', compact('audits'));
});