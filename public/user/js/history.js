// History Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize history page
    initHistoryPage();
});

function initHistoryPage() {
    // Filter functionality
    initFilters();

    // Search functionality
    initSearch();

    // Sort functionality
    initSort();

    // View toggle functionality
    initViewToggle();

    // Action buttons
    initActionButtons();

    // Price range slider
    initPriceRange();

    // Date inputs default values
    initDateInputs();

    // Review functionality
    initReviewFeatures();
}// Filter Functions
function initFilters() {
    const applyFilterBtn = document.getElementById('applyFilter');
    const resetFilterBtn = document.getElementById('resetFilter');

    if (applyFilterBtn) {
        applyFilterBtn.addEventListener('click', applyFilters);
    }

    if (resetFilterBtn) {
        resetFilterBtn.addEventListener('click', resetFilters);
    }

    // Status filter checkboxes
    const statusFilters = document.querySelectorAll('.status_filter input[type="checkbox"]');
    statusFilters.forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
    });

    // Location filter
    const locationFilter = document.getElementById('locationFilter');
    if (locationFilter) {
        locationFilter.addEventListener('change', applyFilters);
    }
}

function applyFilters() {
    const fromDate = document.getElementById('fromDate')?.value;
    const toDate = document.getElementById('toDate')?.value;
    const priceRange = document.getElementById('priceFilter')?.value;
    const location = document.getElementById('locationFilter')?.value;

    // Get selected statuses
    const selectedStatuses = [];
    const statusCheckboxes = document.querySelectorAll('.status_filter input[type="checkbox"]:checked');
    statusCheckboxes.forEach(checkbox => {
        selectedStatuses.push(checkbox.value);
    });

    // Filter history items
    const historyItems = document.querySelectorAll('.history_item');
    let visibleCount = 0;

    historyItems.forEach(item => {
        let shouldShow = true;

        // Date filter
        if (fromDate || toDate) {
            const itemDate = item.getAttribute('data-date');
            if (itemDate) {
                const itemDateObj = new Date(itemDate);
                if (fromDate && itemDateObj < new Date(fromDate)) shouldShow = false;
                if (toDate && itemDateObj > new Date(toDate)) shouldShow = false;
            }
        }

        // Price filter
        if (priceRange) {
            const itemPrice = parseInt(item.getAttribute('data-price') || '0');
            if (itemPrice > parseInt(priceRange)) shouldShow = false;
        }

        // Status filter
        if (selectedStatuses.length > 0) {
            const itemStatus = item.getAttribute('data-status');
            if (!selectedStatuses.includes(itemStatus)) shouldShow = false;
        }

        // Location filter
        if (location) {
            const itemLocation = item.querySelector('.booking_info h5')?.textContent.toLowerCase();
            if (!itemLocation?.includes(location.toLowerCase())) shouldShow = false;
        }

        // Show/hide item
        if (shouldShow) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    // Show message if no results
    showNoResultsMessage(visibleCount === 0);

    // Show success message
    showFilterMessage(`Đã lọc và hiển thị ${visibleCount} kết quả`);
}

function resetFilters() {
    // Reset form inputs
    document.getElementById('fromDate').value = '';
    document.getElementById('toDate').value = '';
    document.getElementById('priceFilter').value = '200000';
    document.getElementById('locationFilter').value = '';

    // Reset checkboxes
    const statusCheckboxes = document.querySelectorAll('.status_filter input[type="checkbox"]');
    statusCheckboxes.forEach(checkbox => {
        checkbox.checked = true;
    });

    // Update price display
    updatePriceDisplay();

    // Show all items
    const historyItems = document.querySelectorAll('.history_item');
    historyItems.forEach(item => {
        item.style.display = 'block';
    });

    // Hide no results message
    showNoResultsMessage(false);

    showFilterMessage('Đã đặt lại tất cả bộ lọc');
}

// Search Functions
function initSearch() {
    const searchInput = document.getElementById('searchHistory');
    if (searchInput) {
        searchInput.addEventListener('input', performSearch);
    }
}

function performSearch() {
    const searchTerm = document.getElementById('searchHistory').value.toLowerCase();
    const historyItems = document.querySelectorAll('.history_item');
    let visibleCount = 0;

    historyItems.forEach(item => {
        const bookingInfo = item.querySelector('.booking_info h5')?.textContent.toLowerCase() || '';
        const bookingCode = item.querySelector('.booking_code')?.textContent.toLowerCase() || '';
        const location = item.querySelector('.detail_item')?.textContent.toLowerCase() || '';

        const isMatch = bookingInfo.includes(searchTerm) ||
                       bookingCode.includes(searchTerm) ||
                       location.includes(searchTerm);

        if (isMatch || searchTerm === '') {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    showNoResultsMessage(visibleCount === 0 && searchTerm !== '');
}

// Sort Functions
function initSort() {
    const sortSelect = document.getElementById('sortHistory');
    if (sortSelect) {
        sortSelect.addEventListener('change', performSort);
    }
}

function performSort() {
    const sortValue = document.getElementById('sortHistory').value;
    const historyContainer = document.getElementById('historyResults');
    const historyItems = Array.from(document.querySelectorAll('.history_item'));

    historyItems.sort((a, b) => {
        switch (sortValue) {
            case 'date_desc':
                return new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date'));
            case 'date_asc':
                return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
            case 'price_desc':
                return parseInt(b.getAttribute('data-price')) - parseInt(a.getAttribute('data-price'));
            case 'price_asc':
                return parseInt(a.getAttribute('data-price')) - parseInt(b.getAttribute('data-price'));
            default:
                return 0;
        }
    });

    // Re-append sorted items
    historyItems.forEach(item => historyContainer.appendChild(item));

    showFilterMessage('Đã sắp xếp danh sách');
}

// View Toggle Functions
function initViewToggle() {
    const viewButtons = document.querySelectorAll('.view_btn');
    viewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            viewButtons.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            // Toggle view (placeholder for future implementation)
            const viewType = this.getAttribute('data-view');
            toggleView(viewType);
        });
    });
}

function toggleView(viewType) {
    const historyResults = document.getElementById('historyResults');
    if (viewType === 'grid') {
        historyResults.classList.add('grid-view');
        showFilterMessage('Đã chuyển sang chế độ lưới');
    } else {
        historyResults.classList.remove('grid-view');
        showFilterMessage('Đã chuyển sang chế độ danh sách');
    }
}

// Action Button Functions
function initActionButtons() {
    // View details buttons
    const viewButtons = document.querySelectorAll('.view_details');
    viewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const bookingId = this.getAttribute('data-id');
            viewBookingDetails(bookingId);
        });
    });

    // Download receipt buttons
    const downloadButtons = document.querySelectorAll('.download_receipt');
    downloadButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const bookingId = this.getAttribute('data-id');
            downloadReceipt(bookingId);
        });
    });

    // Book again buttons
    const bookAgainButtons = document.querySelectorAll('.book_again');
    bookAgainButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const bookingId = this.getAttribute('data-id');
            bookAgain(bookingId);
        });
    });
}

