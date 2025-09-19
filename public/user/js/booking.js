// Booking Page JavaScript functionality
$(document).ready(function() {

    // Initialize nice select
    $('select').niceSelect();

    // Set default date and time
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);

    $('#parkingDate').val(tomorrow.toISOString().split('T')[0]);
    $('#entryTime').val('09:00');

    // Price range slider
    $('#priceRange').on('input', function() {
        const value = parseInt($(this).val());
        $('#currentPrice').text(value.toLocaleString());
        updateSearchResults();
    });

    // Get current location
    $('#getCurrentLocation').click(function() {
        const $btn = $(this);
        $btn.html('<i class="fa fa-spinner fa-spin"></i>');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // Reverse geocoding (mock)
                    $('#locationSearch').val('Vị trí hiện tại của bạn');
                    $btn.html('<i class="fa fa-crosshairs"></i>');

                    // Update map center
                    updateMapCenter(lat, lng);
                },
                function(error) {
                    console.error('Error getting location:', error);
                    $btn.html('<i class="fa fa-crosshairs"></i>');
                    showNotification('Không thể lấy vị trí hiện tại', 'error');
                }
            );
        } else {
            showNotification('Trình duyệt không hỗ trợ định vị', 'error');
            $btn.html('<i class="fa fa-crosshairs"></i>');
        }
    });

    // Search functionality
    $('#searchParking').click(function() {
        const $btn = $(this);
        $btn.addClass('loading');

        // Simulate search delay
        setTimeout(function() {
            $btn.removeClass('loading');
            updateSearchResults();
            updateMapWithResults();
            showNotification('Tìm thấy ' + $('.parking_card').length + ' bãi đỗ xe phù hợp!', 'success');
        }, 1500);
    });

    // Auto search when filters change
    $('input, select').on('change', function() {
        if ($(this).attr('id') !== 'locationSearch') {
            updateSearchResults();
        }
    });

    // Location search with debounce
    let searchTimeout;
    $('#locationSearch').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            // Simulate location search
            updateSearchResults();
        }, 500);
    });

    // Sort functionality
    $('#sortBy').change(function() {
        const sortBy = $(this).val();
        sortParkingResults(sortBy);
    });

    // Booking modal
    $('.book_btn').click(function() {
        if ($(this).is(':disabled') || $(this).hasClass('disabled')) {
            return;
        }

        const parkingId = $(this).data('parking-id');
        const $card = $(this).closest('.parking_card');

        // Populate modal with parking data
        populateBookingModal($card);

        $('#bookingModal').modal('show');
    });

    // Confirm booking
    $('#confirmBooking').click(function() {
        const licensePlate = $('#licensePlate').val().trim();

        if (!licensePlate) {
            showNotification('Vui lòng nhập biển số xe', 'error');
            $('#licensePlate').focus();
            return;
        }

        // Simulate booking process
        const $btn = $(this);
        $btn.html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...');
        $btn.prop('disabled', true);

        setTimeout(function() {
            $('#bookingModal').modal('hide');
            showNotification('Đặt chỗ thành công! Mã đặt chỗ: #BP' + Math.random().toString(36).substr(2, 9).toUpperCase(), 'success');

            // Reset button
            $btn.html('<i class="fa fa-check"></i> Xác nhận đặt chỗ');
            $btn.prop('disabled', false);

            // Redirect to dashboard
            setTimeout(function() {
                window.location.href = '/dashboard';
            }, 2000);
        }, 2000);
    });

    // Map controls
    $('#toggleView').click(function() {
        $('.map_section').toggleClass('hidden');
        const icon = $(this).find('i');
        if (icon.hasClass('fa-list')) {
            icon.removeClass('fa-list').addClass('fa-map');
        } else {
            icon.removeClass('fa-map').addClass('fa-list');
        }
    });

    $('#centerMap').click(function() {
        // Center map to current location or search location
        showNotification('Đang cập nhật vị trí bản đồ...', 'info');
    });

    $('#zoomIn, #zoomOut').click(function() {
        const isZoomIn = $(this).attr('id') === 'zoomIn';
        // Handle map zoom
        console.log(isZoomIn ? 'Zoom in' : 'Zoom out');
    });

    // Load more results
    $('#loadMore').click(function() {
        const $btn = $(this);
        $btn.html('<i class="fa fa-spinner fa-spin"></i> Đang tải...');

        setTimeout(function() {
            // Simulate loading more results
            addMoreParkingResults();
            $btn.html('<i class="fa fa-refresh"></i> Xem thêm kết quả');
        }, 1000);
    });

    // Parking card hover effects
    $('.parking_card').hover(
        function() {
            $(this).addClass('highlighted');
            // Highlight corresponding map marker
            const parkingId = $(this).find('.book_btn').data('parking-id');
            highlightMapMarker(parkingId);
        },
        function() {
            $(this).removeClass('highlighted');
            clearMapHighlights();
        }
    );

    // Calculate total price when duration changes
    $('#duration').change(function() {
        updatePriceEstimates();
    });

    // Initialize price estimates
    updatePriceEstimates();

    // Functions
    function updateSearchResults() {
        const location = $('#locationSearch').val();
        const date = $('#parkingDate').val();
        const time = $('#entryTime').val();
        const duration = parseInt($('#duration').val());
        const vehicleType = $('#vehicleType').val();
        const maxPrice = parseInt($('#priceRange').val());
        const features = [];

        $('.features_filter input:checked').each(function() {
            features.push($(this).val());
        });

        // Filter parking results based on criteria
        $('.parking_card').each(function() {
            const $card = $(this);
            const price = parseInt($card.find('.price').text().replace(/[^0-9]/g, ''));
            const available = !$card.find('.availability_badge').hasClass('full');

            let show = true;

            // Price filter
            if (price > maxPrice) {
                show = false;
            }

            // Availability filter
            if (!available) {
                show = false;
            }

            // Features filter
            if (features.length > 0) {
                const cardFeatures = [];
                $card.find('.feature').each(function() {
                    const featureText = $(this).text().toLowerCase();
                    if (featureText.includes('mái che')) cardFeatures.push('covered');
                    if (featureText.includes('bảo vệ')) cardFeatures.push('security');
                    if (featureText.includes('camera')) cardFeatures.push('cctv');
                    if (featureText.includes('rửa xe')) cardFeatures.push('wash');
                    if (featureText.includes('sạc')) cardFeatures.push('electric');
                });

                const hasAllFeatures = features.every(feature => cardFeatures.includes(feature));
                if (!hasAllFeatures) {
                    show = false;
                }
            }

            if (show) {
                $card.show();
            } else {
                $card.hide();
            }
        });

        // Update results count
        const visibleCards = $('.parking_card:visible').length;
        $('.results_header h4').text(`Kết quả tìm kiếm (${visibleCards})`);
    }

    function updatePriceEstimates() {
        const duration = parseInt($('#duration').val());

        $('.parking_card:visible').each(function() {
            const $card = $(this);
            const hourlyRate = parseInt($card.find('.price').text().replace(/[^0-9]/g, ''));
            const total = hourlyRate * duration;

            $card.find('.total_estimate strong').text(total.toLocaleString());
        });
    }

    function populateBookingModal($card) {
        const parkingName = $card.find('h5').text();
        const parkingAddress = $card.find('.location').text().replace(/.*?\s+/, '');
        const hourlyRate = parseInt($card.find('.price').text().replace(/[^0-9]/g, ''));
        const duration = parseInt($('#duration').val());
        const total = (hourlyRate * duration) + 5000; // Add service fee

        const date = $('#parkingDate').val();
        const entryTime = $('#entryTime').val();
        const vehicleType = $('#vehicleType option:selected').text();

        // Calculate exit time
        const entryDateTime = new Date(`${date}T${entryTime}`);
        const exitDateTime = new Date(entryDateTime.getTime() + (duration * 60 * 60 * 1000));

        // Populate modal fields
        $('#modalParkingName').text(parkingName);
        $('#modalParkingAddress').text(parkingAddress);
        $('#modalDate').text(new Date(date).toLocaleDateString('vi-VN'));
        $('#modalEntryTime').text(entryTime);
        $('#modalDuration').text(duration + ' giờ');
        $('#modalExitTime').text(exitDateTime.toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'}));
        $('#modalVehicleType').text(vehicleType);
        $('#modalHourlyRate').text(hourlyRate.toLocaleString());
        $('#modalHours').text(duration);
        $('#modalTotal').text(total.toLocaleString());

        // Clear form
        $('#licensePlate').val('');
        $('#vehicleColor').val('');
        $('#bookingNotes').val('');
    }

    function sortParkingResults(sortBy) {
        const $results = $('.parking_results');
        const $cards = $('.parking_card').detach();

        $cards.sort(function(a, b) {
            switch (sortBy) {
                case 'price':
                    const priceA = parseInt($(a).find('.price').text().replace(/[^0-9]/g, ''));
                    const priceB = parseInt($(b).find('.price').text().replace(/[^0-9]/g, ''));
                    return priceA - priceB;

                case 'rating':
                    const ratingA = parseFloat($(a).find('.rating_score').text());
                    const ratingB = parseFloat($(b).find('.rating_score').text());
                    return ratingB - ratingA;

                case 'availability':
                    const availableA = !$(a).find('.availability_badge').hasClass('full');
                    const availableB = !$(b).find('.availability_badge').hasClass('full');
                    return availableB - availableA;

                default: // distance
                    const distanceA = parseFloat($(a).find('.distance').text().match(/[\d.]+/)[0]);
                    const distanceB = parseFloat($(b).find('.distance').text().match(/[\d.]+/)[0]);
                    return distanceA - distanceB;
            }
        });

        $results.append($cards);
    }

    function addMoreParkingResults() {
        // Simulate adding more parking results
        const moreResults = `
            <div class="parking_card" data-lat="10.756137" data-lng="106.672279">
                <div class="parking_image">
                    <img src="{{ asset('user/images/parking4.jpg') }}" alt="Bãi đỗ xe Aeon Mall">
                    <div class="availability_badge available">Còn 8 chỗ</div>
                </div>
                <div class="parking_info">
                    <h5>Bãi đỗ xe Aeon Mall</h5>
                    <p class="location">
                        <i class="fa fa-map-marker"></i>
                        30 Bờ Bao Tân Thắng, Quận Tân Phú, TP.HCM
                    </p>
                    <p class="distance">
                        <i class="fa fa-road"></i>
                        2.1 km từ vị trí của bạn
                    </p>
                    <div class="features">
                        <span class="feature"><i class="fa fa-shield"></i> Bảo vệ 24/7</span>
                        <span class="feature"><i class="fa fa-video-camera"></i> Camera</span>
                        <span class="feature"><i class="fa fa-umbrella"></i> Mái che</span>
                        <span class="feature"><i class="fa fa-tint"></i> Rửa xe</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <span class="rating_score">4.3</span>
                        <span class="review_count">(67 đánh giá)</span>
                    </div>
                </div>
                <div class="parking_price">
                    <div class="price_info">
                        <span class="price">18,000 VNĐ</span>
                        <span class="unit">/giờ</span>
                    </div>
                    <div class="total_estimate">
                        Tổng: <strong>54,000 VNĐ</strong>
                    </div>
                    <button type="button" class="book_btn" data-parking-id="4">
                        Đặt chỗ
                    </button>
                </div>
            </div>
        `;

        $('.parking_results').append(moreResults);

        // Bind events to new cards
        $('.parking_card:last').find('.book_btn').click(function() {
            if ($(this).is(':disabled') || $(this).hasClass('disabled')) {
                return;
            }

            const $card = $(this).closest('.parking_card');
            populateBookingModal($card);
            $('#bookingModal').modal('show');
        });

        updatePriceEstimates();
    }

    function updateMapCenter(lat, lng) {
        // Update map center coordinates
        console.log('Map center updated:', lat, lng);
    }

    function updateMapWithResults() {
        // Update map with parking location markers
        console.log('Map updated with search results');
    }

    function highlightMapMarker(parkingId) {
        // Highlight specific marker on map
        console.log('Highlighting marker:', parkingId);
    }

    function clearMapHighlights() {
        // Clear all map marker highlights
        console.log('Clearing map highlights');
    }

    function showNotification(message, type = 'info') {
        const notification = `
            <div class="booking-notification ${type}">
                <div class="notification-content">
                    <i class="fa fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="notification-close">&times;</button>
            </div>
        `;

        $('body').append(notification);

        setTimeout(function() {
            $('.booking-notification').fadeOut(function() {
                $(this).remove();
            });
        }, 5000);
    }

    // Handle notification close
    $(document).on('click', '.notification-close', function() {
        $(this).parent().fadeOut(function() {
            $(this).remove();
        });
    });

});

// CSS cho notifications
const notificationCSS = `
<style>
.booking-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    padding: 15px 20px;
    margin-bottom: 10px;
    z-index: 10000;
    min-width: 300px;
    border-left: 4px solid;
}

.booking-notification.success {
    border-left-color: #28a745;
}

.booking-notification.error {
    border-left-color: #dc3545;
}

.booking-notification.info {
    border-left-color: #17a2b8;
}

.notification-content {
    display: flex;
    align-items: center;
}

.notification-content i {
    margin-right: 10px;
    font-size: 1.2rem;
}

.booking-notification.success i {
    color: #28a745;
}

.booking-notification.error i {
    color: #dc3545;
}

.booking-notification.info i {
    color: #17a2b8;
}

.notification-close {
    position: absolute;
    top: 5px;
    right: 10px;
    background: none;
    border: none;
    font-size: 1.2rem;
    color: #999;
    cursor: pointer;
}

.notification-close:hover {
    color: #666;
}
</style>
`;

$('head').append(notificationCSS);
