<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Inventory | ADC Inventory</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: #f3f6f1;
            color: #1f2933;
        }

        .sidebar {
            position: fixed;
            width: 260px;
            height: 100vh;
            background: #111827;
            padding: 25px 20px;
            color: white;
        }

        .sidebar img {
            width: 160px;
            display: block;
            margin: 0 auto 20px;
        }

        .sidebar h3 {
            text-align: center;
            color: #8aff5c;
            font-size: 14px;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            color: #d1d5db;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .menu a:hover,
        .menu .active {
            background: #72df45;
            color: #111827;
            font-weight: 600;
        }

        .main {
            margin-left: 260px;
            padding: 30px;
            animation: fadeIn 0.35s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .topbar {
            background: white;
            padding: 22px 25px;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 24px;
        }

        .topbar p {
            color: #6b7280;
            font-size: 13px;
            margin-top: 4px;
        }

        .role-badge {
            background: #ecffe5;
            color: #37a517;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .panel {
            background: white;
            padding: 22px;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .panel-header h2 {
            font-size: 18px;
        }

        .btn {
            border: none;
            padding: 11px 16px;
            border-radius: 9px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            font-size: 13px;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .btn-add {
            background: #72df45;
            color: #111827;
        }

        .btn-edit {
            background: #facc15;
            color: #111827;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-cancel {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-pdf {
            background: #111827;
            color: white;
        }

        .filter-form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 18px;
            background: #f8fff5;
            border: 1px solid #eef0ee;
            padding: 15px;
            border-radius: 14px;
        }

        .filter-left {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-form input,
        .filter-form select,
        .form-grid input {
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
            background: white;
        }

        .filter-form input {
            width: 320px;
        }

        .filter-form input:focus,
        .filter-form select:focus,
        .form-grid input:focus {
            border-color: #72df45;
            box-shadow: 0 0 0 3px rgba(114, 223, 69, 0.18);
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 14px;
            border: 1px solid #eef0ee;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: #111827;
        }

        thead tr:hover {
            background: #111827;
        }

        th {
            background: #111827;
            color: white;
            padding: 14px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #eef0ee;
            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f8fff5;
        }

        .checkbox-cell {
            width: 45px;
            text-align: center;
        }

        .checkbox-cell input {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .category-pill {
            display: inline-block;
            background: #ecffe5;
            color: #2f8f16;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .stock-badge {
            display: inline-block;
            margin-left: 8px;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .stock-badge.good {
            background: #ecffe5;
            color: #2f8f16;
        }

        .stock-badge.low {
            background: #fff3cd;
            color: #a16207;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .success {
            background: #ecffe5;
            color: #2f8f16;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
            border-left: 4px solid #72df45;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
            border-left: 4px solid #ef4444;
        }

        .notification {
            display: none;
            background: #fff3cd;
            color: #92400e;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
            border-left: 4px solid #facc15;
        }

        .empty-row {
            text-align: center;
            color: #6b7280;
            padding: 25px;
        }

        #emptyFilterMessage {
            display: none;
            text-align: center;
            color: #6b7280;
            padding: 25px;
            font-size: 14px;
            border: 1px solid #eef0ee;
            border-top: none;
            border-radius: 0 0 14px 14px;
            background: white;
        }

        .simple-pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
        }

        .simple-pagination a,
        .simple-pagination span {
            padding: 9px 15px;
            border-radius: 8px;
            background: #e5e7eb;
            color: #111827;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .simple-pagination a:hover {
            background: #72df45;
        }

        .simple-pagination span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .simple-pagination p {
            font-size: 13px;
            color: #6b7280;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            inset: 0;
            background: rgba(0,0,0,0.45);
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            background: white;
            padding: 25px;
            border-radius: 16px;
            width: 520px;
            max-width: 92%;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
            animation: popIn 0.2s ease-in-out;
        }

        @keyframes popIn {
            from {
                opacity: 0;
                transform: scale(0.96);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-content h3 {
            margin-bottom: 5px;
        }

        .modal-content p {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-grid input[name="item_description"] {
            grid-column: span 2;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
        }

        @media (max-width: 768px) {
            body {
                overflow-x: hidden;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding: 15px;
            }

            .sidebar img {
                width: 90px;
                margin-bottom: 10px;
            }

            .sidebar h3 {
                font-size: 13px;
                margin-bottom: 15px;
            }

            .menu {
                display: flex;
                gap: 10px;
                overflow-x: auto;
                padding-bottom: 10px;
                scrollbar-width: none;
            }

            .menu::-webkit-scrollbar {
                display: none;
            }

            .menu a {
                min-width: max-content;
                padding: 12px 14px;
                font-size: 13px;
                margin-bottom: 0;
                border-radius: 12px;
                white-space: nowrap;
            }

            .menu a svg {
                width: 16px;
                height: 16px;
            }

            .main {
                margin-left: 0;
                padding: 15px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                padding: 18px;
            }

            .topbar h1 {
                font-size: 24px;
            }

            .panel {
                min-height: auto;
                padding: 18px;
            }

            .filter-form input {
                width: 100%;
            }

            .filter-left {
                width: 100%;
            }

            .filter-left input,
            .filter-left select,
            .filter-left a {
                width: 100%;
            }

            .panel-header > div:last-child {
                width: 100%;
            }

            .panel-header > div:last-child a,
            .panel-header > div:last-child button {
                width: 100%;
            }

            #logoutModal > div {
                width: 90% !important;
            }
        }
    </style>
</head>

<body>

<div id="logoutModal" style="
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.4);
    justify-content:center;
    align-items:center;
    z-index:999;
">
    <div style="
        background:white;
        padding:25px;
        border-radius:12px;
        width:320px;
        text-align:center;
        box-shadow:0 10px 30px rgba(0,0,0,0.2);
    ">
        <h3>Confirm Logout</h3>
        <p style="margin:15px 0;">Are you sure you want to logout?</p>

        <div style="display:flex; justify-content:space-between;">
            <button onclick="closeLogoutModal()" style="
                padding:10px 15px;
                border:none;
                background:#ddd;
                border-radius:8px;
                cursor:pointer;
            ">
                Cancel
            </button>

            <button onclick="proceedLogout()" style="
                padding:10px 15px;
                border:none;
                background:#e53935;
                color:white;
                border-radius:8px;
                cursor:pointer;
            ">
                Logout
            </button>
        </div>
    </div>
</div>

<aside class="sidebar">
    <img src="{{ asset('img/logo.png') }}" alt="ADC Logo">
    <h3>ADC Inventory System</h3>

    <div class="menu">
        <a href="/admin/dashboard">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 4h7v7H4V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M13 4h7v4h-7V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M13 10h7v10h-7V10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M4 13h7v7H4v-7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
            </svg>
            Dashboard
        </a>

        <a href="/admin/inventory" class="active">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M21 8L12 3 3 8l9 5 9-5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M3 8v8l9 5 9-5V8" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M12 13v8" stroke="currentColor" stroke-width="2"/>
            </svg>
            Manage Inventory
        </a>

        <a href="/admin/audit">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M5 20V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M5 20h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M9 16v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M13 16V8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M17 16v-9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Audit
        </a>

        <a href="/admin/users">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M16 11a4 4 0 1 0-8 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M4 20c1.2-3.5 4-5 8-5s6.8 1.5 8 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M12 15a4 4 0 0 0 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Users
        </a>

        <a href="#" onclick="openLogoutModal(event)">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M10 6H6v12h4" stroke="currentColor" stroke-width="2"/>
                <path d="M14 16l4-4-4-4" stroke="currentColor" stroke-width="2"/>
                <path d="M18 12H9" stroke="currentColor" stroke-width="2"/>
            </svg>
            Logout
        </a>
    </div>
</aside>

<main class="main">

    <div class="topbar">
        <div>
            <h1>Manage Inventory</h1>
            <p>Add, update, search, filter, export, and remove inventory records.</p>
        </div>

        <div class="role-badge">ADMIN ROLE</div>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <div id="pageNotification" class="notification"></div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2>Inventory Records</h2>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <a href="/admin/inventory/export/all" class="btn btn-pdf">
                    Export PDF
                </a>

                <button type="submit" form="exportSelectedForm" class="btn btn-add">
                    Export Selected PDF
                </button>

                <button type="button" class="btn btn-add" onclick="openAddModal()">
                    + Add Item
                </button>
            </div>
        </div>

        <form method="GET" action="/admin/inventory" class="filter-form" id="filterForm">
            <div class="filter-left">
                <input type="text" id="searchInput" name="search" placeholder="Search item description..." value="{{ request('search') }}">

                <select name="category" id="categoryFilter">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                <select name="per_page" id="perPageFilter">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 rows</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 rows</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 rows</option>
                </select>

                <a href="/admin/inventory" class="btn btn-cancel">Reset</a>
            </div>
        </form>

        <form method="POST" action="/admin/inventory/export/selected" id="exportSelectedForm">
            @csrf

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th class="checkbox-cell">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Item Description</th>
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Cost</th>
                            <th>Total Value</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="inventoryTable">
                        @forelse($items as $item)
                            <tr
                                data-category="{{ strtolower($item->category) }}"
                                data-description="{{ strtolower($item->item_description) }}"
                            >
                                <td class="checkbox-cell">
                                    <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="item-checkbox">
                                </td>

                                <td>
                                    <strong>{{ $item->item_description }}</strong>
                                </td>

                                <td>
                                    <span class="category-pill">{{ $item->category }}</span>
                                </td>

                                <td>
                                    <strong>{{ $item->quantity }}</strong>

                                    @if($item->quantity <= 5)
                                        <span class="stock-badge low">Low</span>
                                    @else
                                        <span class="stock-badge good">Good</span>
                                    @endif
                                </td>

                                <td>{{ $item->unit }}</td>

                                <td>₱{{ number_format($item->cost, 2) }}</td>

                                <td>
                                    <strong>₱{{ number_format($item->quantity * $item->cost, 2) }}</strong>
                                </td>

                                <td>
                                    <div class="actions">
                                        <button type="button" class="btn btn-edit"
                                            onclick="openEditModal(
                                                @js($item->id),
                                                @js($item->item_description),
                                                @js($item->category),
                                                @js($item->quantity),
                                                @js($item->unit),
                                                @js($item->cost)
                                            )">
                                            Edit
                                        </button>

                                        <button type="button"
                                            class="btn btn-delete"
                                            onclick="openDeleteModal(
                                                @js($item->id),
                                                @js($item->item_description)
                                            )">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr data-empty="true">
                                <td colspan="8" class="empty-row">No inventory items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="emptyFilterMessage">
                No inventory items found.
            </div>
        </form>

        <div class="simple-pagination">
            @if ($items->previousPageUrl())
                <a href="{{ $items->appends(request()->query())->previousPageUrl() }}">Previous</a>
            @else
                <span>Previous</span>
            @endif

            <p>Page {{ $items->currentPage() }} of {{ $items->lastPage() }}</p>

            @if ($items->nextPageUrl())
                <a href="{{ $items->appends(request()->query())->nextPageUrl() }}">Next</a>
            @else
                <span>Next</span>
            @endif
        </div>
    </section>

</main>

<div id="addModal" class="modal">
    <div class="modal-content">
        <h3>Add Inventory Item</h3>
        <p>Fill in the item details below to add a new inventory record.</p>

        <form method="POST" action="/admin/inventory/add">
            @csrf

            <div class="form-grid">
                <input type="text" name="item_description" placeholder="Item Description" required>
                <input type="text" name="category" placeholder="Category" required>
                <input type="number" name="quantity" placeholder="Quantity" min="0" required>
                <input type="text" name="unit" placeholder="Unit" required>
                <input type="number" step="0.01" name="cost" placeholder="Cost" min="0" required>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeAddModal()">Cancel</button>
                <button type="submit" class="btn btn-add">Save Item</button>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <h3>Confirm Delete</h3>
        <p id="deleteText">Are you sure you want to delete this item?</p>

        <div class="modal-actions">
            <button type="button" class="btn btn-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button type="button" class="btn btn-delete" id="confirmDeleteBtn">Delete</button>
        </div>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Inventory Item</h3>
        <p>Update the selected inventory item information.</p>

        <form method="POST" id="editForm">
            @csrf

            <div class="form-grid">
                <input type="text" id="edit_item_description" name="item_description" placeholder="Item Description" required>
                <input type="text" id="edit_category" name="category" placeholder="Category" required>
                <input type="number" id="edit_quantity" name="quantity" placeholder="Quantity" min="0" required>
                <input type="text" id="edit_unit" name="unit" placeholder="Unit" required>
                <input type="number" step="0.01" id="edit_cost" name="cost" placeholder="Cost" min="0" required>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn btn-add">Update Item</button>
            </div>
        </form>
    </div>
</div>

<form method="POST" id="deleteItemForm">
    @csrf
</form>

<script>
const searchInput = document.getElementById('searchInput');
const categoryFilter = document.getElementById('categoryFilter');
const perPageFilter = document.getElementById('perPageFilter');
const emptyFilterMessage = document.getElementById('emptyFilterMessage');

function filterInventory() {
    const rows = document.querySelectorAll('#inventoryTable tr');
    const searchValue = searchInput.value.toLowerCase();
    const categoryValue = categoryFilter.value.toLowerCase();

    let visibleCount = 0;

    rows.forEach(row => {
        if (row.getAttribute('data-empty') === 'true') {
            row.style.display = 'none';
            return;
        }

        const rowText = row.innerText.toLowerCase();
        const rowCategory = row.getAttribute('data-category') || '';

        const matchesSearch = rowText.includes(searchValue);
        const matchesCategory = !categoryValue || rowCategory === categoryValue;

        if (matchesSearch && matchesCategory) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    emptyFilterMessage.style.display = visibleCount === 0 ? 'block' : 'none';
}

searchInput.addEventListener('input', filterInventory);
categoryFilter.addEventListener('change', filterInventory);

perPageFilter.addEventListener('change', function () {
    document.getElementById('filterForm').submit();
});

function showNotification(message) {
    const notification = document.getElementById('pageNotification');

    notification.innerText = message;
    notification.style.display = 'block';

    setTimeout(() => {
        notification.style.display = 'none';
    }, 3000);
}

function getSelectedItems() {
    return JSON.parse(localStorage.getItem('selectedInventoryItems')) || [];
}

function saveSelectedItems(items) {
    localStorage.setItem('selectedInventoryItems', JSON.stringify(items));
}

function updateSelectedItem(id, checked) {
    let selectedItems = getSelectedItems();

    id = String(id);

    if (checked) {
        if (!selectedItems.includes(id)) {
            selectedItems.push(id);
        }
    } else {
        selectedItems = selectedItems.filter(itemId => itemId !== id);
    }

    saveSelectedItems(selectedItems);
}

function restoreCheckedItems() {
    const selectedItems = getSelectedItems();

    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        if (selectedItems.includes(checkbox.value)) {
            checkbox.checked = true;
        }
    });
}

document.querySelectorAll('.item-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        updateSelectedItem(this.value, this.checked);
    });
});

