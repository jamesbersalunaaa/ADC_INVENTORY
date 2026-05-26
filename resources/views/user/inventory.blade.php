<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory | ADC Inventory</title>
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
    overflow-x: hidden;
}

.sidebar {
    position: fixed;
    width: 260px;
    height: 100vh;
    background: #111827;
    padding: 25px 20px;
    color: white;
    overflow-y: auto;
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
    min-height: 100vh;
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
    gap: 15px;
}

.topbar h1 {
    font-size: 24px;
    color: #111827;
    margin: 0;
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
    font-weight: 700;
    font-size: 12px;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

@media (max-width: 768px) {
    .topbar {
        flex-direction: column;
        align-items: flex-start;
    }
}

.cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 25px;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    border-left: 4px solid #72df45;
}

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card p {
    color: #6b7280;
    font-size: 13px;
}

.card h2 {
    font-size: 26px;
    margin-top: 8px;
    color: #111827;
}

.card svg {
    opacity: 0.85;
}

.panel {
    background: white;
    padding: 22px;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
}

.panel-header {
    margin-bottom: 18px;
}

.panel-header h2 {
    font-size: 18px;
    color: #111827;
}

.filter-form {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    background: #f8fff5;
    padding: 15px;
    border-radius: 14px;
    border: 1px solid #eef0ee;
    margin-bottom: 18px;
}

