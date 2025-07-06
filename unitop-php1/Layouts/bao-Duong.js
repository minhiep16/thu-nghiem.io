document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000, 
        once: true,     
        offset: 100,     
    });

    window.addEventListener('scroll', function() {
        const hero = document.querySelector('.hero');
        if (hero) {
            let offset = window.pageYOffset;
            hero.style.backgroundPositionY = offset * 0.5 + 'px';
        }
    });

    if (typeof tsParticles !== 'undefined') {
        tsParticles.load("tsparticles", { // Changed "particles-js" to "tsparticles" to match the ID in PHP
            background: {
                color: {
                    value: "#1a1a1a" 
                }
            },
            fpsLimit: 60,
            interactivity: {
                events: {
                    onHover: {
                        enable: true,
                        mode: "repulse" 
                    },
                    onClick: {
                        enable: true,
                        mode: "push" 
                    }
                },
                modes: {
                    repulse: {
                        distance: 150,
                        duration: 0.4
                    },
                    push: {
                        quantity: 4
                    }
                }
            },
            particles: {
                color: {
                    value: "#ffffff"
                },
                links: {
                    color: "#ffffff",
                    distance: 150,
                    enable: true,
                    opacity: 0.2, 
                    width: 1
                },
                collisions: {
                    enable: true
                },
                move: {
                    direction: "none",
                    enable: true,
                    outModes: {
                        default: "bounce"
                    },
                    random: false,
                    speed: 1,
                    straight: false
                },
                number: {
                    density: {
                        enable: true,
                        area: 800
                    },
                    value: 60 
                },
                opacity: {
                    value: 0.5
                },
                shape: {
                    type: "circle"
                },
                size: {
                    value: { min: 1, max: 3 }
                }
            },
            detectRetina: true
        });
    }
});