function viewBookingDetails(bookingId) {
    // Show booking details modal or navigate to details page
    showMessage('Đang tải chi tiết đặt chỗ...', 'info');

    // Simulate API call
    setTimeout(() => {
        showMessage('Chi tiết đặt chỗ #' + bookingId, 'success');
        // In real implementation, this would open a modal or navigate to details page
    }, 1000);
}

function downloadReceipt(bookingId) {
    showMessage('Đang tải hóa đơn...', 'info');

    // Simulate download
    setTimeout(() => {
        showMessage('Đã tải hóa đơn #' + bookingId + ' thành công', 'success');
        // In real implementation, this would trigger file download
    }, 1500);
}

function bookAgain(bookingId) {
    showMessage('Đang chuyển đến trang đặt chỗ...', 'info');

    // Simulate navigation
    setTimeout(() => {
        window.location.href = '/booking?reuse=' + bookingId;
    }, 1000);
}

// Price Range Functions
function initPriceRange() {
    const priceSlider = document.getElementById('priceFilter');
    if (priceSlider) {
        priceSlider.addEventListener('input', updatePriceDisplay);
        updatePriceDisplay(); // Initial display
    }
}

function updatePriceDisplay() {
    const priceSlider = document.getElementById('priceFilter');
    const maxPriceSpan = document.getElementById('maxPrice');

    if (priceSlider && maxPriceSpan) {
        const value = parseInt(priceSlider.value);
        maxPriceSpan.textContent = formatPrice(value);
    }
}

