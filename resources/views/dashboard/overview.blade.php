@extends('layouts.dashboard')

@section('title', 'Overview')
@section('page-title', 'Overview')

@section('content')
<!-- KPI Stats Row -->
<div class="row g-3 mb-4">
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="kpi-icon blue">
                <i data-lucide="users"></i>
            </div>
            <div class="kpi-value">{{ $kpi['total_customers'] ?? 277 }}</div>
            <div class="kpi-label">Customers Total</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="kpi-icon green">
                <i data-lucide="user-plus"></i>
            </div>
            <div class="kpi-value">{{ $kpi['new_today'] ?? 1 }}</div>
            <div class="kpi-label">New Today</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="kpi-icon orange">
                <i data-lucide="trending-up"></i>
            </div>
            <div class="kpi-value">{{ $kpi['investors'] ?? 0 }}</div>
            <div class="kpi-label">Investors</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <div class="kpi-icon purple">
                <i data-lucide="user-check"></i>
            </div>
            <div class="kpi-value">{{ $kpi['active_investors'] ?? 0 }}</div>
            <div class="kpi-label">Active Investors</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
            <div class="kpi-icon teal">
                <i data-lucide="wallet"></i>
            </div>
            <div class="kpi-value">TSh {{ number_format($kpi['investor_balances'] ?? 0, 0) }}</div>
            <div class="kpi-label">Investor Balances</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
            <div class="kpi-icon red">
                <i data-lucide="shopping-bag"></i>
            </div>
            <div class="kpi-value">TSh {{ number_format($kpi['sales_mtt'] ?? 0, 0) }}</div>
            <div class="kpi-label">Sales (MTT)</div>
        </div>
    </div>
</div>

<!-- Second Row KPIs -->
<div class="row g-3 mb-4">
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 0.7s;">
            <div class="kpi-icon cyan">
                <i data-lucide="credit-card"></i>
            </div>
            <div class="kpi-value">TSh {{ number_format($kpi['payments_mtd'] ?? 0, 0) }}</div>
            <div class="kpi-label">Payments (MTD)</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 0.8s;">
            <div class="kpi-icon indigo">
                <i data-lucide="briefcase"></i>
            </div>
            <div class="kpi-value">{{ $kpi['active_employees'] ?? 0 }}</div>
            <div class="kpi-label">Active Employees</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 0.9s;">
            <div class="kpi-icon pink">
                <i data-lucide="banknote"></i>
            </div>
            <div class="kpi-value">TSh {{ number_format($kpi['monthly_payroll'] ?? 0, 0) }}</div>
            <div class="kpi-label">Monthly Payroll</div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="kpi-card animate__animated animate__fadeInUp" style="animation-delay: 1.0s;">
            <div class="kpi-icon yellow">
                <i data-lucide="inbox"></i>
            </div>
            <div class="kpi-value">{{ $kpi['crm_inbox'] ?? 0 }}</div>
            <div class="kpi-label">CRM Open Inbox</div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="chart-card animate__animated animate__fadeIn">
            <div class="chart-header">
                <h5 class="chart-title">Activity Trend (Last 14 Days)</h5>
                <div class="chart-legend">
                    <span class="legend-item"><span class="dot blue"></span>Orders</span>
                    <span class="legend-item"><span class="dot green"></span>Payments</span>
                    <span class="legend-item"><span class="dot orange"></span>Customers</span>
                </div>
            </div>
            <div class="chart-body">
                <canvas id="activityChart" height="300"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="chart-card animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
            <div class="chart-header">
                <h5 class="chart-title">Distribution</h5>
            </div>
            <div class="chart-body text-center">
                <canvas id="distributionChart" height="260"></canvas>
                <p class="text-muted mt-3 mb-0">No data available</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Tables Row -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="table-card animate__animated animate__fadeInUp">
            <div class="table-header">
                <h5 class="table-title">Recent Payments</h5>
                <a href="#" class="table-link">View all</a>
            </div>
            <div class="table-body">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Ref</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPayments ?? [] as $payment)
                        <tr>
                            <td>{{ $payment->created_at->format('d M Y') }}</td>
                            <td><span class="text-primary">{{ $payment->reference }}</span></td>
                            <td>{{ $payment->description }}</td>
                            <td class="fw-semibold">TSh {{ number_format($payment->amount, 0) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No payments.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="table-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="table-header">
                <h5 class="table-title">Recent Investor Transactions</h5>
                <a href="#" class="table-link">View all</a>
            </div>
            <div class="table-body">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Investor</th>
                            <th>Type</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions ?? [] as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at->format('d M Y') }}</td>
                            <td>{{ $transaction->investor_name }}</td>
                            <td>
                                <span class="badge-{{ $transaction->type === 'deposit' ? 'success' : 'warning' }}">
                                    {{ ucfirst($transaction->type) }}
                                </span>
                            </td>
                            <td class="fw-semibold">TSh {{ number_format($transaction->amount, 0) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No transactions.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Row -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="table-card animate__animated animate__fadeInUp">
            <div class="table-header">
                <h5 class="table-title">CRM Inbox (Latest)</h5>
                <a href="#" class="table-link">View all</a>
            </div>
            <div class="table-body">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No messages.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="table-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="table-header">
                <h5 class="table-title">Recent Logins</h5>
                <a href="#" class="table-link">View all</a>
            </div>
            <div class="table-body">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>IP Address</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentLogins ?? [] as $login)
                        <tr>
                            <td>{{ $login->user_name }}</td>
                            <td>{{ $login->ip_address }}</td>
                            <td>{{ $login->created_at->format('d M Y, H:i') }}</td>
                            <td><span class="badge-success">Success</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No recent logins.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* KPI Cards */
.kpi-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.kpi-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
}

