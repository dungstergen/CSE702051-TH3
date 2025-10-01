
@extends('admin.layouts')

@section('title', 'Báo cáo - Paspark Admin')
@section('page_title', 'Báo cáo hệ thống')
@section('breadcrumb', 'Báo cáo')

@section('additional_css')
<style>
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border: 0;
    }
    .card h3 {
        font-size: 16px;
        color: #666;
        margin-bottom: 15px;
        font-weight: 600;
    }
    .card .number {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }
    .card .change {
        font-size: 14px;
        color: #28a745;
    }
    .btn {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    .btn-primary { background: #007bff; color: white; }
    .btn-success { background: #28a745; color: white; }
    .btn-warning { background: #ffc107; color: #333; }
    .btn-info { background: #17a2b8; color: white; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
</style>
@endsection

@section('content')
    <!-- Report Cards -->
    <div class="dashboard-cards">
        <div class="card">
            <h3>Doanh thu hôm nay</h3>
            <div class="number">2,456,000đ</div>
            <div class="change">+8.5% so với hôm qua</div>
        </div>
        <div class="card">
            <h3>Số lượt xe</h3>
            <div class="number">234</div>
            <div class="change">Tổng xe ra/vào hôm nay</div>
        </div>
        <div class="card">
            <h3>Thời gian đỗ TB</h3>
            <div class="number">2h 35m</div>
            <div class="change">Giảm 15m so với hôm qua</div>
        </div>
        <div class="card">
            <h3>Tỷ lệ sử dụng</h3>
            <div class="number">78%</div>
            <div class="change">Hiệu suất sử dụng</div>
        </div>
    </div>

    <!-- Charts and Reports -->
    <div class="row" style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px;">
        <div class="card">
            <h3>Biểu đồ doanh thu 7 ngày qua</h3>
            <div style="height: 300px; display: flex; align-items: end; gap: 10px; padding: 20px; background: #f8f9fa; border-radius: 8px; margin-top: 15px;">
                <div style="background: #ff6b35; width: 40px; height: 80%; border-radius: 4px;" title="Thứ 2: 1,890,000đ"></div>
                <div style="background: #ff6b35; width: 40px; height: 95%; border-radius: 4px;" title="Thứ 3: 2,135,000đ"></div>
                <div style="background: #ff6b35; width: 40px; height: 75%; border-radius: 4px;" title="Thứ 4: 1,675,000đ"></div>
                <div style="background: #ff6b35; width: 40px; height: 85%; border-radius: 4px;" title="Thứ 5: 1,920,000đ"></div>
                <div style="background: #ff6b35; width: 40px; height: 90%; border-radius: 4px;" title="Thứ 6: 2,045,000đ"></div>
                <div style="background: #ff6b35; width: 40px; height: 100%; border-radius: 4px;" title="Thứ 7: 2,280,000đ"></div>
                <div style="background: #28a745; width: 40px; height: 110%; border-radius: 4px;" title="Chủ nhật: 2,456,000đ"></div>
            </div>
            <div style="display: flex; justify-content: space-around; margin-top: 10px; font-size: 12px; color: #666;">
                <span>T2</span><span>T3</span><span>T4</span><span>T5</span><span>T6</span><span>T7</span><span>CN</span>
            </div>
        </div>

        <div class="card">
            <h3>Top 5 khách hàng VIP</h3>
            <div style="margin-top: 15px;">
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                    <span>Nguyễn Văn A</span>
                    <strong>45 lần</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                    <span>Trần Thị B</span>
                    <strong>38 lần</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                    <span>Lê Văn C</span>
                    <strong>32 lần</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee;">
                    <span>Phạm Thị D</span>
                    <strong>28 lần</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                    <span>Hoàng Văn E</span>
                    <strong>25 lần</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Options -->
    <div class="card">
        <h3>Xuất báo cáo</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 20px;">
            <button class="btn btn-primary" onclick="exportDailyReport()">
                <i class="fas fa-file-pdf"></i>
                Báo cáo ngày
            </button>
            <button class="btn btn-success" onclick="exportWeeklyReport()">
                <i class="fas fa-file-excel"></i>
                Báo cáo tuần
            </button>
            <button class="btn btn-warning" onclick="exportMonthlyReport()">
                <i class="fas fa-file-csv"></i>
                Báo cáo tháng
            </button>
            <button class="btn btn-info" onclick="exportCustomReport()">
                <i class="fas fa-file-alt"></i>
                Báo cáo tùy chỉnh
            </button>
        </div>
    </div>

    <script>
        function exportDailyReport() {
            alert('Đang xuất báo cáo ngày...');
        }

        function exportWeeklyReport() {
            alert('Đang xuất báo cáo tuần...');
        }

        function exportMonthlyReport() {
            alert('Đang xuất báo cáo tháng...');
        }

        function exportCustomReport() {
            alert('Mở form tùy chỉnh báo cáo...');
        }
    </script>
@endsection
