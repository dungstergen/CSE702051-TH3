// Dashboard JavaScript functionality
$(document).ready(function() {

    // Animate stats on scroll
    function animateStats() {
        $('.stats_card').each(function() {
            if ($(this).is(':in-viewport')) {
                const $counter = $(this).find('h4');
                const target = parseInt($counter.text().replace(/,/g, ''));

                if (!$counter.hasClass('animated')) {
                    $counter.addClass('animated');
                    animateNumber($counter, 0, target, 1500);
                }
            }
        });
    }

    // Number animation function
    function animateNumber($element, start, end, duration) {
        const range = end - start;
        const stepTime = Math.abs(Math.floor(duration / range));
        const startTime = new Date().getTime();

        function run() {
            const now = new Date().getTime();
            const remaining = Math.max((startTime + duration - now) / duration, 0);
            const value = Math.round(end - (remaining * range));

            if (end > 1000) {
                $element.text(value.toLocaleString());
            } else if (end.toString().includes('.')) {
                $element.text(value.toFixed(1));
            } else {
                $element.text(value);
            }

            if (value == end) {
                clearInterval(timer);
            }
        }

        const timer = setInterval(run, stepTime);
        run();
    }

    // Check if element is in viewport
    $.fn.isInViewport = function() {
        const elementTop = $(this).offset().top;
        const elementBottom = elementTop + $(this).outerHeight();
        const viewportTop = $(window).scrollTop();
        const viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    // Run animation on scroll
    $(window).on('scroll', function() {
        animateStats();
    });

    // Run animation on load
    animateStats();

    // Smooth hover effects for cards
    $('.stats_card, .action_card, .widget_card').hover(
        function() {
            $(this).addClass('hovered');
        },
        function() {
            $(this).removeClass('hovered');
        }
    );

    // Auto-refresh dashboard data (mock)
    function refreshDashboardData() {
        // Simulate data refresh
        setTimeout(function() {
            // Update last activity timestamp
            $('.activity_item:first-child .activity_content p').text(
                'Vừa cập nhật - ' + new Date().toLocaleTimeString('vi-VN')
            );
        }, 30000); // Refresh every 30 seconds
    }

    // Start auto-refresh
    refreshDashboardData();

    // Handle quick action clicks with loading states
    $('.action_card').click(function(e) {
        const $this = $(this);
        $this.addClass('loading');

        // Remove loading state after navigation
        setTimeout(function() {
            $this.removeClass('loading');
        }, 1000);
    });

    // Notification system (mock)
    function showNotification(message, type = 'info') {
        const notification = `
            <div class="dashboard-notification ${type}">
                <div class="notification-content">
                    <i class="fa fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="notification-close">&times;</button>
            </div>
        `;

        $('body').append(notification);

        setTimeout(function() {
            $('.dashboard-notification').fadeOut(function() {
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

    // Welcome message for new users
    if (localStorage.getItem('dashboardVisited') !== 'true') {
        setTimeout(function() {
            showNotification('Chào mừng bạn đến với Dashboard Paspark!', 'success');
            localStorage.setItem('dashboardVisited', 'true');
        }, 1000);
    }

    // Update current time display
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('vi-VN');

        // Update any time displays on the page
        $('.current-time').text(timeString);
    }

    // Update time every second
    setInterval(updateTime, 1000);

    // Responsive navigation for mobile
    function handleResponsiveNav() {
        if ($(window).width() <= 768) {
            $('.navbar-nav').addClass('mobile-nav');
        } else {
            $('.navbar-nav').removeClass('mobile-nav');
        }
    }

    $(window).resize(handleResponsiveNav);
    handleResponsiveNav();

    // Search functionality for activities (if search box exists)
    $('#activitySearch').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();

        $('.activity_item').each(function() {
            const activityText = $(this).text().toLowerCase();
            if (activityText.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Tooltip initialization for better UX
    $('[data-toggle="tooltip"]').tooltip();

    // Progress indicators for loading states
    function showProgress(selector, progress) {
        const $element = $(selector);
        $element.find('.progress-bar').css('width', progress + '%');
    }

    // Tab switching for different dashboard views
    $('.dashboard-tab').click(function() {
        const target = $(this).data('target');

        $('.dashboard-tab').removeClass('active');
        $(this).addClass('active');

        $('.dashboard-content').hide();
        $(target).show();
    });

});

// Additional utility functions for dashboard
const Dashboard = {

    // Format currency for Vietnamese
    formatCurrency: function(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount);
    },

    // Format date for Vietnamese
    formatDate: function(date) {
        return new Date(date).toLocaleDateString('vi-VN');
    },

    // Show loading state
    showLoading: function(element) {
        $(element).addClass('loading');
    },

    // Hide loading state
    hideLoading: function(element) {
        $(element).removeClass('loading');
    },

    // Update user stats
    updateStats: function(stats) {
        if (stats.totalBookings) {
            $('.stats_card').eq(0).find('h4').text(stats.totalBookings);
        }
        if (stats.totalHours) {
            $('.stats_card').eq(1).find('h4').text(stats.totalHours);
        }
        if (stats.totalAmount) {
            $('.stats_card').eq(2).find('h4').text(stats.totalAmount.toLocaleString());
        }
        if (stats.rating) {
            $('.stats_card').eq(3).find('h4').text(stats.rating);
        }
    }
};

// Export for use in other scripts
window.Dashboard = Dashboard;
