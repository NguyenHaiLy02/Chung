@extends('owner.layouts.app')
@section('title', 'Trang quản trị')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Doanh thu -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ number_format($totalRevenue) }}<sup style="font-size: 20px"> VND</sup></h3>
                            <p>Doanh thu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Tổng sản phẩm -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalProducts }}</h3>
                            <p>Tổng sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Xem chi tiết <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Số lượng đơn hàng -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalOrders }}</h3>
                            <p>Số lượng đơn hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Xem chi tiết <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Tổng danh mục hàng hóa -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalCategories }}</h3>
                            <p>Tổng danh mục hàng hóa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">Xem chi tiết <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Biểu đồ doanh thu</h3>
                <form method="GET" action="{{ route('dashboard.index') }}">
                    <select name="timeRange" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                        <option value="7" {{ $timeRange == '7' ? 'selected' : '' }}>7 ngày gần nhất</option>
                        <option value="30" {{ $timeRange == '30' ? 'selected' : '' }}>1 tháng</option>
                        <option value="90" {{ $timeRange == '90' ? 'selected' : '' }}>3 tháng</option>
                        <option value="all" {{ $timeRange == 'all' ? 'selected' : '' }}>Tất cả</option>
                    </select>
                </form>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" style="height: 300px;"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const chartData = {
                labels: {!! json_encode($chartDates) !!},
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: {!! json_encode($chartRevenues) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };

            const chartOptions = {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Ngày'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Doanh thu (VND)'
                        },
                        beginAtZero: true
                    }
                }
            };

            const revenueChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: chartOptions
            });
        </script>
    </section>

@endsection
