@extends('user.layouts.app')

@section('title', 'Gói dịch vụ')

@section('styles')
<style>
    .package-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    .package-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px 25px;
        text-align: center;
        position: relative;
    }

    .package-header.featured {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .package-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255,255,255,0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
    }

    .package-price {
        font-size: 3rem;
        font-weight: bold;
        margin: 15px 0 10px;
    }

    .package-body {
        padding: 30px 25px;
    }

    .feature-list {
        list-style: none;
        padding: 0;
    }

    .feature-list li {
        padding: 8px 0;
        border-bottom: 1px solid #f1f1f1;
        position: relative;
        padding-left: 25px;
    }

    .feature-list li:last-child {
        border-bottom: none;
    }

    .feature-list li:before {
        content: '\f00c';
        font-family: 'FontAwesome';
        position: absolute;
        left: 0;
        color: #28a745;
        font-weight: bold;
    }

    .btn-package {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        color: white;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-package:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-package.featured {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .btn-package.featured:hover {
        box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
    }

    .comparison-bar {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        position: sticky;
        top: 20px;
        z-index: 100;
    }

    .compare-checkbox {
        transform: scale(1.2);
        margin-right: 10px;
    }

    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        margin-bottom: 60px;
    }

    .filter-tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
        border-bottom: 1px solid #e9ecef;
    }

    .filter-tab {
        padding: 15px 30px;
        border: none;
        background: none;
        color: #6c757d;
        font-weight: 600;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .filter-tab.active {
        color: #667eea;
        border-bottom-color: #667eea;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1 class="display-4 mb-4">Gói dịch vụ dành cho bạn</h1>
        <p class="lead">Chọn gói dịch vụ phù hợp để trải nghiệm dịch vụ đỗ xe tốt nhất</p>
    </div>
</div>

<div class="container">
    <!-- Comparison Bar -->
    <div class="comparison-bar" id="comparisonBar" style="display: none;">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="font-weight-bold">Đã chọn <span id="selectedCount">0</span> gói để so sánh</span>
                <span class="text-muted ml-2">(Tối đa 3 gói)</span>
            </div>
            <div class="col-md-4 text-right">
                <button class="btn btn-primary" onclick="comparePackages()">
                    <i class="fa fa-balance-scale mr-2"></i>So sánh ngay
                </button>
                <button class="btn btn-outline-secondary ml-2" onclick="clearComparison()">
                    <i class="fa fa-times mr-2"></i>Xóa
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <button class="filter-tab active" onclick="showAllPackages()">Tất cả gói</button>
        <button class="filter-tab" onclick="showFeaturedPackages()">Gói nổi bật</button>
        <button class="filter-tab" onclick="showRegularPackages()">Gói thường</button>
    </div>

    <!-- Featured Packages -->
    @if($featuredPackages->count() > 0)
    <div id="featuredPackages">
        <h3 class="text-center mb-4">
            <i class="fa fa-star text-warning mr-2"></i>
            Gói dịch vụ nổi bật
        </h3>
        <div class="row">
            @foreach($featuredPackages as $package)
            <div class="col-lg-4 col-md-6">
                <div class="package-card">
                    <div class="package-header featured">
                        <div class="package-badge">Nổi bật</div>
                        <h4>{{ $package->name }}</h4>
                        <div class="package-price">
                            @if($package->price == 0)
                                Miễn phí
                            @else
                                {{ number_format($package->price, 0, ',', '.') }}<small> VNĐ</small>
                            @endif
                        </div>
                        <p class="mb-0">{{ $package->description }}</p>
                    </div>
                    <div class="package-body">
                        @if($package->features)
                        <ul class="feature-list">
                            @foreach(json_decode($package->features) as $feature)
                            <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                        @endif

                        <div class="mt-4">
                            <div class="form-check mb-3">
                                <input class="form-check-input compare-checkbox" type="checkbox"
                                       value="{{ $package->id }}" id="compare_{{ $package->id }}"
                                       onchange="toggleComparison({{ $package->id }})">
                                <label class="form-check-label" for="compare_{{ $package->id }}">
                                    Thêm vào so sánh
                                </label>
                            </div>

                            <a href="{{ route('user.service-packages.show', $package->id) }}"
                               class="btn btn-package featured">
                                <i class="fa fa-eye mr-2"></i>Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Regular Packages -->
    @if($regularPackages->count() > 0)
    <div id="regularPackages" class="mt-5">
        <h3 class="text-center mb-4">
            <i class="fa fa-gift text-primary mr-2"></i>
            Gói dịch vụ khác
        </h3>
        <div class="row">
            @foreach($regularPackages as $package)
            <div class="col-lg-4 col-md-6">
                <div class="package-card">
                    <div class="package-header">
                        <h4>{{ $package->name }}</h4>
                        <div class="package-price">
                            @if($package->price == 0)
                                Miễn phí
                            @else
                                {{ number_format($package->price, 0, ',', '.') }}<small> VNĐ</small>
                            @endif
                        </div>
                        <p class="mb-0">{{ $package->description }}</p>
                    </div>
                    <div class="package-body">
                        @if($package->features)
                        <ul class="feature-list">
                            @foreach(json_decode($package->features) as $feature)
                            <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                        @endif

                        <div class="mt-4">
                            <div class="form-check mb-3">
                                <input class="form-check-input compare-checkbox" type="checkbox"
                                       value="{{ $package->id }}" id="compare_{{ $package->id }}"
                                       onchange="toggleComparison({{ $package->id }})">
                                <label class="form-check-label" for="compare_{{ $package->id }}">
                                    Thêm vào so sánh
                                </label>
                            </div>

                            <a href="{{ route('user.service-packages.show', $package->id) }}"
                               class="btn btn-package">
                                <i class="fa fa-eye mr-2"></i>Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($servicePackages->count() == 0)
    <div class="text-center py-5">
        <i class="fa fa-gift fa-5x text-muted mb-4"></i>
        <h4 class="text-muted">Chưa có gói dịch vụ nào</h4>
        <p class="text-muted">Hệ thống đang cập nhật các gói dịch vụ mới. Vui lòng quay lại sau.</p>
    </div>
    @endif

    <!-- Call to Action -->
    <div class="text-center mt-5 py-5">
        <h3>Sẵn sàng đặt chỗ?</h3>
        <p class="text-muted">Chọn gói dịch vụ phù hợp và bắt đầu đặt chỗ ngay hôm nay</p>
        <a href="{{ route('user.booking') }}" class="btn btn-primary btn-lg">
            <i class="fa fa-calendar-plus-o mr-2"></i>Đặt chỗ ngay
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
let selectedPackages = [];

function toggleComparison(packageId) {
    const checkbox = document.getElementById(`compare_${packageId}`);

    if (checkbox.checked) {
        if (selectedPackages.length >= 3) {
            checkbox.checked = false;
            alert('Bạn chỉ có thể so sánh tối đa 3 gói dịch vụ');
            return;
        }
        selectedPackages.push(packageId);
    } else {
        selectedPackages = selectedPackages.filter(id => id !== packageId);
    }

    updateComparisonBar();
}

function updateComparisonBar() {
    const bar = document.getElementById('comparisonBar');
    const count = document.getElementById('selectedCount');

    count.textContent = selectedPackages.length;

    if (selectedPackages.length > 0) {
        bar.style.display = 'block';
    } else {
        bar.style.display = 'none';
    }
}

function comparePackages() {
    if (selectedPackages.length < 2) {
        alert('Vui lòng chọn ít nhất 2 gói để so sánh');
        return;
    }

    const params = selectedPackages.map(id => `packages[]=${id}`).join('&');
    window.location.href = `{{ route('user.service-packages.compare') }}?${params}`;
}

function clearComparison() {
    selectedPackages = [];
    document.querySelectorAll('.compare-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    updateComparisonBar();
}

function showAllPackages() {
    document.getElementById('featuredPackages').style.display = 'block';
    document.getElementById('regularPackages').style.display = 'block';
    setActiveTab(0);
}

function showFeaturedPackages() {
    document.getElementById('featuredPackages').style.display = 'block';
    document.getElementById('regularPackages').style.display = 'none';
    setActiveTab(1);
}

function showRegularPackages() {
    document.getElementById('featuredPackages').style.display = 'none';
    document.getElementById('regularPackages').style.display = 'block';
    setActiveTab(2);
}

function setActiveTab(index) {
    document.querySelectorAll('.filter-tab').forEach((tab, i) => {
        if (i === index) {
            tab.classList.add('active');
        } else {
            tab.classList.remove('active');
        }
    });
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateComparisonBar();
});
</script>
@endsection
