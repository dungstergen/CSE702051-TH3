/**
 * Custom Admin JavaScript for Paspark
 * Handles all custom functionality for the admin panel
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Paspark Admin JavaScript loaded');

    // Initialize all components
    initParkingSpots();
    initNotifications();
    initSidebarToggle();
    initDropdowns();
    initTooltips();
    initActivityRefresh();
    initDashboardCards();

    /**
     * Initialize parking spot interactions
     */
    function initParkingSpots() {
        const parkingSpots = document.querySelectorAll('.parking-spot');

        parkingSpots.forEach(spot => {
            spot.addEventListener('click', function() {
                const spotNumber = this.textContent.trim();
                const isAvailable = this.classList.contains('spot-available');
                const isOccupied = this.classList.contains('spot-occupied');
                const isMaintenance = this.classList.contains('spot-maintenance');

                let status = 'unknown';
                if (isAvailable) status = 'trống';
                else if (isOccupied) status = 'đang sử dụng';
                else if (isMaintenance) status = 'bảo trì';

                // Show parking spot modal
                showParkingSpotModal(spotNumber, status, this);
            });

            // Add hover effect
            spot.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.1)';
                this.style.zIndex = '10';
            });

            spot.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.zIndex = '1';
            });
        });
    }

    /**
     * Show parking spot modal
     */
    function showParkingSpotModal(spotNumber, status, element) {
        const modal = document.createElement('div');
        modal.className = 'parking-modal-overlay';
        modal.innerHTML = `
            <div class="parking-modal">
                <div class="parking-modal-header">
                    <h3>Vị trí đỗ xe ${spotNumber}</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="parking-modal-body">
                    <p><strong>Trạng thái hiện tại:</strong> <span class="status-${status.replace(' ', '-')}">${status}</span></p>
                    <div class="modal-actions">
                        <button class="btn btn-primary" onclick="updateParkingStatus('${spotNumber}', 'available')">
                            <i class="fas fa-check"></i> Đặt trống
                        </button>
                        <button class="btn btn-danger" onclick="updateParkingStatus('${spotNumber}', 'occupied')">
                            <i class="fas fa-car"></i> Đặt đang sử dụng
                        </button>
                        <button class="btn btn-warning" onclick="updateParkingStatus('${spotNumber}', 'maintenance')">
                            <i class="fas fa-wrench"></i> Đặt bảo trì
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Close modal handlers
        modal.querySelector('.modal-close').addEventListener('click', () => {
            document.body.removeChild(modal);
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                document.body.removeChild(modal);
            }
        });
    }

    /**
     * Update parking spot status
     */
    window.updateParkingStatus = function(spotNumber, newStatus) {
        const spot = Array.from(document.querySelectorAll('.parking-spot')).find(
            el => el.textContent.trim() === spotNumber
        );

        if (spot) {
            // Remove all status classes
            spot.classList.remove('spot-available', 'spot-occupied', 'spot-maintenance');

            // Add new status class
            spot.classList.add(`spot-${newStatus}`);

            // Show success notification
            showNotification(`Vị trí ${spotNumber} đã được cập nhật thành ${getStatusText(newStatus)}`, 'success');

            // Close modal
            const modal = document.querySelector('.parking-modal-overlay');
            if (modal) {
                document.body.removeChild(modal);
            }

            // Here you would typically make an AJAX call to update the backend
            console.log(`Updated spot ${spotNumber} to ${newStatus}`);
        }
    };

    /**
     * Get status text in Vietnamese
     */
    function getStatusText(status) {
        const statusMap = {
            'available': 'trống',
            'occupied': 'đang sử dụng',
            'maintenance': 'bảo trì'
        };
        return statusMap[status] || status;
    }

    /**
     * Initialize notifications
     */
    function initNotifications() {
        const notificationContainer = document.createElement('div');
        notificationContainer.className = 'notification-container';
        document.body.appendChild(notificationContainer);
    }

    /**
     * Show notification
     */
    window.showNotification = function(message, type = 'info', duration = 3000) {
        const container = document.querySelector('.notification-container');
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${getNotificationIcon(type)}"></i>
                <span>${message}</span>
            </div>
            <button class="notification-close">&times;</button>
        `;

        container.appendChild(notification);

        // Auto remove after duration
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, duration);

        // Manual close
        notification.querySelector('.notification-close').addEventListener('click', () => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        });
    };

    /**
     * Get notification icon
     */
    function getNotificationIcon(type) {
        const icons = {
            'success': 'check-circle',
            'error': 'exclamation-circle',
            'warning': 'exclamation-triangle',
            'info': 'info-circle'
        };
        return icons[type] || 'info-circle';
    }

    /**
     * Initialize sidebar toggle
     */
    function initSidebarToggle() {
        const toggleButton = document.querySelector('[sidenav-trigger]');
        const sidebar = document.querySelector('aside');

        if (toggleButton && sidebar) {
            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('translate-x-0');
                sidebar.classList.toggle('-translate-x-full');
            });
        }
    }

    /**
     * Initialize dropdown menus
     */
    function initDropdowns() {
        const dropdownTriggers = document.querySelectorAll('[dropdown-trigger]');

        dropdownTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.nextElementSibling;
                if (dropdown) {
                    dropdown.classList.toggle('opacity-0');
                    dropdown.classList.toggle('pointer-events-none');
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[dropdown-trigger]')) {
                const dropdowns = document.querySelectorAll('[dropdown-menu]');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add('opacity-0');
                    dropdown.classList.add('pointer-events-none');
                });
            }
        });
    }

    /**
     * Initialize tooltips
     */
    function initTooltips() {
        const elementsWithTooltips = document.querySelectorAll('[data-tooltip]');

        elementsWithTooltips.forEach(element => {
            element.addEventListener('mouseenter', function() {
                const tooltip = document.createElement('div');
                tooltip.className = 'custom-tooltip';
                tooltip.textContent = this.getAttribute('data-tooltip');
                document.body.appendChild(tooltip);

                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
            });

            element.addEventListener('mouseleave', function() {
                const tooltip = document.querySelector('.custom-tooltip');
                if (tooltip) {
                    document.body.removeChild(tooltip);
                }
            });
        });
    }

    /**
     * Initialize activity feed auto-refresh
     */
    function initActivityRefresh() {
        // Auto-refresh activity feed every 30 seconds
        setInterval(function() {
            refreshActivityFeed();
        }, 30000);
    }

    /**
     * Refresh activity feed
     */
    function refreshActivityFeed() {
        console.log('Refreshing activity feed...');
        // Here you would typically make an AJAX call to get new activities
        // For now, we'll just log it
    }

    /**
     * Initialize dashboard cards animations
     */
    function initDashboardCards() {
        const cards = document.querySelectorAll('.dashboard-card, .relative.flex.flex-col.min-w-0');

        // Intersection Observer for scroll animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    }

    /**
     * Chart initialization (if Chart.js is available)
     */
    if (typeof Chart !== 'undefined') {
        initCharts();
    }

    function initCharts() {
        // Revenue chart
        const revenueChart = document.getElementById('revenueChart');
        if (revenueChart) {
            new Chart(revenueChart, {
                type: 'line',
                data: {
                    labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: [1200000, 1900000, 3000000, 5000000, 2000000, 3000000, 2500000],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        // Parking occupancy chart
        const occupancyChart = document.getElementById('occupancyChart');
        if (occupancyChart) {
            new Chart(occupancyChart, {
                type: 'doughnut',
                data: {
                    labels: ['Đang sử dụng', 'Trống', 'Bảo trì'],
                    datasets: [{
                        data: [98, 58, 2],
                        backgroundColor: [
                            'rgb(239, 68, 68)',
                            'rgb(16, 185, 129)',
                            'rgb(245, 158, 11)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
    }
});

// Export functions for global use
window.PasparkAdmin = {
    showNotification: window.showNotification,
    updateParkingStatus: window.updateParkingStatus
};
