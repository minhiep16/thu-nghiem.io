document.addEventListener('DOMContentLoaded', function() {
    
    // --- LOGIC CHO SLIDESHOW TỰ ĐỘNG ---
    let slideIndex = 0;
    let slideInterval; // Biến để lưu trữ ID của setInterval cho slideshow

    function startSlideshow() {
        const slides = document.querySelectorAll('#slideshow .mySlides');
        const dotsContainer = document.querySelector('#slideshow .dot-container');

        if (!slides.length || !dotsContainer) {
            console.warn("Slideshow elements not found. Skipping slideshow initialization.");
            return;
        }

        // Tạo dots dựa trên số lượng slide (nếu chưa có hoặc muốn tự động)
        dotsContainer.innerHTML = ''; // Xóa dots cũ (nếu có)
        for (let i = 0; i < slides.length; i++) {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            dot.dataset.slide = i; // Lưu index của slide vào data-attribute
            dot.addEventListener('click', function() {
                currentSlide(parseInt(this.dataset.slide));
            });
            dotsContainer.appendChild(dot);
        }

        const dots = document.querySelectorAll('#slideshow .dot');

        function showSlides() {
            // Ẩn tất cả các slide
            slides.forEach(slide => slide.style.display = "none");
            
            // Gỡ bỏ class "active" khỏi tất cả các dot
            dots.forEach(dot => dot.classList.remove("active"));

            // Tăng slideIndex và reset nếu vượt quá số lượng slide
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }

            // Hiển thị slide hiện tại và đánh dấu dot tương ứng là "active"
            slides[slideIndex-1].style.display = "block";
            slides[slideIndex-1].classList.add('fade'); // Thêm lại class fade cho hiệu ứng
            dots[slideIndex-1].classList.add("active");

            // Xóa interval cũ nếu có để tránh nhiều interval chạy cùng lúc
            clearInterval(slideInterval);
            // Thiết lập interval mới để tự động chuyển slide sau 3 giây (3000ms)
            slideInterval = setTimeout(showSlides, 3000); 
        }

        function currentSlide(n) {
            clearInterval(slideInterval); // Dừng tự động chuyển khi người dùng tương tác
            slideIndex = n; // Đặt slideIndex về slide được click
            showSlides(); // Hiển thị slide ngay lập tức
        }

        showSlides(); // Khởi động slideshow lần đầu tiên
    }

    // Gọi hàm khởi tạo slideshow
    startSlideshow(); 

    // --- LOGIC CHO VIỆC CHỌN SAO ĐÁNH GIÁ (ĐÃ CẬP NHẬT) ---
    const starContainer = document.getElementById('rating-stars');
    if (starContainer) {
        const stars = starContainer.querySelectorAll('i');
        const ratingInput = document.getElementById('rating');

        // Hàm cập nhật trạng thái trực quan của các ngôi sao
        const updateStarsVisualState = (currentValue) => {
            stars.forEach(star => {
                const starValue = parseInt(star.dataset.value);
                if (starValue <= currentValue) {
                    // Chuyển thành sao đầy và thêm lớp 'selected' để có màu vàng
                    star.classList.remove('ri-star-line');
                    star.classList.add('ri-star-fill', 'selected');
                } else {
                    // Chuyển về sao rỗng và gỡ lớp 'selected'
                    star.classList.remove('ri-star-fill', 'selected');
                    star.classList.add('ri-star-line');
                }
            });
        };
        
        // Gán sự kiện cho từng ngôi sao
        stars.forEach(star => {
            // Sự kiện di chuột qua để xem trước
            star.addEventListener('mouseover', () => {
                const hoverValue = parseInt(star.dataset.value);
                stars.forEach(s => {
                    const sValue = parseInt(s.dataset.value);
                    if (sValue <= hoverValue) {
                        s.classList.remove('ri-star-line');
                        s.classList.add('ri-star-fill');
                    } else {
                        s.classList.remove('ri-star-fill');
                        s.classList.add('ri-star-line');
                    }
                });
            });

            // Sự kiện click để chọn đánh giá
            star.addEventListener('click', () => {
                const selectedValue = parseInt(star.dataset.value);
                ratingInput.value = selectedValue; // Cập nhật giá trị cho input ẩn
                updateStarsVisualState(selectedValue); // Cập nhật trạng thái cuối cùng
            });
        });

        // Khi chuột rời khỏi khu vực chọn sao, trở về trạng thái đã chọn
        starContainer.addEventListener('mouseout', () => {
            const selectedValue = parseInt(ratingInput.value) || 0;
            updateStarsVisualState(selectedValue);
        });
    }

    // --- LOGIC GỬI FORM (KHÔNG THAY ĐỔI, NHƯNG CẦN CHO PHẦN RESET) ---
    const form = document.getElementById('review-form');
    const statusMessage = document.getElementById('form-status');
    
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn form tải lại trang

            // Thêm kiểm tra để chắc chắn người dùng đã chọn đánh giá
            const ratingValue = document.getElementById('rating').value;
            if (!ratingValue || ratingValue < 1) {
                statusMessage.textContent = 'Vui lòng chọn điểm đánh giá của bạn.';
                statusMessage.style.color = 'red';
                return; // Dừng việc gửi form nếu chưa chọn sao
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'ĐANG GỬI...';
            statusMessage.textContent = '';

            const formData = new FormData(form);

            fetch('submit.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusMessage.textContent = data.message;
                    statusMessage.style.color = 'green';
                    form.reset(); // Xóa các trường trong form
                    
                    // CẬP NHẬT: Reset lại các ngôi sao về trạng thái ban đầu
                    document.getElementById('rating').value = '';
                    starContainer.querySelectorAll('i').forEach(s => {
                        s.classList.remove('ri-star-fill', 'selected');
                        s.classList.add('ri-star-line');
                    });

                } else {
                    statusMessage.textContent = data.message || 'Đã có lỗi xảy ra.';
                    statusMessage.style.color = 'red';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                statusMessage.textContent = 'Không thể kết nối tới máy chủ.';
                statusMessage.style.color = 'red';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'GỬI ĐÁNH GIÁ';
            });
        });
    }
    
    function animateNumber(elementId, start, end, duration) {
        const obj = document.getElementById(elementId);
        if (!obj) {
            console.warn(`Element with ID '${elementId}' not found for animation.`);
            return;
        }

        let current = start;
        const range = end - start;
        // Đảm bảo stepTime hợp lý, tránh chia cho 0 nếu range là 0
        const stepTime = range === 0 ? duration : Math.abs(Math.floor(duration / range)); 

        const timer = setInterval(() => {
            current += (end > start ? 1 : -1);
            obj.textContent = current;
            if ((end > start && current >= end) || (end < start && current <= end)) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    // Các ID của spinner và số tương ứng
    const spinners = {
        customerSpinner: 'customerCount',
        brandSpinner: 'brandCount',
        serviceSpinner: 'serviceCount'
    };

    // Thời gian giả lập tải (ví dụ 2 giây)
    const loadDelay = 2000; 

    // Hiện tất cả các spinner khi DOMContentLoaded
    for (const spinnerId in spinners) {
        const spinnerElement = document.getElementById(spinnerId);
        if (spinnerElement) {
            spinnerElement.classList.remove('hidden'); // Đảm bảo spinner hiển thị (nếu bạn đã thêm hidden vào nó)
        }
    }

    // Sau một khoảng thời gian, ẩn spinner và bắt đầu đếm số
    setTimeout(() => {
        for (const spinnerId in spinners) {
            const spinnerElement = document.getElementById(spinnerId);
            const numberElementId = spinners[spinnerId];
            const numberElement = document.getElementById(numberElementId);

            if (spinnerElement) {
                spinnerElement.classList.add('hidden'); // Ẩn spinner
            }
            if (numberElement) {
                numberElement.classList.remove('hidden'); // Hiện số
            }
        }

        // Bắt đầu animation đếm số sau khi spinner ẩn
        animateNumber('customerCount', 0, 12, 1000); // Khách hàng
        animateNumber('brandCount', 0, 20, 1000);    // Thương Hiệu Xe
        animateNumber('serviceCount', 0, 31, 1000);  // Lượt Dịch Vụ
    }, loadDelay);

    // --- LOGIC CHO BỘ LỌC ĐÁNH GIÁ ---
    const filterButtons = document.querySelectorAll('.filter-btn');
    const reviewCards = document.querySelectorAll('.reviews-list .review-card');

    if (filterButtons.length > 0 && reviewCards.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Lấy giá trị bộ lọc từ nút được nhấp
                const filterValue = button.getAttribute('data-filter');

                // Cập nhật trạng thái "active" cho nút
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // Lặp qua tất cả các thẻ đánh giá để ẩn hoặc hiện
                reviewCards.forEach(card => {
                    const cardRating = card.getAttribute('data-rating');

                    if (filterValue === 'all' || filterValue === cardRating) {
                        card.style.display = ''; // Hiện thẻ
                    } else {
                        card.style.display = 'none'; // Ẩn thẻ
                    }
                });
            });
        });
    }
});