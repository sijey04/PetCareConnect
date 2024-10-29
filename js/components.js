document.addEventListener('alpine:init', () => {
    Alpine.data('mobileMenu', () => ({
        isOpen: false,
        
        init() {
            console.log('Mobile menu initialized');
        },
        
        toggleMenu() {
            console.log('Toggle menu called');
            this.isOpen = !this.isOpen;
        },
        
        closeMenu() {
            console.log('Close menu called');
            this.isOpen = false;
        }
    }));
});

// Add this to check if Alpine.js is loaded
window.addEventListener('load', () => {
    console.log('Alpine.js available:', window.Alpine !== undefined);
}); 