document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 800,
        once: true,    
        offset: 50,  
    });
    if (typeof tsParticles !== 'undefined') {
        tsParticles.load("particles-js", {
            background: {
                color: {
                    value: "#000000" 
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

    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    const toastMessage = document.getElementById('toast-message');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const originalButtonText = this.textContent;
            
            this.textContent = 'Đang thêm...';
            this.disabled = true;

            const formData = new FormData();
            formData.append('action', 'add');
            formData.append('product_id', productId);

            fetch('../Modules/cart_handler.php', { 
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastMessage.innerHTML = '<i class="fa fa-check-circle"></i> Đã thêm vào giỏ hàng!';
                    toastMessage.className = 'show success';
                    const cartCounter = document.querySelector('.cart-counter');
                    if (cartCounter) {
                        cartCounter.textContent = data.cartCount;
                        cartCounter.style.display = 'block';
                    }
                } else {
                     throw new Error(data.message || 'Lỗi không xác định.');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                toastMessage.innerHTML = 'Vui lòng đăng nhập để mua!';
                toastMessage.className = 'show error';
            })
            .finally(() => {
                setTimeout(() => {
                    toastMessage.classList.remove('show', 'success', 'error');
                }, 3000);
                this.textContent = originalButtonText;
                this.disabled = false;
            });
        });
    });
});