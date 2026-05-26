<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users | ADC Inventory</title>
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

        .notification {
            display: none;
            position: fixed;
            top: 25px;
            right: 25px;
            background: #fff3cd;
            color: #92400e;
            padding: 14px 18px;
            border-radius: 12px;
            border-left: 5px solid #facc15;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            font-size: 14px;
            font-weight: 600;
            z-index: 99999;
            animation: slideIn 0.25s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(25px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
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

        .toolbar {
            display: grid;
            grid-template-columns: 2fr 1fr auto;
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

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 45px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            cursor: pointer;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password svg {
            width: 19px;
            height: 19px;
        }

        .password-note {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
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

        .btn svg {
            width: 17px;
            height: 17px;
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

        .success {
            background: #ecffe5;
            color: #2f8f16;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            border-left: 4px solid #72df45;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            border-left: 4px solid #ef4444;
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
            vertical-align: middle;
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

        .badge-admin {
            background: #ecffe5;
            color: #2f8f16;
        }

        .badge-user {
            background: #ede9fe;
            color: #5b21b6;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-buttons button {
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 12px;
        }

        .edit-btn {
            background: #fef9c3;
            color: #854d0e;
        }

        .delete-btn {
            background: #fee2e2;
            color: #991b1b;
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
            max-width: 560px;
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

        .modal-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .modal-grid .full {
            grid-column: span 2;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 22px;
        }

        .modal-actions .btn {
            flex: 1;
        }

        .delete-message {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        @media (max-width: 1100px) {
            .toolbar {
                grid-template-columns: 1fr 1fr;
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
                gap: 10px;
                padding: 18px;
            }

            .topbar h1 {
                font-size: 22px;
            }

            .panel {
                padding: 18px;
                border-radius: 14px;
            }

            .toolbar {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .btn {
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

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons button {
                width: 100%;
            }

            .modal-box {
                padding: 20px;
            }

            .modal-grid {
                grid-template-columns: 1fr;
            }

            .modal-grid .full {
                grid-column: span 1;
            }

            .modal-actions {
                flex-direction: column;
            }

            .notification {
                top: 15px;
                right: 15px;
                left: 15px;
            }
        }
    </style>
</head>

<body>

<div id="notificationBox" class="notification"></div>

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

        <a href="/admin/audit">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M5 20V4" stroke="currentColor" stroke-width="2"/>
                <path d="M5 20h14" stroke="currentColor" stroke-width="2"/>
                <path d="M9 16v-5" stroke="currentColor" stroke-width="2"/>
                <path d="M13 16V8" stroke="currentColor" stroke-width="2"/>
                <path d="M17 16v-9" stroke="currentColor" stroke-width="2"/>
            </svg>
            Audit
        </a>

        <a href="/admin/users" class="active">
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
            <h1>Users Management</h1>
            <p>Create, update, search, filter, and remove system accounts.</p>
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

    <section class="panel">

        <div class="toolbar">
            <div class="form-group">
                <label>Search</label>
                <input type="text" id="searchInput" placeholder="Search name, email, or role...">
            </div>

            <div class="form-group">
                <label>Role</label>
                <select id="roleFilter">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button type="button" class="btn" id="openAddModal">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 5v14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Add User
            </button>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="usersTable">
                    @forelse(($users ?? collect()) as $user)
                        @php
                            $id = data_get($user, 'id', 'N/A');
                            $name = data_get($user, 'name', 'N/A');
                            $email = data_get($user, 'email', 'N/A');
                            $role = data_get($user, 'role', 'user');
                            $createdAt = data_get($user, 'created_at');
                            $createdDate = $createdAt ? \Carbon\Carbon::parse($createdAt)->format('Y-m-d h:i A') : 'N/A';
                        @endphp

                        <tr data-role="{{ strtolower($role) }}">
                            <td>{{ $id }}</td>
                            <td>{{ $name }}</td>
                            <td>{{ $email }}</td>
                            <td>
                                <span class="badge {{ strtolower($role) === 'admin' ? 'badge-admin' : 'badge-user' }}">
                                    {{ ucfirst($role) }}
                                </span>
                            </td>
                            <td>{{ $createdDate }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button
                                        type="button"
                                        class="edit-btn"
                                        onclick="openEditModal(
                                            @js($id),
                                            @js($name),
                                            @js($email),
                                            @js($role)
                                        )"
                                    >
                                        Edit
                                    </button>

                                    <form method="POST" action="/admin/users/delete/{{ $id }}" class="deleteForm">
                                        @csrf
                                        <button type="button" class="delete-btn" onclick="openDeleteModal(this, @js($name))">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </section>

</main>

<div class="modal" id="addModal">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-title">
                <h2>Create User Account</h2>
                <p>Add a new account and assign its system access role.</p>
            </div>

            <button type="button" class="close-x" onclick="closeAddModal()">×</button>
        </div>

        <form method="POST" action="/admin/users/add" onsubmit="return validateAddUserForm()">
            @csrf

            <div class="modal-grid">
                <div class="form-group full">
                    <label>Full Name</label>
                    <input type="text" name="name" id="addName" placeholder="Enter full name" required>
                </div>

                <div class="form-group full">
                    <label>Email Address</label>
                    <input type="email" name="email" id="addEmail" placeholder="example@email.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="addPassword" placeholder="Enter password" required minlength="6">
                        <button type="button" class="toggle-password" onclick="togglePassword('addPassword', 'addEyeIcon')">
                            <svg id="addEyeIcon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    <span class="password-note">Minimum of 6 characters.</span>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="addConfirmPassword" placeholder="Confirm password" required minlength="6">
                        <button type="button" class="toggle-password" onclick="togglePassword('addConfirmPassword', 'addConfirmEyeIcon')">
                            <svg id="addConfirmEyeIcon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-group full">
                    <label>Role</label>
                    <select name="role" id="addRole" required>
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn secondary" onclick="closeAddModal()">Cancel</button>
                <button type="submit" class="btn">Create Account</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="editModal">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-title">
                <h2>Edit User Account</h2>
                <p>Update account details, role, or password.</p>
            </div>

            <button type="button" class="close-x" onclick="closeEditModal()">×</button>
        </div>

        <form method="POST" id="editForm">
            @csrf

            <div class="modal-grid">
                <div class="form-group full">
                    <label>Full Name</label>
                    <input type="text" name="name" id="editName" required>
                </div>

                <div class="form-group full">
                    <label>Email Address</label>
                    <input type="email" name="email" id="editEmail" required>
                </div>

                <div class="form-group full">
                    <label>New Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="editPassword" placeholder="Leave blank to keep current password">
                        <button type="button" class="toggle-password" onclick="togglePassword('editPassword', 'editEyeIcon')">
                            <svg id="editEyeIcon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    <span class="password-note">Leave blank if you do not want to change the password.</span>
                </div>

                <div class="form-group full">
                    <label>Role</label>
                    <select name="role" id="editRole" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn secondary" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn">Update User</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="deleteModal">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-title">
                <h2>Confirm Delete</h2>
                <p>This action will remove the selected user account.</p>
            </div>

            <button type="button" class="close-x" onclick="closeDeleteModal()">×</button>
        </div>

        <p class="delete-message" id="deleteText">
            Are you sure you want to delete this user?
        </p>

        <div class="modal-actions">
            <button type="button" class="btn secondary" onclick="closeDeleteModal()">Cancel</button>
            <button type="button" class="btn danger" id="confirmDeleteBtn">Delete User</button>
        </div>
    </div>
</div>

<div class="modal" id="logoutModal">
    <div class="modal-box" style="max-width: 380px;">
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
    const roleFilter = document.getElementById('roleFilter');
    const userRows = document.querySelectorAll('#usersTable tr');

    searchInput.addEventListener('input', filterUsers);
    roleFilter.addEventListener('change', filterUsers);

    function filterUsers() {
        const searchValue = searchInput.value.toLowerCase();
        const roleValue = roleFilter.value.toLowerCase();

        userRows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            const rowRole = row.getAttribute('data-role') || '';

            const matchesSearch = rowText.includes(searchValue);
            const matchesRole = !roleValue || rowRole === roleValue;

            row.style.display = matchesSearch && matchesRole ? '' : 'none';
        });
    }

    function showNotification(message) {
        const notification = document.getElementById('notificationBox');

        notification.innerText = message;
        notification.style.display = 'block';

        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    }

    const addModal = document.getElementById('addModal');
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    const logoutModal = document.getElementById('logoutModal');
    const editForm = document.getElementById('editForm');

    document.getElementById('openAddModal').addEventListener('click', function () {
        addModal.classList.add('show');
    });

    function closeAddModal() {
        addModal.classList.remove('show');
        document.getElementById('addName').value = '';
        document.getElementById('addEmail').value = '';
        document.getElementById('addPassword').value = '';
        document.getElementById('addConfirmPassword').value = '';
        document.getElementById('addRole').value = '';
    }

    function validateAddUserForm() {
        const password = document.getElementById('addPassword').value;
        const confirmPassword = document.getElementById('addConfirmPassword').value;

        if (password !== confirmPassword) {
            showNotification('Password and confirm password do not match.');
            return false;
        }

        return true;
    }

    function openEditModal(id, name, email, role) {
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
        document.getElementById('editPassword').value = '';

        editForm.action = `/admin/users/update/${id}`;
        editModal.classList.add('show');
    }

    function closeEditModal() {
        editModal.classList.remove('show');
    }

    let selectedDeleteForm = null;

    function openDeleteModal(button, name) {
        selectedDeleteForm = button.closest('form');

        document.getElementById('deleteText').innerText =
            `Are you sure you want to delete "${name}"? This account will no longer be able to access the system.`;

        deleteModal.classList.add('show');
    }

    function closeDeleteModal() {
        deleteModal.classList.remove('show');
        selectedDeleteForm = null;
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (selectedDeleteForm) {
            selectedDeleteForm.submit();
        }
    });

    function openLogoutModal(event) {
        event.preventDefault();
        logoutModal.classList.add('show');
    }

    function closeLogoutModal() {
        logoutModal.classList.remove('show');
    }

    function proceedLogout() {
        window.location.href = '/logout';
    }

    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";

            icon.innerHTML = `
                <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20C5 20 1 12 1 12a21.77 21.77 0 0 1 5.06-5.94"></path>
                <path d="M9.9 4.24A10.45 10.45 0 0 1 12 4c7 0 11 8 11 8a21.69 21.69 0 0 1-3.22 4.31"></path>
                <path d="M14.12 14.12A3 3 0 0 1 9.88 9.88"></path>
                <path d="M1 1l22 22"></path>
            `;
        } else {
            input.type = "password";

            icon.innerHTML = `
                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            `;
        }
    }

    window.addEventListener('click', function (event) {
        if (event.target === addModal) closeAddModal();
        if (event.target === editModal) closeEditModal();
        if (event.target === deleteModal) closeDeleteModal();
        if (event.target === logoutModal) closeLogoutModal();
    });
</script>

</body>
</html>