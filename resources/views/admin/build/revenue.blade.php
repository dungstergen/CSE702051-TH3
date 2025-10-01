@extends('admin.layouts')

@section('title', 'Doanh thu - Paspark Admin')
@section('page_title', 'Báo cáo doanh thu')
@section('breadcrumb', 'Doanh thu')

@section('content')
    <!-- Revenue Stats -->
    <div class="dashboard-cards">
        <div class="card">
            <h3>Doanh thu hôm nay</h3>
            <div class="number">2,456,000đ</div>
            <div class="change">+8.5% so với hôm qua</div>
        </div>
        <div class="card">
            <h3>Doanh thu tháng</h3>
            <div class="number">68,240,000đ</div>
            <div class="change">+12.3% so với tháng trước</div>
        </div>
        <div class="card">
            <h3>Trung bình/lượt</h3>
            <div class="number">25,500đ</div>
            <div class="change">Giá vé trung bình</div>
        </div>
        <div class="card">
            <h3>Lợi nhuận</h3>
            <div class="number">45,680,000đ</div>
            <div class="change">67% tỷ suất lợi nhuận</div>
        </div>
    </div>

    <!-- Revenue by Time -->
    <div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
        <div class="card">
            <h3>Doanh thu theo giờ (hôm nay)</h3>
            <div style="margin-top: 15px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>6:00 - 8:00</span>
                    <strong>420,000đ</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>8:00 - 12:00</span>
                    <strong>680,000đ</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>12:00 - 14:00</span>
                    <strong>520,000đ</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>14:00 - 17:00</span>
                    <strong>780,000đ</strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>17:00 - 19:00</span>
                    <strong>640,000đ</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>19:00 - 22:00</span>
                    <strong>416,000đ</strong>
                </div>
            </div>
        </div>

        <div class="card">
            <h3>Doanh thu theo loại vé</h3>
            <div style="margin-top: 15px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; align-items: center;">
                    <span>Vé thường</span>
                    <div>
                        <strong>1,890,000đ</strong>
                        <span style="font-size: 12px; color: #666; margin-left: 8px;">(77%)</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; align-items: center;">
                    <span>Vé VIP</span>
                    <div>
                        <strong>456,000đ</strong>
                        <span style="font-size: 12px; color: #666; margin-left: 8px;">(18%)</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; align-items: center;">
                    <span>Vé tháng</span>
                    <div>
                        <strong>110,000đ</strong>
                        <span style="font-size: 12px; color: #666; margin-left: 8px;">(5%)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Revenue Table -->
    <div class="card">
        <h3>Chi tiết doanh thu trong ngày</h3>
        <div style="overflow-x: auto; margin-top: 15px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa;">
                        <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Thời gian</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Biển số</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Vị trí</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Thời lượng</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Loại vé</th>
                        <th style="padding: 12px; text-align: right; border: 1px solid #dee2e6;">Số tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">14:25</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">30B-987.65</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">C5</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">3h 45m</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span
                                style="background: #6c757d; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Thường</span>
                        </td>
                        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: right;"><strong>45,000đ</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">14:18</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">43D-321.09</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">D2</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">1h 20m</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span
                                style="background: #6c757d; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Thường</span>
                        </td>
                        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: right;"><strong>20,000đ</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">14:02</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">92G-345.67</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">B5</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">2h 15m</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span
                                style="background: #28a745; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">VIP</span>
                        </td>
                        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: right;"><strong>25,000đ</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">13:45</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">67I-234.56</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">A9</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">4h 10m</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span
                                style="background: #6c757d; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Thường</span>
                        </td>
                        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: right;"><strong>60,000đ</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">13:20</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">78K-567.89</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">C2</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;">30 phút</td>
                        <td style="padding: 10px; border: 1px solid #dee2e6;"><span
                                style="background: #28a745; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">VIP</span>
                        </td>
                        <td style="padding: 10px; border: 1px solid #dee2e6; text-align: right;"><strong>10,000đ</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <button class="btn btn-primary" onclick="loadMoreTransactions()">
                <i class="fas fa-plus"></i>
                Xem thêm giao dịch
            </button>
        </div>
    </div>

    <script>
        function loadMoreTransactions() {
            alert('Đang tải thêm giao dịch...');
        }
    </script>
@endsection