function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price) + ' VNĐ';
}

// Date Functions
function initDateInputs() {
    const today = new Date();
    const oneMonthAgo = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());

    const fromDateInput = document.getElementById('fromDate');
    const toDateInput = document.getElementById('toDate');

    if (fromDateInput) {
        fromDateInput.value = oneMonthAgo.toISOString().split('T')[0];
    }

    if (toDateInput) {
        toDateInput.value = today.toISOString().split('T')[0];
    }
}

// Utility Functions
function showNoResultsMessage(show) {
    let noResultsDiv = document.querySelector('.no-results-message');

    if (show) {
        if (!noResultsDiv) {
            noResultsDiv = document.createElement('div');
            noResultsDiv.className = 'no-results-message empty_state';
            noResultsDiv.innerHTML = `
                <i class="fa fa-search"></i>
                <h5>Không tìm thấy kết quả</h5>
                <p>Vui lòng thử điều chỉnh bộ lọc hoặc từ khóa tìm kiếm</p>
            `;
            document.getElementById('historyResults').appendChild(noResultsDiv);
        }
        noResultsDiv.style.display = 'block';
    } else {
        if (noResultsDiv) {
            noResultsDiv.style.display = 'none';
        }
    }
}

function showFilterMessage(message) {
    showMessage(message, 'success');
}