.filter-form input,
.filter-form select {
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
.filter-form select:focus {
    border-color: #72df45;
    box-shadow: 0 0 0 3px rgba(114, 223, 69, 0.18);
}

.reset-btn {
    padding: 12px 16px;
    background: #e5e7eb;
    color: #111827;
    text-decoration: none;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.table-wrapper {
    overflow-x: auto;
    border-radius: 14px;
    border: 1px solid #eef0ee;
    width: 100%;
}

table {
    width: 100%;
    min-width: 700px;
    border-collapse: collapse;
    background: white;
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

tr:hover {
    background: #f8fff5;
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

.status {
    padding: 6px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 700;
}

.available {
    background: #ecffe5;
    color: #2f8f16;
}

.low {
    background: #fff3cd;
    color: #a16207;
}

.empty-row {
    text-align: center;
    color: #6b7280;
    padding: 28px;
}

.bottom-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-top: 18px;
    flex-wrap: wrap;
}

.entries-info {
    font-size: 14px;
    color: #374151;
}

.pagination-box {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.pagination-box a,
.pagination-box span {
    min-width: 42px;
    height: 38px;
    padding: 0 13px;
    border-radius: 9px;
    border: 1px solid #e5e7eb;
    background: white;
    color: #111827;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.pagination-box a:hover {
    background: #72df45;
    color: #111827;
}

.pagination-box .page-active {
    background: #22c55e;
    color: white;
    border-color: #22c55e;
}

.pagination-box .dots {
    border: none;
    background: transparent;
    min-width: 25px;
}

.readonly-note {
    margin-top: 20px;
    padding: 14px 16px;
    background: #f8fff5;
    border-left: 4px solid #72df45;
    color: #374151;
    border-radius: 10px;
    font-size: 14px;
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    justify-content: center;
    align-items: center;
    z-index: 999;
    padding: 20px;
}

.modal-content {
    background: white;
    padding: 25px;
    border-radius: 14px;
    width: 330px;
    max-width: 100%;
    text-align: center;
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

.modal-content h3 {
    margin-bottom: 10px;
}

.modal-content p {
    color: #6b7280;
    font-size: 14px;
}

.modal-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 22px;
    gap: 12px;
}

.cancel-btn,
.logout-btn {
    width: 100%;
    padding: 11px;
    border: none;
    border-radius: 9px;
    cursor: pointer;
    font-weight: 700;
}

.cancel-btn {
    background: #e5e7eb;
    color: #111827;
}

.logout-btn {
    background: #ef4444;
    color: white;
}

@media (max-width: 1100px) {
    .cards {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        padding: 15px;
        overflow: visible;
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
        width: 100%;
        padding: 15px;
    }

    .topbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .cards {
        grid-template-columns: 1fr;
    }

    .filter-form {
        flex-direction: column;
    }

    .filter-form input,
    .filter-form select,
    .reset-btn {
        width: 100%;
    }

    .bottom-section {
        flex-direction: column;
        align-items: flex-start;
    }

    .pagination-box {
        width: 100%;
        justify-content: flex-start;
    }

    .modal-actions {
        flex-direction: column;
    }
}

</style>
</head>
<body>

<aside class="sidebar">
    <img src="{{ asset('img/logo.png') }}" alt="ADC Logo">

    <h3>ADC Inventory System</h3>

    <div class="menu">
        <a href="/user/dashboard">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 4h7v7H4V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M13 4h7v4h-7V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M13 10h7v10h-7V10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M4 13h7v7H4v-7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
            </svg>
            Dashboard
        </a>

        <a href="/user/inventory" class="active">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M5 20V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M5 20h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M9 16v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M13 16V8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M17 16v-9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Inventory
        </a>

        <a href="#" onclick="openLogoutModal()">
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
        <h1>Inventory</h1>
        <p>View-only inventory monitoring and item lookup.</p>
    </div>

    <div class="role-badge">
        VIEW ONLY ACCESS
    </div>
</div>


    @php
        $shownItems = $items instanceof \Illuminate\Pagination\AbstractPaginator ? $items->getCollection() : $items;

        $totalItems = $shownItems->count();
        $availableStock = $shownItems->sum('quantity');
        $lowStock = $shownItems->where('quantity', '<=', 5)->count();
        $totalValue = $shownItems->sum(function ($item) {
            return $item->quantity * $item->cost;
        });
    @endphp

    <div class="cards">
        <div class="card">
            <div class="card-top">
                <p>Total Items Shown</p>
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <path d="M4 4h7v7H4V4Z" stroke="#72df45" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M13 4h7v4h-7V4Z" stroke="#72df45" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M13 10h7v10h-7V10Z" stroke="#72df45" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M4 13h7v7H4v-7Z" stroke="#72df45" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2>{{ $totalItems }}</h2>
        </div>

        <div class="card">
            <div class="card-top">
                <p>Stock Shown</p>
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <path d="M21 8L12 3 3 8l9 5 9-5Z" stroke="#72df45" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M3 8v8l9 5 9-5V8" stroke="#72df45" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M12 13v8" stroke="#72df45" stroke-width="2"/>
                </svg>
            </div>
            <h2>{{ number_format($availableStock) }}</h2>
        </div>

        <div class="card">
            <div class="card-top">
                <p>Low Stock Shown</p>
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <path d="M12 4 3 20h18L12 4Z" stroke="#f59e0b" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M12 9v5" stroke="#f59e0b" stroke-width="2" stroke-linecap="round"/>
                    <path d="M12 17h.01" stroke="#f59e0b" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>
            <h2>{{ $lowStock }}</h2>
        </div>

        <div class="card">
            <div class="card-top">
                <p>Total Value Shown</p>
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <path d="M6 7h12" stroke="#22c55e" stroke-width="2" stroke-linecap="round"/>
                    <path d="M6 11h9" stroke="#22c55e" stroke-width="2" stroke-linecap="round"/>
                    <path d="M6 15h6" stroke="#22c55e" stroke-width="2" stroke-linecap="round"/>
                    <path d="M18 3v18" stroke="#22c55e" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <h2>₱{{ number_format($totalValue, 2) }}</h2>
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <h2>Inventory Records</h2>
        </div>

        <form method="GET" action="/user/inventory" class="filter-form" id="filterForm">
            <input type="text"
                id="searchInput"
                name="search"
                placeholder="Search item description..."
                value="{{ request('search') }}">

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

            <a href="/user/inventory" class="reset-btn">Reset</a>
        </form>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Cost</th>
                        <th>Total Value</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td><strong>{{ $item->item_description }}</strong></td>
                            <td><span class="category-pill">{{ $item->category }}</span></td>
                            <td><strong>{{ $item->quantity }}</strong></td>
                            <td>{{ $item->unit }}</td>
                            <td>₱{{ number_format($item->cost, 2) }}</td>
                            <td><strong>₱{{ number_format($item->quantity * $item->cost, 2) }}</strong></td>
                            <td>
                                @if($item->quantity <= 5)
                                    <span class="status low">Low Stock</span>
                                @else
                                    <span class="status available">Available</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-row">
                                No inventory records found. Try changing your search or filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bottom-section">
            <p class="entries-info">
                Showing {{ $items->firstItem() ?? 0 }} to {{ $items->lastItem() ?? 0 }} of {{ $items->total() }} entries
            </p>

            <div class="pagination-box">
                @if ($items->previousPageUrl())
                    <a href="{{ $items->appends(request()->query())->previousPageUrl() }}">Previous</a>
                @else
                    <span>Previous</span>
                @endif

                @php
                    $current = $items->currentPage();
                    $last = $items->lastPage();
                @endphp

                @for ($i = 1; $i <= $last; $i++)
                    @if ($i == 1 || $i == $last || ($i >= $current - 2 && $i <= $current + 2))
                        @if ($i == $current)
                            <span class="page-active">{{ $i }}</span>
                        @else
                            <a href="{{ $items->appends(request()->query())->url($i) }}">{{ $i }}</a>
                        @endif
                    @elseif ($i == 2 || $i == $last - 1)
                        <span class="dots">...</span>
                    @endif
                @endfor

                @if ($items->nextPageUrl())
                    <a href="{{ $items->appends(request()->query())->nextPageUrl() }}">Next</a>
                @else
                    <span>Next</span>
                @endif
            </div>
        </div>

        <div class="readonly-note">
            This account is view-only. Adding, editing, deleting, and updating inventory records are only available for admin accounts.
        </div>
    </section>

</main>

<div id="logoutModal" class="modal">
    <div class="modal-content">
        <h3>Confirm Logout</h3>
        <p>Are you sure you want to logout?</p>

        <div class="modal-actions">
            <button onclick="closeLogoutModal()" class="cancel-btn">Cancel</button>
            <button onclick="proceedLogout()" class="logout-btn">Logout</button>
        </div>
    </div>
</div>

<script>
let searchTimer;

document.getElementById('searchInput').addEventListener('input', function () {
    clearTimeout(searchTimer);

    searchTimer = setTimeout(() => {
        document.getElementById('filterForm').submit();
    }, 500);
});

document.getElementById('categoryFilter').addEventListener('change', function () {
    document.getElementById('filterForm').submit();
});

document.getElementById('perPageFilter').addEventListener('change', function () {
    document.getElementById('filterForm').submit();
});

function openLogoutModal() {
    document.getElementById('logoutModal').style.display = 'flex';
}

function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}

function proceedLogout() {
    window.location.href = '/logout';
}

window.onclick = function(event) {
    let modal = document.getElementById('logoutModal');

    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>

</body>
</html>