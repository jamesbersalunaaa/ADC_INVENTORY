<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | ADC Inventory</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        .card-icon {
            width: 42px;
            height: 42px;
            background: #ecffe5;
            color: #37a517;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .card-icon svg {
            width: 22px;
            height: 22px;
        }

        .card p {
            color: #6b7280;
            font-size: 13px;
        }

        .card h2 {
            font-size: 26px;
            margin-top: 8px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            align-items: stretch;
        }

        .panel {
            background: white;
            padding: 22px;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            display: flex;
            flex-direction: column;
            min-height: 520px;
        }

        .panel-header {
            margin-bottom: 15px;
        }

        .panel-header h2 {
            font-size: 18px;
        }

        .panel-header span {
            color: #6b7280;
            font-size: 12px;
        }

        .chart-box {
            position: relative;
            width: 100%;
            height: 390px;
            flex: 1;
        }

        .donut-box {
            position: relative;
            width: 100%;
            height: 360px;
        }

        .donut-center {
            position: absolute;
            top: 47%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            pointer-events: none;
        }

        .donut-center h2 {
            font-size: 34px;
            line-height: 1;
            color: #111827;
        }

        .donut-center span {
            font-size: 12px;
            color: #6b7280;
            letter-spacing: 0.5px;
        }

        .summary {
            margin-top: 12px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 11px 0;
            border-bottom: 1px solid #eef0ee;
            font-size: 13px;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-item span {
            color: #6b7280;
        }

        .summary-item strong {
            color: #111827;
        }

        /* =========================================
   TABLET RESPONSIVE
========================================= */

@media (max-width: 1100px) {

    .cards {
        grid-template-columns: repeat(2, 1fr);
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }

    .chart-box,
    .donut-box {
        height: 340px;
    }
}

/* =========================================
   MOBILE RESPONSIVE
========================================= */

@media (max-width: 768px) {

    body {
        overflow-x: hidden;
    }

    /* SIDEBAR */

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

    /* HORIZONTAL MOBILE MENU */

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

    /* MAIN CONTENT */

    .main {
        margin-left: 0;
        padding: 15px;
    }

    /* TOPBAR */

    .topbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding: 18px;
    }

    .topbar h1 {
        font-size: 24px;
    }

    /* CARDS */

    .cards {
        grid-template-columns: 1fr;
    }

    .card {
        padding: 18px;
    }

    .card h2 {
        font-size: 24px;
    }

    /* PANELS */

    .dashboard-grid {
        grid-template-columns: 1fr;
    }

    .panel {
        min-height: auto;
        padding: 18px;
    }

    /* CHARTS */

    .chart-box,
    .donut-box {
        height: 280px;
    }

    .donut-center h2 {
        font-size: 26px;
    }

    /* MODAL */

    #logoutModal > div {
        width: 90% !important;
    }
}
    </style>
</head>

<script>
function confirmLogout(event) {
    event.preventDefault();

    if (confirm("Are you sure you want to logout?")) {
        window.location.href = "/logout";
    }
}
</script>
<script>
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

<body>

    <aside class="sidebar">
        <img src="{{ asset('img/logo.png') }}" alt="ADC Logo">
        <h3>ADC Inventory System</h3>

        <div class="menu">
            <a href="/admin/dashboard" class="active">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M4 4h7v7H4V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M13 4h7v4h-7V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M13 10h7v10h-7V10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M4 13h7v7H4v-7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                </svg>
                Dashboard
            </a>

            <a href="/admin/inventory">
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
                <h1>Dashboard Overview</h1>
                <p>Inventory monitoring and performance summary</p>
            </div>

            <div class="role-badge">ADMIN ROLE</div>
        </div>

        <div class="cards">
            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M21 8L12 3 3 8l9 5 9-5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M3 8v8l9 5 9-5V8" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p>Total Items</p>
                <h2>{{ $totalItems }}</h2>
            </div>

            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M5 20V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M5 20h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M9 16v-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M13 16V8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M17 16v-9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <p>Total Stock</p>
                <h2>{{ number_format($totalStock) }}</h2>
            </div>

            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M12 4 3 20h18L12 4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M12 9v5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M12 17h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>
                <p>Low Stock Items</p>
                <h2>{{ $lowStock }}</h2>
            </div>

            <div class="card">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M6 7h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M6 11h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M6 15h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M18 3v18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <p>Total Inventory Value</p>
                <h2>₱{{ number_format($totalValue, 2) }}</h2>
            </div>
        </div>

        <div class="dashboard-grid">
            <section class="panel">
                <div class="panel-header">
                    <h2>Stock by Category</h2>
                    <span>Distribution of stock quantities</span>
                </div>

                <div class="chart-box">
                    <canvas id="categoryChart"></canvas>
                </div>
            </section>

            <section class="panel">
                <div class="panel-header">
                    <h2>Inventory Status</h2>
                    <span>Available vs low stock</span>
                </div>

                <div class="donut-box">
                    <canvas id="statusChart"></canvas>

                    <div class="donut-center">
                        <h2 id="centerCount">0</h2>
                        <span>TOTAL ITEMS</span>
                    </div>
                </div>

                <div class="summary">
                    <div class="summary-item">
                        <span>Available Items</span>
                        <strong>{{ $totalItems - $lowStock }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>Low Stock Items</span>
                        <strong>{{ $lowStock }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>Total Categories</span>
                        <strong>{{ count($categoryLabels) }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>Total Value</span>
                        <strong>₱{{ number_format($totalValue, 2) }}</strong>
                    </div>
                </div>
            </section>
        </div>

    </main>

    <script>
        const categoryLabels = @json($categoryLabels);
        const categoryStocks = @json($categoryStocks);

        const totalItems = {{ $totalItems }};
        const availableItems = {{ $totalItems - $lowStock }};
        const lowStockItems = {{ $lowStock }};

        function animateCount(id, endValue, duration = 1200) {
            const element = document.getElementById(id);
            let startTime = null;

            function updateCount(timestamp) {
                if (!startTime) startTime = timestamp;

                const progress = Math.min((timestamp - startTime) / duration, 1);
                const easedProgress = 1 - Math.pow(1 - progress, 4);
                const currentValue = Math.floor(easedProgress * endValue);

                element.textContent = currentValue.toLocaleString();

                if (progress < 1) {
                    requestAnimationFrame(updateCount);
                } else {
                    element.textContent = endValue.toLocaleString();
                }
            }

            requestAnimationFrame(updateCount);
        }

        animateCount('centerCount', totalItems);

        new Chart(document.getElementById('categoryChart'), {
            type: 'bar',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryStocks,
                    backgroundColor: '#72df45',
                    borderRadius: 8,
                    maxBarThickness: 56
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1200,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#6b7280',
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(17, 24, 39, 0.08)'
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6b7280',
                            maxRotation: 45,
                            minRotation: 0
                        },
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Available', 'Low Stock'],
                datasets: [{
                    data: [availableItems, lowStockItems],
                    backgroundColor: ['#72df45', '#facc15'],
                    borderWidth: 6,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1300,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 18,
                            color: '#6b7280'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        padding: 12,
                        cornerRadius: 8
                    }
                }
            }
        });
    </script>

</body>
</html>