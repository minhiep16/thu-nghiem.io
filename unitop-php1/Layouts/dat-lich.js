// dat-lich.js (Đã nâng cấp)

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('booking-form');
    if (!form) return; // Dừng lại nếu không tìm thấy form

    // Lấy các trường input
    const nameInput = document.getElementById('name');
    const phoneInput = document.getElementById('phone');
    const emailInput = document.getElementById('email');
    const termsCheckbox = document.getElementById('terms');
    const messageInput = document.getElementById('message');
    const addressInput = document.getElementById('address');
    const errorDiv = document.getElementById('auth-error');

    // Nâng cấp: Lấy trường ngày và giờ
    const dateInput = document.getElementById('date');
    const timeInput = document.getElementById('time');

    // Tự động điền email nếu người dùng đã đăng nhập
    if (appData.isLoggedIn) {
        emailInput.value = appData.userEmail;
        emailInput.readOnly = true;
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Luôn luôn ngăn chặn việc gửi form mặc định

        // 1. Kiểm tra đăng nhập trước tiên
        if (!appData.isLoggedIn) {
            errorDiv.innerHTML = 'Vui lòng <a href="login.php">đăng nhập</a> để hoàn tất đặt lịch.';
            errorDiv.style.display = 'block';
            window.scrollTo(0, errorDiv.offsetTop - 20); // Cuộn đến thông báo lỗi
            return; // Dừng thực thi
        }

        // 2. Xác thực form
        let isFormValid = validateForm();

        if (isFormValid) {
            // 3. Gửi dữ liệu nếu form hợp lệ
            const services = [];
            document.querySelectorAll('input[name="services[]"]:checked').forEach(checkbox => {
                services.push(checkbox.value);
            });

            // Nâng cấp: Thêm date và time vào formData
            const formData = {
                title: document.getElementById('title').value,
                name: nameInput.value.trim(),
                phone: phoneInput.value.trim(),
                email: emailInput.value.trim(),
                date: dateInput.value,
                time: timeInput.value,
                services: services,
                message: messageInput.value.trim(),
                address: addressInput.value.trim()
            };

            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'ĐANG GỬI...';

            // Gửi dữ liệu đến máy chủ
            fetch('./process-form.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            })
            .then(response => {
                return response.json().then(data => ({ status: response.status, body: data }));
            })
            .then(({ status, body }) => {
                if (status !== 200) {
                     // Hiển thị lỗi cụ thể từ server
                    alert('Lỗi: ' + body.error);
                } else {
                    alert(body.message);
                    form.reset();
                    // Khôi phục lại email sau khi reset form
                    if (appData.isLoggedIn) {
                        emailInput.value = appData.userEmail;
                    }
                }
            })
            .catch(error => {
                console.error('Lỗi khi gửi form:', error);
                alert('Đã có lỗi xảy ra khi kết nối tới máy chủ. Vui lòng thử lại.');
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.textContent = 'ĐẶT LỊCH HẸN';
            });
        } else {
            console.log('Biểu mẫu có lỗi, vui lòng kiểm tra lại.');
            // Tự động cuộn đến lỗi đầu tiên
            const firstError = form.querySelector('.error');
            if (firstError) {
                firstError.focus();
                window.scrollTo(0, firstError.offsetTop - 100);
            }
        }
    });

    function validateForm() {
        let isValid = true;
        clearErrors();

        if (nameInput.value.trim() === '') {
            showError(nameInput, 'Vui lòng nhập họ tên của bạn.');
            isValid = false;
        }
        if (phoneInput.value.trim() === '') {
            showError(phoneInput, 'Vui lòng nhập số điện thoại.');
            isValid = false;
        }
        if (emailInput.value.trim() === '') {
            showError(emailInput, 'Vui lòng nhập địa chỉ email.');
            isValid = false;
        } else if (!isValidEmail(emailInput.value.trim())) {
            showError(emailInput, 'Định dạng email không hợp lệ.');
            isValid = false;
        }

        // Nâng cấp: validation cho ngày và giờ
        if (dateInput.value === '') {
            showError(dateInput, 'Vui lòng chọn ngày hẹn.');
            isValid = false;
        }
        if (timeInput.value === '') {
            showError(timeInput, 'Vui lòng chọn giờ hẹn.');
            isValid = false;
        }

        if (!termsCheckbox.checked) {
            showError(termsCheckbox, 'Bạn phải đồng ý với điều khoản sử dụng.');
            isValid = false;
        }
        return isValid;
    }

    function showError(inputElement, message) {
        const formGroup = inputElement.closest('.form-group');
        if (!formGroup) return;
        let errorSpan = formGroup.querySelector('.error-message');
        if (!errorSpan) {
            errorSpan = document.createElement('span');
            errorSpan.className = 'error-message';
             // Nếu là checkbox, chèn lỗi vào vị trí khác
            if (inputElement.type === 'checkbox') {
                formGroup.appendChild(errorSpan);
                inputElement.closest('.terms-label').classList.add('error-text');
            } else {
                formGroup.appendChild(errorSpan);
            }
        }
        errorSpan.innerText = message;
        inputElement.classList.add('error');
    }

    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(msg => msg.remove());
        document.querySelectorAll('.form-group .error').forEach(input => input.classList.remove('error'));
        document.querySelectorAll('.error-text').forEach(label => label.classList.remove('error-text'));
        
        if(errorDiv) {
            errorDiv.style.display = 'none';
        }
    }

    function isValidEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});