@extends('admin.layouts')

@section('title', 'Thêm khách hàng - Paspark Admin')
@section('page_title', 'Thêm khách hàng mới')
@section('breadcrumb', 'Thêm khách hàng')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="color: #333; margin: 0;">📋 Thông tin khách hàng</h3>
            <a href="{{ route('admin.customers') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Quay lại
            </a>
        </div>

        <form action="#" method="POST" style="max-width: 800px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <!-- Cột trái - Thông tin cá nhân -->
                <div>
                    <h4
                        style="color: #ff6b35; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #ff6b35;">
                        👤 Thông tin cá nhân
                    </h4>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Họ và tên
                            *</label>
                        <input type="text" name="fullName" required
                            style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                            placeholder="Nhập họ tên đầy đủ" onfocus="this.style.borderColor='#ff6b35'"
                            onblur="this.style.borderColor='#ddd'">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Số điện thoại
                            *</label>
                        <input type="tel" name="phone" required
                            style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                            placeholder="0987654321" onfocus="this.style.borderColor='#ff6b35'"
                            onblur="this.style.borderColor='#ddd'">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Email</label>
                        <input type="email" name="email"
                            style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                            placeholder="example@email.com" onfocus="this.style.borderColor='#ff6b35'"
                            onblur="this.style.borderColor='#ddd'">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Địa chỉ</label>
                        <textarea name="address" rows="4"
                            style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; resize: vertical; transition: border-color 0.3s;"
                            placeholder="Nhập địa chỉ thường trú" onfocus="this.style.borderColor='#ff6b35'"
                            onblur="this.style.borderColor='#ddd'"></textarea>
                    </div>
                </div>

                <!-- Cột phải - Thông tin xe và thẻ -->
                <div>
                    <h4
                        style="color: #28a745; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #28a745;">
                        🚗 Thông tin xe & thẻ
                    </h4>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Biển số xe
                            *</label>
                        <input type="text" name="licensePlate" required
                            style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; text-transform: uppercase; transition: border-color 0.3s;"
                            placeholder="29A-12345" onfocus="this.style.borderColor='#28a745'"
                            onblur="this.style.borderColor='#ddd'">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Loại xe</label>
                        <select name="vehicleType"
                            style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                            onfocus="this.style.borderColor='#28a745'" onblur="this.style.borderColor='#ddd'">
                            <option value="car">🚗 Ô tô</option>
                            <option value="motorcycle">🏍️ Xe máy</option>
                            <option value="truck">🚚 Xe tải</option>
                            <option value="suv">🚙 SUV</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Loại thẻ</label>
                        <select name="cardType"
                            style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s;"
                            onfocus="this.style.borderColor='#28a745'" onblur="this.style.borderColor='#ddd'">
                            <option value="regular">🎫 Thẻ thường</option>
                            <option value="vip">⭐ Thẻ VIP</option>
                            <option value="monthly">📅 Thẻ tháng</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Ghi chú</label>
                        <textarea name="notes" rows="4"
                            style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; resize: vertical; transition: border-color 0.3s;"
                            placeholder="Ghi chú thêm về khách hàng (tùy chọn)" onfocus="this.style.borderColor='#28a745'"
                            onblur="this.style.borderColor='#ddd'"></textarea>
                    </div>
                </div>
            </div>

            <!-- Ưu đãi VIP -->
            <div
                style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 25px; border-radius: 15px; margin: 30px 0; border: 2px solid #28a745;">
                <h4 style="color: #28a745; margin-bottom: 20px; text-align: center;">
                    ⭐ Ưu đãi dành cho thẻ VIP ⭐
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                    <div
                        style="display: flex; align-items: center; gap: 12px; background: white; padding: 15px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <input type="checkbox" name="vipBenefits[]" value="discount" style="transform: scale(1.5);">
                        <span style="font-weight: 500;">💰 Giảm giá 20% mọi dịch vụ</span>
                    </div>
                    <div
                        style="display: flex; align-items: center; gap: 12px; background: white; padding: 15px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <input type="checkbox" name="vipBenefits[]" value="priority" style="transform: scale(1.5);">
                        <span style="font-weight: 500;">🅿️ Ưu tiên chỗ đỗ VIP</span>
                    </div>
                    <div
                        style="display: flex; align-items: center; gap: 12px; background: white; padding: 15px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <input type="checkbox" name="vipBenefits[]" value="sms" style="transform: scale(1.5);">
                        <span style="font-weight: 500;">📱 Thông báo SMS miễn phí</span>
                    </div>
                </div>
            </div>

            <!-- Nút hành động -->
            <div style="text-align: center; margin-top: 40px; padding-top: 30px; border-top: 2px solid #eee;">
                <button type="submit" class="btn btn-success"
                    style="font-size: 18px; padding: 15px 40px; margin-right: 20px; min-width: 180px;">
                    <i class="fas fa-save"></i>
                    Lưu khách hàng
                </button>
                <button type="reset" class="btn btn-warning" style="font-size: 18px; padding: 15px 40px; min-width: 180px;">
                    <i class="fas fa-undo"></i>
                    Làm mới form
                </button>
            </div>
        </form>

        <!-- Thông tin hướng dẫn -->
        <div
            style="background: #e3f2fd; padding: 20px; border-radius: 10px; margin-top: 30px; border-left: 5px solid #2196f3;">
            <h5 style="color: #1976d2; margin-bottom: 10px;">
                💡 Hướng dẫn sử dụng
            </h5>
            <ul style="color: #424242; line-height: 1.6;">
                <li>Các trường có dấu <strong style="color: #f44336;">*</strong> là bắt buộc phải nhập</li>
                <li>Biển số xe sẽ được tự động định dạng theo chuẩn Việt Nam</li>
                <li>Khách hàng VIP được hưởng nhiều ưu đãi đặc biệt</li>
                <li>Thông tin sẽ được lưu vào hệ thống sau khi nhấn "Lưu khách hàng"</li>
            </ul>
        </div>
    </div>
@endsection
