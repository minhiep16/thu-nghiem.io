// Wait for the DOM to be fully loaded before running the script
document.addEventListener('DOMContentLoaded', function() {

    // Initialize AOS (Animate on Scroll)
    AOS.init({
        duration: 1000, // Animation duration in milliseconds
        once: true,      // Whether animation should happen only once - while scrolling down
        offset: 100,     // Offset (in px) from the original trigger point
    });

    // Simple parallax effect for the hero section
    window.addEventListener('scroll', function() {
        const hero = document.querySelector('.hero');
        // Check if the hero element exists to avoid errors on other pages
        if (hero) {
            let offset = window.pageYOffset;
            // The 0.5 value determines the speed of the parallax effect
            hero.style.backgroundPositionY = offset * 0.5 + 'px';
        }
    });

});