// cart.js
document.addEventListener('DOMContentLoaded', function () {
    const cartItemList = document.getElementById('cart-item-list');

    // Hàm cập nhật tổng tiền
    function updateSummary() {
        let subtotal = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.dataset.price);
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            subtotal += price * quantity;
        });

        const shipping = subtotal > 0 ? 20000 : 0;
        const total = subtotal + shipping;

        document.getElementById('summary-subtotal').textContent = subtotal.toLocaleString('vi-VN') + ' VNĐ';
        document.getElementById('summary-shipping').textContent = shipping.toLocaleString('vi-VN') + ' VNĐ';
        document.getElementById('summary-total').textContent = 'VND ' + total.toLocaleString('vi-VN');
        
        // Cập nhật QR Code
        const qrImage = document.getElementById('qr-code-image');
        const qrTotal = document.getElementById('qr-total-amount');
        if(qrImage && qrTotal) {
            const baseUrl = qrImage.src.split('?')[0];
            qrImage.src = `${baseUrl}?accountName=TEN%20CHU%20KHOAN&amount=${total}&addInfo=DH${Math.floor(Math.random() * 10000)}`;
            qrTotal.textContent = total.toLocaleString('vi-VN') + ' VNĐ';
        }

        // Kiểm tra nếu giỏ hàng trống
        if (subtotal === 0) {
            cartItemList.innerHTML = '<p class="empty-cart-message">Giỏ hàng của bạn đang trống.</p>';
        }
    }

    // Hàm gửi yêu cầu cập nhật lên server
    function sendUpdateRequest(productId, quantity) {
        const formData = new FormData();
        formData.append('action', 'update');
        formData.append('product_id', productId);
        formData.append('quantity', quantity);

        fetch('../Modules/cart_handler.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                // Cập nhật lại số đếm trên navbar
                const cartCounter = document.querySelector('.cart-counter');
                 if (cartCounter) cartCounter.textContent = data.cartCount;
            }
        });
    }

    // Gán sự kiện cho các nút
    cartItemList.addEventListener('click', function(event) {
        const target = event.target;
        const cartItem = target.closest('.cart-item');
        if (!cartItem) return;
        
        const productId = cartItem.dataset.id;
        const quantityInput = cartItem.querySelector('.quantity-input');
        let quantity = parseInt(quantityInput.value);

        // Nút xóa sản phẩm
        if (target.classList.contains('remove-btn')) {
            cartItem.remove();
            sendUpdateRequest(productId, 0); // Gửi số lượng 0 để xóa
            updateSummary();
        }

        // Nút tăng/giảm số lượng
        if (target.classList.contains('quantity-btn')) {
            if (target.dataset.action === 'increase') {
                quantity++;
            } else if (target.dataset.action === 'decrease' && quantity > 1) {
                quantity--;
            }
            quantityInput.value = quantity;
            // Cập nhật giá tiền của dòng này và tổng tiền
            const price = parseFloat(cartItem.dataset.price);
            cartItem.querySelector('.cart-item-total-price').textContent = (price * quantity).toLocaleString('vi-VN') + ' VNĐ';
            sendUpdateRequest(productId, quantity);
            updateSummary();
        }
    });

    // Xử lý modal thanh toán (giữ nguyên logic cũ)
    const checkoutModal = document.getElementById('checkout-modal');
    const checkoutBtn = document.getElementById('checkout-btn');
    const closeModalBtn = document.getElementById('close-modal-btn');
    if(checkoutBtn) checkoutBtn.onclick = () => { if(document.querySelector('.cart-item')) checkoutModal.style.display = "block"; else alert("Giỏ hàng trống!");};
    if(closeModalBtn) closeModalBtn.onclick = () => checkoutModal.style.display = "none";
    window.onclick = (event) => { if(event.target == checkoutModal) checkoutModal.style.display = "none"; };
});
