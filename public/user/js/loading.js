// Loading Screen Manager
(function() {
    'use strict';

    // Create loading overlay HTML
    const loadingHTML = `
        <div id="loading-overlay" class="loading-overlay">
            <div class="loading-container">
                <div class="loading-spinner"></div>
                <div class="loading-text">Paspark</div>
                <div class="loading-subtext">
                    Đang tải<span class="loading-dots"></span>
                </div>
            </div>
        </div>
    `;

    // Loading manager object
    window.LoadingManager = {
        overlay: null,

        // Initialize loading screen
        init: function() {
            // Add loading HTML to body
            document.body.insertAdjacentHTML('afterbegin', loadingHTML);
            this.overlay = document.getElementById('loading-overlay');

            // Auto hide after page load
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => {
                    setTimeout(() => this.hide(), 800);
                });
            } else {
                setTimeout(() => this.hide(), 500);
            }
        },

        // Show loading screen
        show: function() {
            if (this.overlay) {
                this.overlay.classList.remove('fade-out');
                this.overlay.style.display = 'flex';
            }
        },

        // Hide loading screen
        hide: function() {
            if (this.overlay) {
                this.overlay.classList.add('fade-out');
                setTimeout(() => {
                    if (this.overlay) {
                        this.overlay.style.display = 'none';
                    }
                }, 500);
            }
        },

        // Show loading for navigation
        showForNavigation: function() {
            this.show();
            // Auto hide after maximum time
            setTimeout(() => this.hide(), 3000);
        }
    };

    // Auto initialize when script loads
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            LoadingManager.init();
        });
    } else {
        LoadingManager.init();
    }

    // Add loading to all navigation links
    document.addEventListener('DOMContentLoaded', function() {
        // Get all navigation links
        const navLinks = document.querySelectorAll('a[href^="/"], a[href^="' + window.location.origin + '"]');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Don't show loading for same page links or external links
                const href = this.getAttribute('href');
                if (href && href !== window.location.pathname && !href.startsWith('#') && !href.startsWith('mailto:') && !href.startsWith('tel:')) {
                    LoadingManager.showForNavigation();
                }
            });
        });

        // Handle form submissions
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                LoadingManager.showForNavigation();
            });
        });
    });

    // Handle browser back/forward
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            LoadingManager.hide();
        }
    });

    // Hide loading on page unload
    window.addEventListener('beforeunload', function() {
        LoadingManager.show();
    });

})();
