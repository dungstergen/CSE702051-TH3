<div align="center">
  <!-- Bạn có thể thay thế bằng logo của riêng bạn -->
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">

  <h1>Hệ thống Quản lý Bãi đỗ xe</h1>
  <p>
    Một ứng dụng web để quản lý bãi đỗ xe, được xây dựng bằng Laravel framework. Ứng dụng cho phép người dùng tìm và đặt chỗ đỗ xe, và quản trị viên quản lý các cơ sở đỗ xe.
  </p>

  <!-- Badges -->
  <p>
    <img src="https://img.shields.io/badge/php-%3E%3D8.2-blue.svg" alt="PHP Version">
    <img src="https://img.shields.io/badge/laravel-^12.0-orange.svg" alt="Laravel Version">
    <img src="https://img.shields.io/badge/license-MIT-green.svg" alt="License">
  </p>
</div>

---

## 🌟 Tính năng

- **Phân quyền người dùng:** Các vai trò Quản trị viên và Người dùng thông thường với các quyền khác nhau.
- **Quản lý bãi đỗ xe:** Quản trị viên có thể thêm, sửa và xem các bãi đỗ xe.
- **Quản lý chỗ đỗ xe:** Quản trị viên có thể quản lý từng chỗ đỗ xe trong một bãi.
- **Hệ thống đặt chỗ:** Người dùng có thể tìm kiếm các chỗ đỗ xe còn trống và đặt chỗ.
- **Quản lý phương tiện:** Người dùng có thể đăng ký phương tiện của mình.
- **Xử lý thanh toán:** Tích hợp với hệ thống thanh toán cho việc đặt chỗ.
- **Đánh giá và xếp hạng:** Người dùng có thể để lại đánh giá cho các bãi đỗ xe.

## 🛠️ Công nghệ sử dụng

- **Backend:** Laravel 12, PHP 8.2
- **Frontend:** Vite, Blade
- **Cơ sở dữ liệu:** MySQL (hoặc PostgreSQL, SQLite)

## 🚀 Cài đặt dự án

Thực hiện theo các bước sau để dự án hoạt động trên máy cục bộ của bạn.

### Yêu cầu tiên quyết

- PHP >= 8.2
- Composer
- Node.js & NPM
- Một cơ sở dữ liệu (ví dụ: MySQL, PostgreSQL, SQLite)

### Cài đặt

1.  **Sao chép kho mã nguồn:**
    ```bash
    git clone https://github.com/dungstergen/CSE702051-TH3.git
    cd myapp
    ```

2.  **Cài đặt các gói phụ thuộc PHP:**
    ```bash
    composer install
    ```

3.  **Cài đặt các gói phụ thuộc JavaScript:**
    ```bash
    npm install
    ```

4.  **Tạo tệp môi trường của bạn:**
    ```bash
    cp .env.example .env
    ```

5.  **Tạo khóa ứng dụng:**
    ```bash
    php artisan key:generate
    ```

6.  **Cấu hình cơ sở dữ liệu của bạn:**
    Mở tệp `.env` và cập nhật các biến `DB_*` với thông tin đăng nhập cơ sở dữ liệu của bạn.
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=paspark_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Chạy migration và seeder cho cơ sở dữ liệu:**
    Thao tác này sẽ tạo các bảng cần thiết và điền dữ liệu ban đầu vào chúng.
    ```bash
    php artisan migrate --seed
    ```

8.  **Xây dựng tài nguyên front-end:**
    ```bash
    npm run dev
    ```

9.  **Khởi động máy chủ phát triển:**
    ```bash
    php artisan serve
    ```
    Ứng dụng sẽ có sẵn tại `http://127.0.0.1:8000`.

## 🖥️ Sử dụng

- **Quản trị viên:** Truy cập bảng điều khiển quản trị tại `/admin` để quản lý bãi đỗ xe, chỗ đỗ xe và người dùng.
- **Người dùng:** Đăng ký và đăng nhập để đặt chỗ đỗ xe, quản lý phương tiện và xem lịch sử đặt chỗ.

## 🤝 Đóng góp

Chào mừng các đóng góp! Nếu bạn có ý tưởng để cải thiện dự án này, vui lòng fork repo và tạo một pull request. Bạn cũng có thể mở một issue với tag "enhancement".

1.  Fork dự án
2.  Tạo Feature Branch của bạn (`git checkout -b feature/AmazingFeature`)
3.  Commit các thay đổi của bạn (`git commit -m 'Add some AmazingFeature'`)
4.  Push lên Branch (`git push origin feature/AmazingFeature`)
5.  Mở một Pull Request

