// Mobile menu functionality
function initializeMobileMenu() {
    // Mobile menu functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const closeMobileMenuButton = document.getElementById('close-mobile-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const contentOverlay = document.getElementById('content-overlay');
    let isMenuOpen = false;

    function toggleMobileMenu() {
        isMenuOpen = !isMenuOpen;
        if (isMenuOpen) {
            // Open menu
            mobileMenu.classList.remove('-translate-x-full');
            mobileMenuOverlay.classList.add('opacity-50');
            mobileMenuOverlay.classList.remove('pointer-events-none');
            // Darken main content
            contentOverlay.classList.remove('pointer-events-none');
            contentOverlay.classList.add('opacity-50');
            document.body.classList.add('overflow-hidden');
        } else {
            // Close menu
            mobileMenu.classList.add('-translate-x-full');
            mobileMenuOverlay.classList.remove('opacity-50');
            mobileMenuOverlay.classList.add('pointer-events-none');
            // Remove darkening of main content
            contentOverlay.classList.add('pointer-events-none');
            contentOverlay.classList.remove('opacity-50');
            document.body.classList.remove('overflow-hidden');
        }
    }

    function closeMobileMenu() {
        isMenuOpen = false;
        mobileMenu.classList.add('-translate-x-full');
        mobileMenuOverlay.classList.remove('opacity-50');
        mobileMenuOverlay.classList.add('pointer-events-none');
        // Remove darkening of main content
        contentOverlay.classList.add('pointer-events-none');
        contentOverlay.classList.remove('opacity-50');
        document.body.classList.remove('overflow-hidden');
    }

    // Event listeners for mobile menu
    mobileMenuButton?.addEventListener('click', toggleMobileMenu);
    closeMobileMenuButton?.addEventListener('click', closeMobileMenu);
    mobileMenuOverlay?.addEventListener('click', closeMobileMenu);

    // Close mobile menu when clicking on a link
    const mobileMenuLinks = mobileMenu?.querySelectorAll('a');
    mobileMenuLinks?.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // Close mobile menu on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            closeMobileMenu();
        }
    });
}

// Smooth scrolling
function initializeSmoothScroll() {
    // Smooth scrolling
    const scrollLinks = document.querySelectorAll('.scroll-to');
    scrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Signup popup functionality (for NA-Index.php only)
function initializeSignupPopup() {
    const popup = document.getElementById('signup-popup');
    if (!popup) return;

    const closeButton = document.getElementById('close-popup');
    const signupButtons = document.querySelectorAll('#signup-button');
    const loginButtons = document.querySelectorAll('#login-button');
    const bookNowButton = document.getElementById('book-now-button');
    const appointmentsLinks = document.querySelectorAll('#appointments-link');

    function showPopup() {
        popup.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function hidePopup() {
        popup.classList.add('hidden');
        document.body.style.overflow = '';
    }

    closeButton?.addEventListener('click', hidePopup);

    signupButtons.forEach(button => {
        button?.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = 'signup.php';
        });
    });

    loginButtons.forEach(button => {
        button?.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = 'login.php';
        });
    });

    popup.addEventListener('click', function(event) {
        if (event.target === popup) {
            hidePopup();
        }
    });

    bookNowButton?.addEventListener('click', showPopup);
    appointmentsLinks.forEach(link => {
        link?.addEventListener('click', function(event) {
            event.preventDefault();
            showPopup();
        });
    });
}

// Add this function to handle footer visibility
function initializeFooter() {
    const footer = document.querySelector('.site-footer');
    if (!footer) return;

    let ticking = false;
    let isVisible = false;
    let resizeTimeout;
    const SCROLL_THRESHOLD = 100; // pixels from bottom to trigger footer

    function updateFooterVisibility() {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const distanceFromBottom = documentHeight - (scrollTop + windowHeight);

        // Only update if visibility state changes
        if (distanceFromBottom <= SCROLL_THRESHOLD && !isVisible) {
            isVisible = true;
            footer.classList.add('visible');
        } else if (distanceFromBottom > SCROLL_THRESHOLD && isVisible) {
            isVisible = false;
            footer.classList.remove('visible');
        }

        ticking = false;
    }

    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(() => {
                try {
                    updateFooterVisibility();
                } catch (error) {
                    console.error('Error updating footer visibility:', error);
                }
            });
            ticking = true;
        }
    }

    function onResize() {
        // Debounce resize events
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            try {
                updateFooterVisibility();
            } catch (error) {
                console.error('Error handling resize:', error);
            }
        }, 100);
    }

    // Initial check
    try {
        updateFooterVisibility();
    } catch (error) {
        console.error('Error in initial footer visibility check:', error);
    }

    // Event listeners
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onResize, { passive: true });

    // Cleanup function
    return function cleanup() {
        window.removeEventListener('scroll', onScroll);
        window.removeEventListener('resize', onResize);
        clearTimeout(resizeTimeout);
    };
}

// Initialize all functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeMobileMenu();
    initializeSmoothScroll();
    initializeSignupPopup();
    initializeFooter(); // Add this line
});
