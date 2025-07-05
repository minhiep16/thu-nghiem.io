// Home.js (Đã tinh gọn)

// --- SLIDER LOGIC ---
const sliderItems = document.querySelectorAll('.slideritem');
let currentSlideIndex = 0;
const totalSlides = sliderItems.length;

function showNextSlide() {
    // Ẩn slide hiện tại
    if (totalSlides > 0) {
        sliderItems[currentSlideIndex].classList.remove('active');
        // Tăng index, quay về 0 nếu hết
        currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
        // Hiện slide tiếp theo
        sliderItems[currentSlideIndex].classList.add('active');
    }
}

// Kích hoạt slide đầu tiên và bắt đầu tự động chuyển
if (totalSlides > 0) {
    sliderItems[0].classList.add('active');
    setInterval(showNextSlide, 3000); // Chuyển slide mỗi 3 giây
}

// Lưu ý: Thư viện AOS đã được khởi tạo trong file Home.php
// Bạn không cần thêm code JavaScript cho hiệu ứng cuộn trang ở đây nữa.