
@extends('admin.layouts')

@section('title', 'Cấp thẻ VIP - Paspark Admin')
@section('page_title', 'Cấp thẻ VIP cho khách hàng')
@section('breadcrumb', 'Cấp thẻ VIP')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="color: #333; margin: 0;">⭐ Cấp thẻ VIP</h3>
            <a href="{{ route('admin.customers') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Quay lại
            </a>
        </div>

        <!-- Tìm kiếm khách hàng -->
        <div style="background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%); padding: 25px; border-radius: 15px; margin-bottom: 30px; border: 2px solid #ff6b35;">
            <h4 style="color: #ff6b35; margin-bottom: 20px; text-align: center;">
                🔍 Tìm kiếm khách hàng
            </h4>

            <form action="#" method="GET">
                <div style="display: grid; grid-template-columns: 1fr 1fr 150px; gap: 15px; align-items: end;">
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Số điện thoại</label>
                        <input type="tel" name="search_phone"
                               style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px;"
                               placeholder="0987654321">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Biển số xe</label>
                        <input type="text" name="search_plate"
                               style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; text-transform: uppercase;"
                               placeholder="29A-12345">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">
                            <i class="fas fa-search"></i>
                            Tìm kiếm
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Kết quả tìm kiếm (Demo) -->
        <div style="background: #f8f9fa; padding: 25px; border-radius: 15px; margin-bottom: 30px; border: 2px solid #28a745;">
            <h4 style="color: #28a745; margin-bottom: 20px;">
                📋 Thông tin khách hàng tìm thấy
            </h4>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h5 style="color: #333; margin-bottom: 15px; border-bottom: 2px solid #ff6b35; padding-bottom: 5px;">
                        👤 Thông tin cá nhân
                    </h5>
                    <div style="line-height: 1.8;">
                        <p><strong>Họ tên:</strong> <span style="color: #666;">Nguyễn Văn A</span></p>
                        <p><strong>SĐT:</strong> <span style="color: #666;">0987654321</span></p>
                        <p><strong>Email:</strong> <span style="color: #666;">nguyenvana@email.com</span></p>
                        <p><strong>Địa chỉ:</strong> <span style="color: #666;">123 Nguyễn Trãi, Hà Nội</span></p>
                    </div>
                </div>

                <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <h5 style="color: #333; margin-bottom: 15px; border-bottom: 2px solid #28a745; padding-bottom: 5px;">
                        🚗 Thông tin xe & thẻ
                    </h5>
                    <div style="line-height: 1.8;">
                        <p><strong>Biển số:</strong> <span style="color: #666;">29A-12345</span></p>
                        <p><strong>Loại xe:</strong> <span style="color: #666;">Ô tô</span></p>
                        <p><strong>Loại thẻ hiện tại:</strong>
                            <span style="background: #6c757d; color: white; padding: 3px 8px; border-radius: 4px; font-size: 14px;">Thẻ thường</span>
                        </p>
                        <p><strong>Ngày đăng ký:</strong> <span style="color: #666;">15/09/2025</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form nâng cấp VIP -->
        <form action="#" method="POST">
            <div style="background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%); padding: 25px; border-radius: 15px; border: 2px solid #28a745;">
                <h4 style="color: #28a745; margin-bottom: 25px; text-align: center;">
                    ⭐ Nâng cấp lên thẻ VIP ⭐
                </h4>

                <!-- Gói VIP -->
                <div style="margin-bottom: 25px;">
                    <label style="display: block; margin-bottom: 15px; font-weight: 600; color: #333; font-size: 18px;">
                        📦 Chọn gói VIP:
                    </label>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                        <!-- VIP Cơ bản -->
                        <div style="background: white; padding: 20px; border-radius: 15px; border: 3px solid #28a745; position: relative;">
                            <input type="radio" name="vip_package" value="basic" id="vip_basic" style="position: absolute; top: 15px; right: 15px; transform: scale(1.5);" checked>
                            <label for="vip_basic" style="cursor: pointer;">
                                <h5 style="color: #28a745; margin-bottom: 10px;">🥉 VIP Cơ bản</h5>
                                <div style="font-size: 24px; font-weight: bold; color: #ff6b35; margin-bottom: 10px;">200,000đ</div>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Có hiệu lực 6 tháng</p>
                                <ul style="color: #333; font-size: 14px; line-height: 1.6;">
                                    <li>✅ Giảm giá 15% mọi dịch vụ</li>
                                    <li>✅ Ưu tiên chỗ đỗ VIP</li>
                                    <li>✅ SMS thông báo miễn phí</li>
                                </ul>
                            </label>
                        </div>

                        <!-- VIP Premium -->
                        <div style="background: white; padding: 20px; border-radius: 15px; border: 3px solid #ffc107; position: relative;">
                            <input type="radio" name="vip_package" value="premium" id="vip_premium" style="position: absolute; top: 15px; right: 15px; transform: scale(1.5);">
                            <label for="vip_premium" style="cursor: pointer;">
                                <h5 style="color: #ffc107; margin-bottom: 10px;">🥈 VIP Premium</h5>
                                <div style="font-size: 24px; font-weight: bold; color: #ff6b35; margin-bottom: 10px;">350,000đ</div>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Có hiệu lực 12 tháng</p>
                                <ul style="color: #333; font-size: 14px; line-height: 1.6;">
                                    <li>✅ Giảm giá 25% mọi dịch vụ</li>
                                    <li>✅ Ưu tiên chỗ đỗ VIP + Premium</li>
                                    <li>✅ SMS & Email thông báo</li>
                                    <li>✅ Hỗ trợ 24/7</li>
                                </ul>
                            </label>
                        </div>

                        <!-- VIP Diamond -->
                        <div style="background: white; padding: 20px; border-radius: 15px; border: 3px solid #dc3545; position: relative;">
                            <input type="radio" name="vip_package" value="diamond" id="vip_diamond" style="position: absolute; top: 15px; right: 15px; transform: scale(1.5);">
                            <label for="vip_diamond" style="cursor: pointer;">
                                <h5 style="color: #dc3545; margin-bottom: 10px;">🥇 VIP Diamond</h5>
                                <div style="font-size: 24px; font-weight: bold; color: #ff6b35; margin-bottom: 10px;">500,000đ</div>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">Có hiệu lực 24 tháng</p>
                                <ul style="color: #333; font-size: 14px; line-height: 1.6;">
                                    <li>✅ Giảm giá 35% mọi dịch vụ</li>
                                    <li>✅ Chỗ đỗ Diamond độc quyền</li>
                                    <li>✅ Thông báo đa kênh</li>
                                    <li>✅ Hỗ trợ VIP 24/7</li>
                                    <li>✅ Voucher ưu đãi hàng tháng</li>
                                </ul>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Thông tin thanh toán -->
                <div style="background: white; padding: 20px; border-radius: 10px; margin-bottom: 25px;">
                    <h5 style="color: #333; margin-bottom: 15px;">💳 Thông tin thanh toán</h5>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Phương thức thanh toán</label>
                            <select name="payment_method" style="width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 8px;">
                                <option value="cash">💰 Tiền mặt</option>
                                <option value="transfer">🏦 Chuyển khoản</option>
                                <option value="card">💳 Thẻ tín dụng</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Ngày bắt đầu</label>
                            <input type="date" name="start_date" value="2025-09-25" style="width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 8px;">
                        </div>
                    </div>
                </div>

                <!-- Ghi chú -->
                <div style="margin-bottom: 25px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">📝 Ghi chú thêm</label>
                    <textarea name="notes" rows="3" style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; resize: vertical;" placeholder="Ghi chú về việc nâng cấp VIP (tùy chọn)"></textarea>
                </div>

                <!-- Nút xác nhận -->
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 15px 40px; margin-right: 20px; min-width: 200px;">
                        <i class="fas fa-star"></i>
                        Xác nhận nâng cấp VIP
                    </button>
                    <button type="button" class="btn btn-secondary" style="font-size: 18px; padding: 15px 40px; min-width: 200px;" onclick="history.back()">
                        <i class="fas fa-times"></i>
                        Hủy bỏ
                    </button>
                </div>
            </div>
        </form>

        <!-- Thông tin ưu đãi VIP -->
        <div style="background: #fff3cd; padding: 20px; border-radius: 10px; margin-top: 30px; border-left: 5px solid #ffc107;">
            <h5 style="color: #856404; margin-bottom: 15px;">
                ⚡ Lợi ích của thẻ VIP
            </h5>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="color: #28a745; font-size: 20px;">💸</span>
                    <span>Tiết kiệm chi phí đỗ xe lên đến 35%</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="color: #28a745; font-size: 20px;">🅿️</span>
                    <span>Ưu tiên chỗ đỗ tốt nhất</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="color: #28a745; font-size: 20px;">📱</span>
                    <span>Thông báo tức thời mọi hoạt động</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="color: #28a745; font-size: 20px;">🎁</span>
                    <span>Voucher và ưu đãi đặc biệt</span>
                </div>
            </div>
        </div>
    </div>
@endsection
