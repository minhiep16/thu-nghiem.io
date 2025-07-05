document.addEventListener('DOMContentLoaded', () => {
    const raceTrack = document.querySelector('.race-track');
    const icons = raceTrack.querySelectorAll('.car-icon');

    const iconStates = Array.from(icons).map((icon, index) => {
        const bannerHeight = raceTrack.offsetHeight;
        const iconHeight = icon.offsetHeight;

        const laneHeight = bannerHeight / icons.length;
        const topPosition = (laneHeight * index) + (laneHeight / 2) - (iconHeight / 2);

        icon.style.top = `${topPosition}px`;

        return {
            element: icon,
            speed: (parseFloat(icon.dataset.speed) * 1.5) + (Math.random() * 0.5),
            currentPosition: -icon.offsetWidth,
            animationFrameId: null
        };
    });

    function animateIcons() {
        const bannerWidth = raceTrack.offsetWidth;

        iconStates.forEach(state => {
            const iconWidth = state.element.offsetWidth;

            state.currentPosition += state.speed;

            if (state.currentPosition >= bannerWidth) {
                state.currentPosition = -iconWidth - (Math.random() * bannerWidth * 0.5);
            }

            state.element.style.left = `${state.currentPosition}px`;
        });

        requestAnimationFrame(animateIcons);
    }

    animateIcons();
});

// Wash.js
document.addEventListener("DOMContentLoaded", () => {
    const options = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target); // chỉ hiện 1 lần
            }
        });
    }, options);

    document.querySelectorAll(".card").forEach(card => {
        observer.observe(card);
    });
});