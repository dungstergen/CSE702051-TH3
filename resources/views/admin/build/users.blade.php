@extends('admin.build.master')

@section('title', 'Quản lý người dùng - Paspark Admin')
@section('page-title', 'Quản lý người dùng')
@section('breadcrumb-parent', 'Trang chủ')
@section('breadcrumb-current', 'Người dùng')

@section('content')
    <!-- Thống kê người dùng -->
    <div class="dashboard-cards">
        <div class="card">
            <h3>Tổng người dùng</h3>
            <div class="number">12</div>
            <div class="change">Đang hoạt động</div>
        </div>
        <div class="card">
            <h3>Super Admin</h3>
            <div class="number">1</div>
            <div class="change">Quyền cao nhất</div>
        </div>
        <div class="card">
            <h3>Manager</h3>
            <div class="number">4</div>
            <div class="change">Quản lý ca</div>
        </div>
        <div class="card">
            <h3>Staff</h3>
            <div class="number">7</div>
            <div class="change">Nhân viên</div>
        </div>
    </div>

    <!-- Nút thêm người dùng -->
    <div style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="color: #333; margin: 0;">👥 Danh sách người dùng</h3>
        <a href="#add-user-form" class="btn btn-success">
            <i class="fas fa-user-plus"></i>
            Thêm người dùng mới
        </a>
    </div>

    <!-- Bảng danh sách người dùng -->
    <div class="card">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <th style="padding: 15px; text-align: left; border: none;">ID</th>
                        <th style="padding: 15px; text-align: left; border: none;">👤 Tên đăng nhập</th>
                        <th style="padding: 15px; text-align: left; border: none;">📧 Email</th>
                        <th style="padding: 15px; text-align: left; border: none;">🎭 Vai trò</th>
                        <th style="padding: 15px; text-align: left; border: none;">📅 Lần cuối đăng nhập</th>
                        <th style="padding: 15px; text-align: center; border: none;">🔒 Trạng thái</th>
                        <th style="padding: 15px; text-align: center; border: none;">⚙️ Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">1</td>
                        <td style="padding: 15px;">
                            <strong style="color: #333;">admin</strong>
                            <br><small style="color: #666;">Quản trị viên</small>
                        </td>
                        <td style="padding: 15px;">admin@parkingadmin.com</td>
                        <td style="padding: 15px;">
                            <span style="background: #dc3545; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                Super Admin
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            <span style="color: #28a745; font-weight: bold;">Đang online</span>
                            <br><small style="color: #666;">2 phút trước</small>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <span style="background: #28a745; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px;">
                                Hoạt động
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <span style="color: #6c757d; font-style: italic;">Không thể sửa</span>
                        </td>
                    </tr>

                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">2</td>
                        <td style="padding: 15px;">
                            <strong style="color: #333;">manager1</strong>
                            <br><small style="color: #666;">Nguyễn Văn Quản</small>
                        </td>
                        <td style="padding: 15px;">manager1@parkingadmin.com</td>
                        <td style="padding: 15px;">
                            <span style="background: #007bff; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                Manager
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            <span style="color: #ffc107; font-weight: bold;">1 giờ trước</span>
                            <br><small style="color: #666;">25/09/2025 13:30</small>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <span style="background: #28a745; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px;">
                                Hoạt động
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="#edit-user-2" class="btn btn-sm" style="background: #ffc107; color: black; margin-right: 5px; padding: 5px 10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm" style="background: #dc3545; color: white; padding: 5px 10px;">
                                <i class="fas fa-lock"></i>
                            </button>
                        </td>
                    </tr>

                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">3</td>
                        <td style="padding: 15px;">
                            <strong style="color: #333;">manager2</strong>
                            <br><small style="color: #666;">Trần Thị Quản</small>
                        </td>
                        <td style="padding: 15px;">manager2@parkingadmin.com</td>
                        <td style="padding: 15px;">
                            <span style="background: #007bff; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                Manager
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            <span style="color: #ffc107; font-weight: bold;">3 giờ trước</span>
                            <br><small style="color: #666;">25/09/2025 11:15</small>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <span style="background: #28a745; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px;">
                                Hoạt động
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="#edit-user-3" class="btn btn-sm" style="background: #ffc107; color: black; margin-right: 5px; padding: 5px 10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm" style="background: #dc3545; color: white; padding: 5px 10px;">
                                <i class="fas fa-lock"></i>
                            </button>
                        </td>
                    </tr>

                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">4</td>
                        <td style="padding: 15px;">
                            <strong style="color: #333;">staff1</strong>
                            <br><small style="color: #666;">Lê Văn Nhân</small>
                        </td>
                        <td style="padding: 15px;">staff1@parkingadmin.com</td>
                        <td style="padding: 15px;">
                            <span style="background: #6c757d; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                Staff
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            <span style="color: #dc3545; font-weight: bold;">1 ngày trước</span>
                            <br><small style="color: #666;">24/09/2025 18:00</small>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <span style="background: #ffc107; color: black; padding: 5px 12px; border-radius: 20px; font-size: 12px;">
                                Tạm khóa
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="#edit-user-4" class="btn btn-sm" style="background: #ffc107; color: black; margin-right: 5px; padding: 5px 10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm" style="background: #28a745; color: white; padding: 5px 10px;">
                                <i class="fas fa-unlock"></i>
                            </button>
                        </td>
                    </tr>

                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">5</td>
                        <td style="padding: 15px;">
                            <strong style="color: #333;">staff2</strong>
                            <br><small style="color: #666;">Phạm Thị Viên</small>
                        </td>
                        <td style="padding: 15px;">staff2@parkingadmin.com</td>
                        <td style="padding: 15px;">
                            <span style="background: #6c757d; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                Staff
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            <span style="color: #ffc107; font-weight: bold;">30 phút trước</span>
                            <br><small style="color: #666;">25/09/2025 14:00</small>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <span style="background: #28a745; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px;">
                                Hoạt động
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="#edit-user-5" class="btn btn-sm" style="background: #ffc107; color: black; margin-right: 5px; padding: 5px 10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm" style="background: #dc3545; color: white; padding: 5px 10px;">
                                <i class="fas fa-lock"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form thêm người dùng mới -->
    <div id="add-user-form" style="margin-top: 40px;">
        <div class="card">
            <h3 style="color: #333; margin-bottom: 25px;">➕ Thêm người dùng mới</h3>

            <form action="#" method="POST">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <!-- Cột trái -->
                    <div>
                        <h4 style="color: #ff6b35; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #ff6b35;">
                            👤 Thông tin cá nhân
                        </h4>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tên đăng nhập *</label>
                            <input type="text" name="username" required
                                   style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px;"
                                   placeholder="Nhập tên đăng nhập">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Họ và tên *</label>
                            <input type="text" name="fullname" required
                                   style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px;"
                                   placeholder="Nhập họ tên đầy đủ">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email *</label>
                            <input type="email" name="email" required
                                   style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px;"
                                   placeholder="example@parkingadmin.com">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Số điện thoại</label>
                            <input type="tel" name="phone"
                                   style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px;"
                                   placeholder="0987654321">
                        </div>
                    </div>

                    <!-- Cột phải -->
                    <div>
                        <h4 style="color: #28a745; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #28a745;">
                            🔐 Thông tin bảo mật
                        </h4>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Mật khẩu *</label>
                            <input type="password" name="password" required
                                   style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px;"
                                   placeholder="Nhập mật khẩu">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Xác nhận mật khẩu *</label>
                            <input type="password" name="confirm_password" required
                                   style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px;"
                                   placeholder="Nhập lại mật khẩu">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Vai trò *</label>
                            <select name="role" required
                                    style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px;">
                                <option value="">Chọn vai trò</option>
                                <option value="staff">🧑‍💼 Staff - Nhân viên</option>
                                <option value="manager">👨‍💼 Manager - Quản lý</option>
                                <option value="admin">👑 Super Admin - Quản trị viên</option>
                            </select>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Trạng thái</label>
                            <select name="status"
                                    style="width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px;">
                                <option value="active">✅ Hoạt động</option>
                                <option value="inactive">❌ Tạm khóa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Phân quyền -->
                <div style="background: #f8f9fa; padding: 25px; border-radius: 15px; margin: 25px 0;">
                    <h4 style="color: #333; margin-bottom: 20px;">🔑 Phân quyền truy cập</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                        <div style="display: flex; align-items: center; gap: 12px; background: white; padding: 15px; border-radius: 10px;">
                            <input type="checkbox" name="permissions[]" value="dashboard" style="transform: scale(1.5);" checked>
                            <span style="font-weight: 500;">📊 Xem Dashboard</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; background: white; padding: 15px; border-radius: 10px;">
                            <input type="checkbox" name="permissions[]" value="parking" style="transform: scale(1.5);" checked>
                            <span style="font-weight: 500;">🅿️ Quản lý bãi đỗ</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; background: white; padding: 15px; border-radius: 10px;">
                            <input type="checkbox" name="permissions[]" value="customers" style="transform: scale(1.5);" checked>
                            <span style="font-weight: 500;">👥 Quản lý khách hàng</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; background: white; padding: 15px; border-radius: 10px;">
                            <input type="checkbox" name="permissions[]" value="reports" style="transform: scale(1.5);">
                            <span style="font-weight: 500;">📈 Xem báo cáo</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; background: white; padding: 15px; border-radius: 10px;">
                            <input type="checkbox" name="permissions[]" value="revenue" style="transform: scale(1.5);">
                            <span style="font-weight: 500;">💰 Quản lý doanh thu</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; background: white; padding: 15px; border-radius: 10px;">
                            <input type="checkbox" name="permissions[]" value="settings" style="transform: scale(1.5);">
                            <span style="font-weight: 500;">⚙️ Cài đặt hệ thống</span>
                        </div>
                    </div>
                </div>

                <!-- Nút hành động -->
                <div style="text-align: center; margin-top: 30px; padding-top: 25px; border-top: 2px solid #eee;">
                    <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 15px 40px; margin-right: 20px; min-width: 200px;">
                        <i class="fas fa-user-plus"></i>
                        Tạo người dùng
                    </button>
                    <button type="reset" class="btn btn-warning" style="font-size: 18px; padding: 15px 40px; min-width: 200px;">
                        <i class="fas fa-undo"></i>
                        Làm mới form
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
