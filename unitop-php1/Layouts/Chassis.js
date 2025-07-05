// Chassis.js

document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo hiệu ứng cuộn AOS
    AOS.init({
        duration: 800,
        once: true,    
        offset: 50,  
    });

    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    const toastMessage = document.getElementById('toast-message');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const originalButtonText = this.textContent;
            
            this.textContent = 'Đang thêm...';
            this.disabled = true;

            // Chuẩn bị dữ liệu để gửi đi
            const formData = new FormData();
            formData.append('action', 'add');
            formData.append('product_id', productId);

            // Gửi yêu cầu đến cart_handler.php
            fetch('../Modules/cart_handler.php', { // Sửa đường dẫn cho đúng
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hiển thị thông báo thành công
                    toastMessage.innerHTML = '<i class="fa fa-check-circle"></i> Đã thêm vào giỏ hàng!';
                    toastMessage.className = 'show success';
                    
                    // Cập nhật số lượng trên icon giỏ hàng ở navbar
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
                toastMessage.innerHTML = 'Có lỗi, vui lòng thử lại!';
                toastMessage.className = 'show error';
            })
            .finally(() => {
                // Ẩn thông báo sau 3 giây
                setTimeout(() => {
                    toastMessage.classList.remove('show', 'success', 'error');
                }, 3000);
                 // Đặt lại trạng thái nút sau khi hoàn tất
                this.textContent = originalButtonText;
                this.disabled = false;
            });
        });
    });
});