.kpi-icon i {
    width: 22px;
    height: 22px;
}

.kpi-icon.blue { background: #dbeafe; color: #2563eb; }
.kpi-icon.green { background: #dcfce7; color: #16a34a; }
.kpi-icon.orange { background: #ffedd5; color: #ea580c; }
.kpi-icon.purple { background: #f3e8ff; color: #9333ea; }
.kpi-icon.teal { background: #ccfbf1; color: #0d9488; }
.kpi-icon.red { background: #fee2e2; color: #dc2626; }
.kpi-icon.cyan { background: #cffafe; color: #0891b2; }
.kpi-icon.indigo { background: #e0e7ff; color: #6366f1; }
.kpi-icon.pink { background: #fce7f3; color: #db2777; }
.kpi-icon.yellow { background: #fef3c7; color: #d97706; }

.kpi-value {
    font-size: 22px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 4px;
}

.kpi-label {
    font-size: 12px;
    color: #6b7280;
}

/* Chart Cards */
.chart-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    overflow: hidden;
    height: 100%;
}

.chart-header {
    padding: 20px 24px;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.chart-title {
    font-size: 15px;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.chart-legend {
    display: flex;
    gap: 16px;
}

.legend-item {
    font-size: 12px;
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 6px;
}

.legend-item .dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

.legend-item .dot.blue { background: #3b82f6; }
.legend-item .dot.green { background: #10b981; }
.legend-item .dot.orange { background: #f59e0b; }

.chart-body {
    padding: 24px;
}

/* Table Cards */
.table-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    overflow: hidden;
    height: 100%;
}

.table-header {
    padding: 16px 20px;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-title {
    font-size: 15px;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.table-link {
    font-size: 12px;
    color: #dc2626;
    text-decoration: none;
    font-weight: 500;
}

.table-link:hover {
    text-decoration: underline;
}

.table-body {
    padding: 0;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    text-align: left;
    padding: 12px 16px;
    font-size: 11px;
    font-weight: 600;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: #fafafa;
}

.data-table td {
    padding: 14px 16px;
    font-size: 13px;
    color: #374151;
    border-bottom: 1px solid #f3f4f6;
}

.data-table tr:last-child td {
    border-bottom: none;
}

.data-table tr:hover td {
    background: #fafafa;
}

.badge-success, .badge-warning {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 500;
}

.badge-success {
    background: #dcfce7;
    color: #16a34a;
}

.badge-warning {
    background: #fef3c7;
    color: #d97706;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Activity Trend Chart
const activityCtx = document.getElementById('activityChart').getContext('2d');
const activityChart = new Chart(activityCtx, {
    type: 'line',
    data: {
        labels: ['2026-04-01', '2026-04-02', '2026-04-03', '2026-04-04', '2026-04-05', '2026-04-06', '2026-04-07', '2026-04-08', '2026-04-09', '2026-04-10', '2026-04-11', '2026-04-12', '2026-04-13', '2026-04-14'],
        datasets: [{
            label: 'Orders',
            data: [3, 2, 4, 5, 3, 4, 7, 4, 3, 4, 2, 5, 3, 2],
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            fill: true,
            tension: 0.4,
            pointRadius: 3,
            pointBackgroundColor: '#3b82f6'
        }, {
            label: 'Payments',
            data: [1, 0, 1, 1, 0, 1, 2, 1, 1, 0, 1, 0, 1, 1],
            borderColor: '#10b981',
            backgroundColor: 'transparent',
            fill: false,
            tension: 0.4,
            pointRadius: 3,
            pointBackgroundColor: '#10b981'
        }, {
            label: 'Customers',
            data: [2, 1, 2, 3, 1, 2, 4, 2, 2, 1, 2, 3, 2, 1],
            borderColor: '#f59e0b',
            backgroundColor: 'transparent',
            fill: false,
            tension: 0.4,
            pointRadius: 3,
            pointBackgroundColor: '#f59e0b'
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
                beginAtZero: true,
                grid: {
                    color: '#f3f4f6'
                },
                ticks: {
                    font: { size: 11 },
                    color: '#9ca3af'
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: { size: 10 },
                    color: '#9ca3af',
                    maxRotation: 45
                }
            }
        }
    }
});

// Distribution Doughnut Chart
const distCtx = document.getElementById('distributionChart').getContext('2d');
const distChart = new Chart(distCtx, {
    type: 'doughnut',
    data: {
        labels: ['No data'],
        datasets: [{
            data: [1],
            backgroundColor: ['#e5e7eb'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endsection
