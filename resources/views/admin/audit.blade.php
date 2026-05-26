<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Audit | ADC Inventory</title>
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
            width: calc(100% - 260px);
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
        }

        .panel {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            width: 100%;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr auto;
            gap: 14px;
            margin-bottom: 22px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        input,
        select {
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
            background: white;
            width: 100%;
        }

        input:focus,
        select:focus {
            border-color: #72df45;
            box-shadow: 0 0 0 3px rgba(114, 223, 69, 0.18);
        }

        .btn {
            background: #72df45;
            color: #111827;
            border: none;
            padding: 13px 18px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
            white-space: nowrap;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:hover {
            background: #5ecf30;
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(0,0,0,0.12);
        }

        .btn.secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .btn.secondary:hover {
            background: #d1d5db;
        }

        .btn.danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn.danger:hover {
            background: #fecaca;
        }

        .table-wrap {
            overflow-x: auto;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        thead {
            background: #111827;
        }

        thead tr:hover {
            background: #111827;
        }

        th {
            text-align: left;
            padding: 15px;
            font-size: 13px;
            color: white;
            background: #111827;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        td {
            padding: 15px;
            font-size: 14px;
            border-bottom: 1px solid #f1f1f1;
            color: #374151;
            vertical-align: top;
        }

        tbody tr:hover {
            background: #fbfff9;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            white-space: nowrap;
        }

        .badge-stock {
            background: #ecffe5;
            color: #2f8f16;
        }

        .badge-add {
            background: #ecfeff;
            color: #036672;
        }

        .badge-edit {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-user {
            background: #ede9fe;
            color: #5b21b6;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #6b7280;
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(17, 24, 39, 0.55);
            align-items: center;
            justify-content: center;
            z-index: 999;
            padding: 20px;
        }

        .modal.show {
            display: flex;
        }

        .modal-box {
            background: white;
            width: 100%;
            max-width: 380px;
            padding: 26px;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.22);
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

        .modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
        }

        .modal-title h2 {
            font-size: 22px;
            margin-bottom: 4px;
        }

        .modal-title p {
            font-size: 13px;
            color: #6b7280;
        }

        .close-x {
            border: none;
            background: #f3f4f6;
            color: #374151;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            font-weight: 700;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 22px;
        }

        .modal-actions .btn {
            flex: 1;
        }

        @media (max-width: 1100px) {
            .filter-grid {
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
                padding: 18px;
            }

            .topbar h1 {
                font-size: 23px;
            }

            .panel {
                padding: 18px;
                border-radius: 14px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .btn,
            .btn.secondary,
            .btn.danger {
                width: 100%;
            }

            table {
                min-width: 850px;
            }

            th,
            td {
                padding: 12px;
                font-size: 12px;
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

        <a href="/admin/dashboard">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 4h7v7H4V4Z" stroke="currentColor" stroke-width="2"/>
                <path d="M13 4h7v4h-7V4Z" stroke="currentColor" stroke-width="2"/>
                <path d="M13 10h7v10h-7V10Z" stroke="currentColor" stroke-width="2"/>
                <path d="M4 13h7v7H4v-7Z" stroke="currentColor" stroke-width="2"/>
            </svg>
            Dashboard
        </a>

        <a href="/admin/inventory">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M21 8L12 3 3 8l9 5 9-5Z" stroke="currentColor" stroke-width="2"/>
                <path d="M3 8v8l9 5 9-5V8" stroke="currentColor" stroke-width="2"/>
            </svg>
            Manage Inventory
        </a>

        <a href="/admin/audit" class="active">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M5 20V4" stroke="currentColor" stroke-width="2"/>
                <path d="M5 20h14" stroke="currentColor" stroke-width="2"/>
                <path d="M9 16v-5" stroke="currentColor" stroke-width="2"/>
                <path d="M13 16V8" stroke="currentColor" stroke-width="2"/>
                <path d="M17 16v-9" stroke="currentColor" stroke-width="2"/>
            </svg>
            Audit
        </a>

        <a href="/admin/users">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M16 11a4 4 0 1 0-8 0" stroke="currentColor" stroke-width="2"/>
                <path d="M4 20c1.2-3.5 4-5 8-5s6.8 1.5 8 5" stroke="currentColor" stroke-width="2"/>
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
            <h1>Audit Trail</h1>
            <p>View system activity logs and filter by keyword, module, action, and date.</p>
        </div>

        <div class="role-badge">ADMIN ROLE</div>
    </div>

    <section class="panel">

        <div class="filter-grid">
            <div class="form-group">
                <label>Search</label>
                <input type="text" id="searchInput" placeholder="Search description, user, module, action...">
            </div>

            <div class="form-group">
                <label>Module</label>
                <select id="moduleFilter">
                    <option value="">All Modules</option>
                    <option value="inventory">Inventory</option>
                    <option value="users">Users</option>
                    <option value="auth">Auth</option>
                </select>
            </div>

            <div class="form-group">
                <label>Action</label>
                <select id="actionFilter">
                    <option value="">All Actions</option>
                    <option value="login">Login</option>
                    <option value="logout">Logout</option>
                    <option value="add item">Add Item</option>
                    <option value="edit item">Edit Item</option>
                    <option value="delete item">Delete Item</option>
                    <option value="add user">Add User</option>
                    <option value="edit user">Edit User</option>
                    <option value="delete user">Delete User</option>
                </select>
            </div>

            <div class="form-group">
                <label>From Date</label>
                <input type="date" id="fromDate">
            </div>

            <div class="form-group">
                <label>To Date</label>
                <input type="date" id="toDate">
            </div>

            <button type="button" class="btn secondary" id="resetFilter">Reset</button>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Module</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>User</th>
                    </tr>
                </thead>

                <tbody id="auditTable">
                    @forelse(($audits ?? collect()) as $audit)
                        @php
                            $createdAt = data_get($audit, 'created_at');
                            $dateOnly = $createdAt ? \Carbon\Carbon::parse($createdAt)->format('Y-m-d') : '';
                            $dateTime = $createdAt ? \Carbon\Carbon::parse($createdAt)->format('Y-m-d h:i A') : 'N/A';

                            $module = data_get($audit, 'module', 'N/A');
                            $actionText = data_get($audit, 'action', 'N/A');
                            $actionLower = strtolower($actionText);

                            $description = data_get($audit, 'description', 'N/A');
                            $userName = data_get($audit, 'user_name', 'System');

                            $badgeClass = 'badge-stock';

                            if (str_contains($actionLower, 'add')) {
                                $badgeClass = 'badge-add';
                            } elseif (str_contains($actionLower, 'edit')) {
                                $badgeClass = 'badge-edit';
                            } elseif (str_contains($actionLower, 'delete')) {
                                $badgeClass = 'badge-delete';
                            } elseif (str_contains($actionLower, 'user')) {
                                $badgeClass = 'badge-user';
                            }
                        @endphp

                        <tr
                            data-date="{{ $dateOnly }}"
                            data-module="{{ strtolower($module) }}"
                            data-action="{{ strtolower($actionText) }}"
                        >
                            <td>{{ $dateTime }}</td>
                            <td>{{ $module }}</td>
                            <td><span class="badge {{ $badgeClass }}">{{ $actionText }}</span></td>
                            <td>{{ $description }}</td>
                            <td>{{ $userName }}</td>
                        </tr>
                    @empty
                        <tr data-empty="true">
                            <td colspan="5" class="empty">No audit records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="empty" id="emptyMessage" style="display: none;">
                No audit records found.
            </div>
        </div>

    </section>

</main>

<div class="modal" id="logoutModal">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-title">
                <h2>Confirm Logout</h2>
                <p>Are you sure you want to logout?</p>
            </div>

            <button type="button" class="close-x" onclick="closeLogoutModal()">×</button>
        </div>

        <div class="modal-actions">
            <button type="button" class="btn secondary" onclick="closeLogoutModal()">Cancel</button>
            <button type="button" class="btn danger" onclick="proceedLogout()">Logout</button>
        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const moduleFilter = document.getElementById('moduleFilter');
    const actionFilter = document.getElementById('actionFilter');
    const fromDate = document.getElementById('fromDate');
    const toDate = document.getElementById('toDate');
    const resetFilter = document.getElementById('resetFilter');
    const emptyMessage = document.getElementById('emptyMessage');

    function filterAudit() {
        const auditRows = document.querySelectorAll('#auditTable tr');
        const searchValue = searchInput.value.toLowerCase();
        const moduleValue = moduleFilter.value.toLowerCase();
        const actionValue = actionFilter.value.toLowerCase();
        const fromValue = fromDate.value;
        const toValue = toDate.value;

        let visibleCount = 0;

        auditRows.forEach(row => {
            if (row.getAttribute('data-empty') === 'true') {
                row.style.display = 'none';
                return;
            }

            const rowText = row.innerText.toLowerCase();
            const rowModule = row.getAttribute('data-module') || '';
            const rowAction = row.getAttribute('data-action') || '';
            const rowDate = row.getAttribute('data-date') || '';

            const matchesSearch = rowText.includes(searchValue);
            const matchesModule = !moduleValue || rowModule === moduleValue;
            const matchesAction = !actionValue || rowAction === actionValue;
            const matchesFrom = !fromValue || rowDate >= fromValue;
            const matchesTo = !toValue || rowDate <= toValue;

            if (matchesSearch && matchesModule && matchesAction && matchesFrom && matchesTo) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        emptyMessage.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('input', filterAudit);
    moduleFilter.addEventListener('change', filterAudit);
    actionFilter.addEventListener('change', filterAudit);
    fromDate.addEventListener('change', filterAudit);
    toDate.addEventListener('change', filterAudit);

    resetFilter.addEventListener('click', function () {
        searchInput.value = '';
        moduleFilter.value = '';
        actionFilter.value = '';
        fromDate.value = '';
        toDate.value = '';
        filterAudit();
    });

    function openLogoutModal(event) {
        event.preventDefault();
        document.getElementById('logoutModal').classList.add('show');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('show');
    }

    function proceedLogout() {
        window.location.href = '/logout';
    }

    window.addEventListener('click', function(event) {
        const logoutModal = document.getElementById('logoutModal');

        if (event.target === logoutModal) {
            closeLogoutModal();
        }
    });
</script>

</body>
</html>