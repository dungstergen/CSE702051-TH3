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
}

// Filter Functions
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
