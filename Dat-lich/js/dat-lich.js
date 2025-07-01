// file: script.js (Phiên bản cuối cùng dành cho PHP)

document.addEventListener('DOMContentLoaded', function () {

    // Lấy các phần tử (element) trong form mà chúng ta cần làm việc
    const form = document.querySelector('form');
    const nameInput = document.getElementById('name');
    const phoneInput = document.getElementById('phone');
    const emailInput = document.getElementById('email');
    const termsCheckbox = document.getElementById('terms');

    // Thêm một sự kiện "lắng nghe" khi người dùng nhấn nút submit
    form.addEventListener('submit', function (event) {
        // Ngăn chặn hành vi mặc định của form là tải lại trang
        event.preventDefault();

        // Gọi hàm kiểm tra toàn bộ form
        let isFormValid = validateForm();

        // Nếu form hợp lệ, tiến hành gửi dữ liệu đến server PHP
        if (isFormValid) {
            // Thu thập dữ liệu từ các trường input
            const services = [];
            document.querySelectorAll('input[name="services[]"]:checked').forEach(checkbox => {
                services.push(checkbox.value);
            });

            const formData = {
                title: document.getElementById('title').value,
                name: nameInput.value.trim(),
                phone: phoneInput.value.trim(),
                email: emailInput.value.trim(),
                services: services,
                brand: document.getElementById('brand').value,
                schedule: document.getElementById('schedule').value,
                message: document.getElementById('message').value.trim()
            };

            // Vô hiệu hóa nút bấm để tránh người dùng nhấn nhiều lần
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'ĐANG GỬI...';
            
            // Sử dụng Fetch API để gửi dữ liệu đến file process-form.php
            fetch('process-form.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData), // Chuyển object thành chuỗi JSON
            })
            .then(response => response.json()) // Chuyển phản hồi từ server thành object JSON
            .then(data => {
                // Xử lý khi nhận được phản hồi từ server
                if (data.error) {
                    // Nếu server trả về lỗi (ví dụ: email trùng lặp)
                    alert('Lỗi: ' + data.error);
                } else {
                    // Nếu thành công
                    alert(data.message);
                    form.reset(); // Xóa trắng các trường trong form
                }
            })
            .catch(error => {
                // Xử lý khi có lỗi mạng hoặc lỗi không xác định
                console.error('Lỗi khi gửi form:', error);
                alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            })
            .finally(() => {
                // Bật lại nút bấm sau khi hoàn tất, dù thành công hay thất bại
                submitButton.disabled = false;
                submitButton.textContent = 'ĐẶT LỊCH HẸN';
            });
        } else {
            console.log('Form có lỗi, vui lòng kiểm tra lại.');
        }
    });

    // Hàm chính để kiểm tra tất cả các trường
    function validateForm() {
        let isValid = true;
        clearErrors();

        // 1. Kiểm tra trường Tên
        if (nameInput.value.trim() === '') {
            showError(nameInput, 'Vui lòng nhập họ tên của bạn.');
            isValid = false;
        }
        // 2. Kiểm tra trường Số điện thoại
        if (phoneInput.value.trim() === '') {
            showError(phoneInput, 'Vui lòng nhập số điện thoại.');
            isValid = false;
        }
        // 3. Kiểm tra trường Email
        if (emailInput.value.trim() === '') {
            showError(emailInput, 'Vui lòng nhập địa chỉ email.');
            isValid = false;
        } else if (!isValidEmail(emailInput.value.trim())) {
            showError(emailInput, 'Định dạng email không hợp lệ.');
            isValid = false;
        }
        // 4. Kiểm tra checkbox Điều khoản
        if (!termsCheckbox.checked) {
            const termsLabel = document.querySelector('.terms-label');
            termsLabel.style.color = '#e74c3c';
            // Tạo một thông báo lỗi nhỏ dưới nút bấm để rõ ràng hơn
            const errorSpan = document.createElement('span');
            errorSpan.className = 'error-message';
            errorSpan.innerText = 'Bạn phải đồng ý với điều khoản sử dụng.';
            errorSpan.style.textAlign = 'center';
            termsCheckbox.closest('.form-group').appendChild(errorSpan);
            isValid = false;
        }
        return isValid;
    }
    // Hàm hiển thị lỗi
    function showError(inputElement, message) {
        const formGroup = inputElement.parentElement.closest('.form-group');
        const errorSpan = document.createElement('span');
        errorSpan.className = 'error-message';
        errorSpan.innerText = message;
        formGroup.appendChild(errorSpan);
        inputElement.classList.add('error');
    }
    // Hàm xóa tất cả các lỗi cũ
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(msg => msg.remove());
        document.querySelectorAll('.form-group .error').forEach(input => input.classList.remove('error'));
        document.querySelector('.terms-label').style.color = '';
    }
    // Hàm kiểm tra định dạng email
    function isValidEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});