function showMessage(message, type = 'info') {
    // Remove existing messages
    const existingMessages = document.querySelectorAll('.temp-message');
    existingMessages.forEach(msg => msg.remove());

    // Create new message
    const messageDiv = document.createElement('div');
    messageDiv.className = `temp-message alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'}`;
    messageDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 300px;
        padding: 12px 16px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        animation: slideInRight 0.3s ease;
    `;
    messageDiv.textContent = message;

    document.body.appendChild(messageDiv);

    // Auto remove after 3 seconds
    setTimeout(() => {
        messageDiv.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => messageDiv.remove(), 300);
    }, 3000);
}

// Review Functions
function initReviewFeatures() {
    // Initialize interactive stars
    initInteractiveStars();

    // Add review form handlers
    initReviewFormHandlers();

    // Add hover effects to review sections
    addReviewHoverEffects();

    // Initialize existing review data
    initExistingReviews();
}

function initInteractiveStars() {
    const starContainers = document.querySelectorAll('.interactive_stars');

    starContainers.forEach(container => {
        const stars = container.querySelectorAll('i');
        const currentRating = parseInt(container.getAttribute('data-rating')) || 0;

        // Set initial rating
        updateStarDisplay(container, currentRating);

        stars.forEach((star, index) => {
            const starValue = index + 1;

            // Click handler
            star.addEventListener('click', function() {
                const newRating = starValue;
                container.setAttribute('data-rating', newRating);
                updateStarDisplay(container, newRating);
                updateRatingLabel(container, newRating);
            });

            // Hover effects
            star.addEventListener('mouseenter', function() {
                highlightStars(container, starValue);
            });
        });

        // Reset on mouse leave
        container.addEventListener('mouseleave', function() {
            const currentRating = parseInt(container.getAttribute('data-rating')) || 0;
            updateStarDisplay(container, currentRating);
        });
    });
}

function updateStarDisplay(container, rating) {
    const stars = container.querySelectorAll('i');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.className = 'fa fa-star active';
        } else {
            star.className = 'fa fa-star-o';
        }
    });
}

function highlightStars(container, rating) {
    const stars = container.querySelectorAll('i');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.className = 'fa fa-star';
            star.style.color = '#ffc107';
        } else {
            star.className = 'fa fa-star-o';
            star.style.color = '#ddd';
        }
    });
}

function updateRatingLabel(container, rating) {
    const ratingLabels = {
        1: 'Rất tệ',
        2: 'Tệ',
        3: 'Trung bình',
        4: 'Tốt',
        5: 'Xuất sắc'
    };

    const labelElement = container.parentElement.querySelector('.rating_label');
    if (labelElement) {
        labelElement.textContent = ratingLabels[rating] || '';
    }
}

function initReviewFormHandlers() {
    // Edit review buttons
    const editButtons = document.querySelectorAll('.btn_edit_review');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const bookingId = this.getAttribute('data-booking-id');
            toggleReviewForm(bookingId);
        });
    });

    // Write new review buttons
    const writeButtons = document.querySelectorAll('.btn_write_review');
    writeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const bookingId = this.getAttribute('data-booking-id');
            showNewReviewForm(bookingId);
        });
    });

    // Save review buttons
    const saveButtons = document.querySelectorAll('.btn_save_review');
    saveButtons.forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.review_form');
            const bookingId = form.id.replace('reviewForm', '');
            const isNewReview = document.getElementById(`noReviewMessage${bookingId}`);

            if (isNewReview && isNewReview.style.display !== 'none') {
                saveNewReview(form, bookingId);
            } else {
                saveReview(form);
            }
        });
    });

    // Cancel review buttons
    const cancelButtons = document.querySelectorAll('.btn_cancel_review');
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.review_form');
            const bookingId = form.id.replace('reviewForm', '');
            const isNewReview = document.getElementById(`noReviewMessage${bookingId}`);

            if (isNewReview && isNewReview.style.display !== 'none') {
                cancelNewReview(bookingId);
            } else {
                cancelReviewEdit(bookingId);
            }
        });
    });
}

function showNewReviewForm(bookingId) {
    const noReviewMessage = document.getElementById(`noReviewMessage${bookingId}`);
    const reviewForm = document.getElementById(`reviewForm${bookingId}`);

    noReviewMessage.style.display = 'none';
    reviewForm.style.display = 'block';

    // Reset form to empty state
    resetReviewForm(reviewForm);

    showMessage('Hãy chia sẻ trải nghiệm của bạn', 'info');
}

function cancelNewReview(bookingId) {
    const noReviewMessage = document.getElementById(`noReviewMessage${bookingId}`);
    const reviewForm = document.getElementById(`reviewForm${bookingId}`);

    reviewForm.style.display = 'none';
    noReviewMessage.style.display = 'block';

    // Reset form
    resetReviewForm(reviewForm);
}

function resetReviewForm(form) {
    // Reset all stars to empty
    const starContainers = form.querySelectorAll('.interactive_stars');
    starContainers.forEach(container => {
        container.setAttribute('data-rating', '0');
        updateStarDisplay(container, 0);
    });

    // Reset rating label
    const ratingLabel = form.querySelector('.rating_label');
    if (ratingLabel) {
        ratingLabel.textContent = 'Chọn đánh giá';
    }

    // Reset textarea
    const textarea = form.querySelector('.review_textarea');
    if (textarea) {
        textarea.value = '';
    }
}

function saveNewReview(form, bookingId) {
    // Get form data
    const overallRating = form.querySelector('.overall_rating').getAttribute('data-rating');
    const comment = form.querySelector('.review_textarea').value;
    const aspectRatings = {};

    form.querySelectorAll('.aspect_rating').forEach(rating => {
        const aspect = rating.getAttribute('data-aspect');
        const value = rating.getAttribute('data-rating');
        aspectRatings[aspect] = value;
    });

    // Validate
    if (!overallRating || overallRating === '0') {
        showMessage('Vui lòng chọn đánh giá tổng thể', 'error');
        return;
    }

    if (!comment.trim()) {
        showMessage('Vui lòng nhập nhận xét', 'error');
        return;
    }

    // Check if all aspects are rated
    const allAspects = Object.values(aspectRatings);
    if (allAspects.includes('0')) {
        showMessage('Vui lòng đánh giá tất cả các khía cạnh', 'error');
        return;
    }

    // Show loading
    showMessage('Đang gửi đánh giá...', 'info');

    // Simulate API call
    setTimeout(() => {
        createNewReviewDisplay(bookingId, overallRating, comment, aspectRatings);
        cancelNewReview(bookingId);

        // Update the "Chưa đánh giá" text to show rating
        const historyItem = form.closest('.history_item');
        const statusSpan = historyItem.querySelector('.detail_item:last-child span');
        statusSpan.innerHTML = `Đã đánh giá: ${overallRating} sao`;
        statusSpan.parentElement.querySelector('i').className = 'fa fa-star';

        showMessage('Cảm ơn bạn đã đánh giá! Đánh giá của bạn sẽ giúp ích cho cộng đồng.', 'success');
    }, 1500);
}

function createNewReviewDisplay(bookingId, overallRating, comment, aspectRatings) {
    const reviewSection = document.getElementById(`reviewForm${bookingId}`).parentElement;
    const noReviewMessage = document.getElementById(`noReviewMessage${bookingId}`);

    // Create new review display HTML
    const reviewDisplayHTML = `
        <div class="existing_review" id="existingReview${bookingId}">
            <div class="rating_display">
                <div class="stars">
                    ${createStarHTML(parseInt(overallRating))}
                </div>
                <span class="rating_text">${overallRating}.0 - ${getRatingText(parseInt(overallRating))}</span>
                <span class="review_date">Đánh giá ngày ${new Date().toLocaleDateString('vi-VN')}</span>
            </div>
            <div class="review_comment">
                <p>"${comment}"</p>
            </div>
            <div class="review_aspects">
                <div class="aspect_item">
                    <span class="aspect_label">Vị trí:</span>
                    <div class="aspect_stars">
                        ${createStarHTML(parseInt(aspectRatings.location), true)}
                    </div>
                </div>
                <div class="aspect_item">
                    <span class="aspect_label">Dịch vụ:</span>
                    <div class="aspect_stars">
                        ${createStarHTML(parseInt(aspectRatings.service), true)}
                    </div>
                </div>
                <div class="aspect_item">
                    <span class="aspect_label">Giá cả:</span>
                    <div class="aspect_stars">
                        ${createStarHTML(parseInt(aspectRatings.price), true)}
                    </div>
                </div>
                <div class="aspect_item">
                    <span class="aspect_label">An toàn:</span>
                    <div class="aspect_stars">
                        ${createStarHTML(parseInt(aspectRatings.safety), true)}
                    </div>
                </div>
            </div>
        </div>
    `;

    // Replace no review message with review display
    noReviewMessage.outerHTML = reviewDisplayHTML;

    // Update header button
    const reviewHeader = reviewSection.querySelector('.review_header');
    const writeButton = reviewHeader.querySelector('.btn_write_review');
    if (writeButton) {
        writeButton.outerHTML = `
            <button class="btn_edit_review" data-booking-id="${bookingId}">
                <i class="fa fa-edit"></i> Chỉnh sửa đánh giá
            </button>
        `;

        // Re-initialize the edit button
        const newEditButton = reviewHeader.querySelector('.btn_edit_review');
        newEditButton.addEventListener('click', function() {
            toggleReviewForm(bookingId);
        });
    }
}

function toggleReviewForm(bookingId) {
    const existingReview = document.getElementById(`existingReview${bookingId}`);
    const reviewForm = document.getElementById(`reviewForm${bookingId}`);

    if (reviewForm.style.display === 'none') {
        // Show form, hide existing review
        existingReview.style.display = 'none';
        reviewForm.style.display = 'block';

        // Load existing data into form
        loadExistingReviewData(bookingId);

        showMessage('Chế độ chỉnh sửa đánh giá', 'info');
    } else {
        // Hide form, show existing review
        reviewForm.style.display = 'none';
        existingReview.style.display = 'block';
    }
}

function loadExistingReviewData(bookingId) {
    const existingReview = document.getElementById(`existingReview${bookingId}`);
    const reviewForm = document.getElementById(`reviewForm${bookingId}`);

    // Load overall rating
    const existingStars = existingReview.querySelectorAll('.stars .fa-star').length;
    const overallRating = reviewForm.querySelector('.overall_rating');
    if (overallRating) {
        overallRating.setAttribute('data-rating', existingStars);
        updateStarDisplay(overallRating, existingStars);
        updateRatingLabel(overallRating, existingStars);
    }

    // Load comment
    const existingComment = existingReview.querySelector('.review_comment p').textContent;
    const textarea = reviewForm.querySelector('.review_textarea');
    if (textarea) {
        textarea.value = existingComment.replace(/"/g, '');
    }

    // Load aspect ratings
    const aspectItems = existingReview.querySelectorAll('.aspect_item');
    aspectItems.forEach((item, index) => {
        const aspectStars = item.querySelectorAll('.aspect_stars .fa-star').length;
        const aspectRating = reviewForm.querySelectorAll('.aspect_rating')[index];
        if (aspectRating) {
            aspectRating.setAttribute('data-rating', aspectStars);
            updateStarDisplay(aspectRating, aspectStars);
        }
    });
}

function saveReview(form) {
    // Get form data
    const overallRating = form.querySelector('.overall_rating').getAttribute('data-rating');
    const comment = form.querySelector('.review_textarea').value;
    const aspectRatings = {};

    form.querySelectorAll('.aspect_rating').forEach(rating => {
        const aspect = rating.getAttribute('data-aspect');
        const value = rating.getAttribute('data-rating');
        aspectRatings[aspect] = value;
    });

    // Validate
    if (!overallRating || overallRating === '0') {
        showMessage('Vui lòng chọn đánh giá tổng thể', 'error');
        return;
    }

    if (!comment.trim()) {
        showMessage('Vui lòng nhập nhận xét', 'error');
        return;
    }

    // Show loading
    showMessage('Đang lưu đánh giá...', 'info');

    // Simulate API call
    setTimeout(() => {
        updateExistingReview(form, overallRating, comment, aspectRatings);
        const bookingId = form.id.replace('reviewForm', '');
        cancelReviewEdit(bookingId);
        showMessage('Đánh giá đã được cập nhật thành công!', 'success');
    }, 1000);
}

function updateExistingReview(form, overallRating, comment, aspectRatings) {
    const bookingId = form.id.replace('reviewForm', '');
    const existingReview = document.getElementById(`existingReview${bookingId}`);

    // Update overall rating
    const starsContainer = existingReview.querySelector('.stars');
    starsContainer.innerHTML = createStarHTML(parseInt(overallRating));

    // Update rating text
    const ratingText = existingReview.querySelector('.rating_text');
    ratingText.textContent = `${overallRating}.0 - ${getRatingText(parseInt(overallRating))}`;

    // Update comment
    const commentP = existingReview.querySelector('.review_comment p');
    commentP.textContent = `"${comment}"`;

    // Update aspect ratings
    const aspectItems = existingReview.querySelectorAll('.aspect_item');
    const aspectOrder = ['location', 'service', 'price', 'safety'];

    aspectItems.forEach((item, index) => {
        const aspectKey = aspectOrder[index];
        const rating = aspectRatings[aspectKey];
        const aspectStarsContainer = item.querySelector('.aspect_stars');
        aspectStarsContainer.innerHTML = createStarHTML(parseInt(rating), true);
    });

    // Update date
    const reviewDate = existingReview.querySelector('.review_date');
    const today = new Date();
    reviewDate.textContent = `Đánh giá ngày ${today.toLocaleDateString('vi-VN')}`;
}

function createStarHTML(rating, isSmall = false) {
    const starClass = isSmall ? 'fa-star' : 'fa-star';
    const emptyClass = isSmall ? 'fa-star-o' : 'fa-star-o';
    let html = '';

    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            html += `<i class="fa ${starClass}"></i>`;
        } else {
            html += `<i class="fa ${emptyClass}"></i>`;
        }
    }

    return html;
}

function cancelReviewEdit(bookingId) {
    const existingReview = document.getElementById(`existingReview${bookingId}`);
    const reviewForm = document.getElementById(`reviewForm${bookingId}`);

    reviewForm.style.display = 'none';
    existingReview.style.display = 'block';
}

function initExistingReviews() {
    // Initialize any existing review data on page load
    const reviewSections = document.querySelectorAll('.customer_review_section');
    reviewSections.forEach(section => {
        // Add any initialization logic here
    });
}function addReviewHoverEffects() {
    const reviewSections = document.querySelectorAll('.customer_review_section');

    reviewSections.forEach(section => {
        section.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.1)';
            this.style.transition = 'all 0.3s ease';
        });

        section.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
}

function addReviewInteractions() {
    // Add click handlers for aspect items
    const aspectItems = document.querySelectorAll('.aspect_item');

    aspectItems.forEach(item => {
        item.addEventListener('click', function() {
            const aspectLabel = this.querySelector('.aspect_label').textContent;
            const stars = this.querySelectorAll('.aspect_stars .fa-star').length;

            showMessage(`${aspectLabel} ${stars}/5 sao`, 'info');
        });

        // Add hover effect
        item.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f0f8ff';
            this.style.borderColor = '#f39c12';
            this.style.cursor = 'pointer';
            this.style.transition = 'all 0.3s ease';
        });

        item.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'white';
            this.style.borderColor = '#e8eaed';
        });
    });
}

function initReviewAnimations() {
    // Animate stars on page load
    const starContainers = document.querySelectorAll('.stars, .aspect_stars');

    starContainers.forEach(container => {
        const stars = container.querySelectorAll('i');
        stars.forEach((star, index) => {
            star.style.opacity = '0';
            star.style.transform = 'scale(0)';

            setTimeout(() => {
                star.style.transition = 'all 0.3s ease';
                star.style.opacity = '1';
                star.style.transform = 'scale(1)';
            }, index * 100);
        });
    });
}

// Review Rating Helper Functions
function createStarRating(rating, size = 'normal') {
    const starSize = size === 'small' ? '12px' : '16px';
    let starsHTML = '';

    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            starsHTML += `<i class="fa fa-star" style="font-size: ${starSize}; color: #ffc107;"></i>`;
        } else {
            starsHTML += `<i class="fa fa-star-o" style="font-size: ${starSize}; color: #ddd;"></i>`;
        }
    }

    return starsHTML;
}

function getRatingText(rating) {
    const ratingTexts = {
        1: 'Rất tệ',
        2: 'Tệ',
        3: 'Trung bình',
        4: 'Tốt',
        5: 'Xuất sắc'
    };

    return ratingTexts[rating] || 'Chưa đánh giá';
}

function animateReviewSection(section) {
    section.style.opacity = '0';
    section.style.transform = 'translateY(20px)';

    setTimeout(() => {
        section.style.transition = 'all 0.5s ease';
        section.style.opacity = '1';
        section.style.transform = 'translateY(0)';
    }, 100);
}

// Add review section animations on scroll
function handleReviewScrollAnimations() {
    const reviewSections = document.querySelectorAll('.customer_review_section');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateReviewSection(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    reviewSections.forEach(section => {
        observer.observe(section);
    });
}

// Initialize scroll animations
document.addEventListener('DOMContentLoaded', function() {
    handleReviewScrollAnimations();
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }

    .grid-view .history_item {
        display: inline-block;
        width: calc(50% - 10px);
        margin-right: 20px;
        margin-bottom: 20px;
        vertical-align: top;
    }

    @media (max-width: 768px) {
        .grid-view .history_item {
            width: 100%;
            margin-right: 0;
        }
    }
`;
document.head.appendChild(style);
