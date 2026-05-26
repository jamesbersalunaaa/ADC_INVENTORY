<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard | ADC Inventory</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", sans-serif;
}

body {
    background: #f3f6f1;
    color: #111827;
    overflow-x: hidden;
}

/* SIDEBAR */
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
    transition: 0.2s;
    font-size: 14px;
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

/* MAIN */
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

.card p {
    color: #6b7280;
    font-size: 13px;
}

.card h2 {
    margin-top: 10px;
    font-size: 28px;
}

.charts-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.charts-grid.equal {
    grid-template-columns: repeat(2, 1fr);
}

.chart-box {
    background: white;
    padding: 22px;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    min-height: 360px;
}

.chart-header {
    margin-bottom: 18px;
}

.chart-header h2 {
    font-size: 18px;
    color: #111827;
}

.chart-header p {
    color: #6b7280;
    font-size: 13px;
    margin-top: 4px;
}

.chart-container {
    position: relative;
    height: 280px;
    width: 100%;
}

.big-chart .chart-container {
    height: 320px;
}

/* MODAL */
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

    .charts-grid,
    .charts-grid.equal {
        grid-template-columns: 1fr;
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
        padding: 18px;
    }

    .topbar h1 {
        font-size: 22px;
    }

    .cards {
        grid-template-columns: 1fr;
    }

    .card {
        padding: 18px;
    }

    .card h2 {
        font-size: 24px;
    }

    .chart-box {
        padding: 18px;
        min-height: 330px;
    }

    .chart-container,
    .big-chart .chart-container {
        height: 260px;
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

        <a href="/user/dashboard" class="active">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 4h7v7H4V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M13 4h7v4h-7V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M13 10h7v10h-7V10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M4 13h7v7H4v-7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
            </svg>
            Dashboard
        </a>

        <a href="/user/inventory">
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
        <h1>Employee Dashboard</h1>
        <p>Visual of inventory stock, value, and category performance.</p>
    </div>

    <div class="role-badge">VIEW ONLY ACCESS</div>
</div>

    <div class="cards">
        <div class="card">
            <p>Total Items</p>
            <h2>{{ $totalItems }}</h2>
        </div>

        <div class="card">
            <p>Total Stock</p>
            <h2>{{ number_format($totalStock) }}</h2>
        </div>

        <div class="card">
            <p>Low Stock</p>
            <h2>{{ $lowStock }}</h2>
        </div>

        <div class="card">
            <p>Total Inventory Value</p>
            <h2>₱{{ number_format($totalValue, 2) }}</h2>
        </div>
    </div>

    @php
        $categoryLabels = $categories->keys()->values();

        $categoryQuantities = $categories->map(function ($group) {
            return $group->sum('quantity');
        })->values();

        $categoryItemCounts = $categories->map(function ($group) {
            return $group->count();
        })->values();

        $categoryValues = $categories->map(function ($group) {
            return $group->sum(function ($item) {
                return $item->quantity * $item->cost;
            });
        })->values();

        $availableItems = $categories->flatten()->where('quantity', '>', 5)->count();
        $lowStockItems = $categories->flatten()->where('quantity', '<=', 5)->count();
    @endphp

    <div class="charts-grid">
        <div class="chart-box big-chart">
            <div class="chart-header">
                <h2>Stock Quantity by Category</h2>
                <p>Shows which categories have the highest stock quantity.</p>
            </div>

            <div class="chart-container">
                <canvas id="quantityChart"></canvas>
            </div>
        </div>

        <div class="chart-box">
            <div class="chart-header">
                <h2>Stock Status</h2>
                <p>Available items compared to low stock items.</p>
            </div>

            <div class="chart-container">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <div class="charts-grid equal">
        <div class="chart-box">
            <div class="chart-header">
                <h2>Items per Category</h2>
                <p>Total number of item records per category.</p>
            </div>

            <div class="chart-container">
                <canvas id="itemCountChart"></canvas>
            </div>
        </div>

        <div class="chart-box">
            <div class="chart-header">
                <h2>Inventory Value by Category</h2>
                <p>Estimated value based on quantity multiplied by cost.</p>
            </div>

            <div class="chart-container">
                <canvas id="valueChart"></canvas>
            </div>
        </div>
    </div>

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
    const categoryLabels = @json($categoryLabels);
    const categoryQuantities = @json($categoryQuantities);
    const categoryItemCounts = @json($categoryItemCounts);
    const categoryValues = @json($categoryValues);

    const chartColors = [
        '#72df45',
        '#22c55e',
        '#84cc16',
        '#16a34a',
        '#65a30d',
        '#a3e635',
        '#4ade80',
        '#86efac'
    ];

    new Chart(document.getElementById('quantityChart'), {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Total Quantity',
                data: categoryQuantities,
                backgroundColor: chartColors,
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Low Stock'],
            datasets: [{
                data: [{{ $availableItems }}, {{ $lowStockItems }}],
                backgroundColor: ['#72df45', '#f59e0b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    new Chart(document.getElementById('itemCountChart'), {
        type: 'polarArea',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Items',
                data: categoryItemCounts,
                backgroundColor: chartColors
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    new Chart(document.getElementById('valueChart'), {
        type: 'line',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Inventory Value',
                data: categoryValues,
                borderColor: '#22c55e',
                backgroundColor: 'rgba(114, 223, 69, 0.18)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return '₱' + Number(context.raw).toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₱' + Number(value).toLocaleString();
                        }
                    }
                }
            }
        }
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