document.getElementById('selectAll')?.addEventListener('change', function () {
    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        checkbox.checked = this.checked;
        updateSelectedItem(checkbox.value, this.checked);
    });
});

document.getElementById('exportSelectedForm')?.addEventListener('submit', function (event) {
    const selectedItems = getSelectedItems();

    if (selectedItems.length === 0) {
        event.preventDefault();
        showNotification('Please select at least one item to export.');
        return;
    }

    document.querySelectorAll('.stored-selected-item').forEach(input => input.remove());

    selectedItems.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_items[]';
        input.value = id;
        input.classList.add('stored-selected-item');
        this.appendChild(input);
    });

    setTimeout(() => {
        localStorage.removeItem('selectedInventoryItems');

        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });

        const selectAll = document.getElementById('selectAll');

        if (selectAll) {
            selectAll.checked = false;
        }
    }, 1000);
});

function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

function openEditModal(id, item, category, quantity, unit, cost) {
    document.getElementById('editForm').action = '/admin/inventory/update/' + id;
    document.getElementById('edit_item_description').value = item;
    document.getElementById('edit_category').value = category ?? '';
    document.getElementById('edit_quantity').value = quantity;
    document.getElementById('edit_unit').value = unit;
    document.getElementById('edit_cost').value = cost;
    document.getElementById('editModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function openLogoutModal(event) {
    event.preventDefault();
    document.getElementById('logoutModal').style.display = 'flex';
}

function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}

function proceedLogout() {
    window.location.href = '/logout';
}

let selectedDeleteId = null;

function openDeleteModal(id, itemName) {
    selectedDeleteId = id;

    document.getElementById('deleteText').innerText =
        `Are you sure you want to delete "${itemName}"?`;

    document.getElementById('deleteModal').style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    selectedDeleteId = null;
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (selectedDeleteId) {
        const deleteForm = document.getElementById('deleteItemForm');
        deleteForm.action = '/admin/inventory/delete/' + selectedDeleteId;
        deleteForm.submit();
    }
});

window.addEventListener('click', function(event) {
    const addModal = document.getElementById('addModal');
    const deleteModal = document.getElementById('deleteModal');
    const editModal = document.getElementById('editModal');
    const logoutModal = document.getElementById('logoutModal');

    if (event.target === addModal) closeAddModal();
    if (event.target === deleteModal) closeDeleteModal();
    if (event.target === editModal) closeEditModal();
    if (event.target === logoutModal) closeLogoutModal();
});

restoreCheckedItems();
filterInventory();
</script>

</body>
</html>