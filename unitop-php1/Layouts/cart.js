document.addEventListener('DOMContentLoaded', function () {
    const cartItemList = document.getElementById('cart-item-list');
    const customerForm = document.getElementById('customer-info-form');
    const checkoutModal = document.getElementById('checkout-modal');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const paymentConfirmedBtn = document.getElementById('payment-confirmed-btn');

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
        
        const qrImage = document.getElementById('qr-code-image');
        const qrTotal = document.getElementById('qr-total-amount');
        if (qrImage && qrTotal) {
            const baseUrl = qrImage.src.split('?')[0];
            qrImage.src = `${baseUrl}?accountName=TEN%20CHU%20KHOAN&amount=${total}&addInfo=DH${Math.floor(Math.random() * 10000)}`;
            qrTotal.textContent = total.toLocaleString('vi-VN') + ' VNĐ';
        }
        if (subtotal === 0 && !document.querySelector('.empty-cart-message')) {
            if(cartItemList) cartItemList.innerHTML = '<p class="empty-cart-message">Giỏ hàng của bạn đang trống.</p>';
        }
    }

    if (cartItemList) {
        cartItemList.addEventListener('click', function(event) {
            const target = event.target;
            const cartItem = target.closest('.cart-item');
            if (!cartItem) return;

            const productId = cartItem.dataset.id;
            const quantityInput = cartItem.querySelector('.quantity-input');
            let quantity = parseInt(quantityInput.value);

            if (target.matches('.remove-btn')) {
                cartItem.remove();
                updateSummary();
            } else if (target.matches('.quantity-btn')) {
                if (target.dataset.action === 'increase') quantity++;
                else if (target.dataset.action === 'decrease' && quantity > 1) quantity--;
                
                quantityInput.value = quantity;
                const price = parseFloat(cartItem.dataset.price);
                cartItem.querySelector('.cart-item-total-price').textContent = (price * quantity).toLocaleString('vi-VN') + ' VNĐ';
                updateSummary();
            }
        });
    }

    if (customerForm) {
        customerForm.addEventListener('submit', function(event) {
            event.preventDefault(); 
            
            if (!document.querySelector('.cart-item')) {
                alert("Giỏ hàng của bạn đang trống!");
                return;
            }
            if (checkoutModal) checkoutModal.style.display = "block";
        });
    }

    if (paymentConfirmedBtn) {
        paymentConfirmedBtn.addEventListener('click', function() {
            const formData = new FormData(customerForm);

            paymentConfirmedBtn.disabled = true;
            paymentConfirmedBtn.textContent = 'Đang xử lý...';

            fetch('../Modules/place_order.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Đặt hàng thành công! Cảm ơn bạn đã mua hàng.');
                    window.location.reload();
                } else {
                    alert('Lỗi: ' + data.message);
                    paymentConfirmedBtn.disabled = false;
                    paymentConfirmedBtn.textContent = 'Tôi đã thanh toán';
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                alert('Có lỗi kết nối xảy ra, vui lòng thử lại.');
                paymentConfirmedBtn.disabled = false;
                paymentConfirmedBtn.textContent = 'Tôi đã thanh toán';
            });
        });
    }

    if (closeModalBtn) closeModalBtn.onclick = () => { checkoutModal.style.display = "none"; };
    window.onclick = (event) => {
        if (event.target == checkoutModal) {
            checkoutModal.style.display = "none";
        }
    };
});