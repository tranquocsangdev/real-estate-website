@extends('Admin.Layout.master')
@section('title', 'Dashboard')
@section('content')

<div class="row mb-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="mt-2 text-white text-uppercase">Real Estate Dashboard</h5>
            </div>
        </div>
    </div>
</div>

{{-- KPI nhanh --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card text-bg-primary">
            <div class="card-body">
                <h6>Tổng BĐS</h6>
                <h3>125</h3>
                <small>Đang hoạt động</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-success">
            <div class="card-body">
                <h6>Doanh thu tháng</h6>
                <h3>2.3 tỷ</h3>
                <small>Tăng 18%</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-warning">
            <div class="card-body">
                <h6>Leads mới</h6>
                <h3>58</h3>
                <small>Hôm nay</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-danger">
            <div class="card-body">
                <h6>Giao dịch</h6>
                <h3>7</h3>
                <small>Tuần này</small>
            </div>
        </div>
    </div>

</div>

{{-- CHART + DOANH THU --}}
<div class="row mb-4">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Biểu đồ doanh thu 6 tháng
            </div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                Phân loại khách hàng
            </div>
            <div class="card-body">
                <canvas id="customerChart"></canvas>
            </div>
        </div>
    </div>

</div>

{{-- MAP + AI + KPI --}}
<div class="row mb-4">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Bản đồ khu vực BĐS hot
            </div>
            <div class="card-body">
                <iframe
                    src="https://maps.google.com/maps?q=ho%20chi%20minh&t=&z=11&ie=UTF8&iwloc=&output=embed"
                    width="100%" height="300" class="border-0">
                </iframe>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                AI phân tích khách hàng
            </div>
            <div class="card-body">
                <p>🔥 Khách quan tâm nhiều nhất: <strong>Chung cư 2-3 tỷ</strong></p>
                <p>📍 Khu vực hot: <strong>Thủ Đức - Quận 9</strong></p>
                <p>💰 Ngân sách phổ biến: <strong>1.5 - 3 tỷ</strong></p>
                <p>⏱ Thời gian mua trung bình: <strong>14 ngày</strong></p>
                <p class="text-success fw-bold">→ Gợi ý: đẩy marketing phân khúc trung cấp</p>
            </div>
        </div>
    </div>

</div>

{{-- KPI nhân viên --}}
<div class="row mb-4">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-warning">
                KPI nhân viên sale
            </div>
            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nhân viên</th>
                            <th>Leads</th>
                            <th>Chốt deal</th>
                            <th>Doanh thu</th>
                            <th>Hiệu suất</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sang</td>
                            <td>20</td>
                            <td>5</td>
                            <td>1.2 tỷ</td>
                            <td><span class="badge bg-success">Xuất sắc</span></td>
                        </tr>
                        <tr>
                            <td>Hà</td>
                            <td>15</td>
                            <td>3</td>
                            <td>700 triệu</td>
                            <td><span class="badge bg-primary">Tốt</span></td>
                        </tr>
                        <tr>
                            <td>Minh</td>
                            <td>10</td>
                            <td>1</td>
                            <td>200 triệu</td>
                            <td><span class="badge bg-danger">Cần cải thiện</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

{{-- REALTIME ACTIVITY --}}
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Hoạt động realtime
            </div>
            <div class="card-body">

                <ul class="list-group">
                    <li class="list-group-item">🟢 Khách mới xem BĐS Quận 7</li>
                    <li class="list-group-item">🟢 Lead mới đăng ký tư vấn</li>
                    <li class="list-group-item">🟢 Nhân viên Sang vừa chốt deal</li>
                    <li class="list-group-item">🟢 Bài đăng mới được duyệt</li>
                </ul>

            </div>
        </div>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

const revenueChart = new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6'],
        datasets: [{
            label: 'Doanh thu (tỷ)',
            data: [1.2, 1.8, 2.1, 1.5, 2.6, 2.3],
            borderWidth: 2
        }]
    }
});

const customerChart = new Chart(document.getElementById('customerChart'), {
    type: 'doughnut',
    data: {
        labels: ['Mua', 'Thuê', 'Đầu tư'],
        datasets: [{
            data: [55, 30, 15]
        }]
    }
});

</script>

@endsection
