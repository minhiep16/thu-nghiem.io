// Wait for the DOM to be fully loaded before running the script
document.addEventListener('DOMContentLoaded', function() {

    // Initialize AOS (Animate on Scroll)
    AOS.init({
        duration: 1000, // Animation duration in milliseconds
        once: true,      // Whether animation should happen only once - while scrolling down
        offset: 100,     // Offset (in px) from the original trigger point
    });

    // Simple parallax effect for the hero section
    window.addEventListener('scroll', function() {
        const hero = document.querySelector('.hero');
        // Check if the hero element exists to avoid errors on other pages
        if (hero) {
            let offset = window.pageYOffset;
            // The 0.5 value determines the speed of the parallax effect
            hero.style.backgroundPositionY = offset * 0.5 + 'px';
        }
    });

});


// script.js

function createSnowflake() {
    const snowflake = document.createElement('div');
    snowflake.classList.add('snowflake');
    snowflake.innerHTML = '❄'; // Hoặc bạn có thể dùng ký tự khác như '*' hoặc '.'
    document.body.appendChild(snowflake);

    // Kích thước ngẫu nhiên
    const randomSize = Math.random() * 1.5 + 0.5 + 'em';
    snowflake.style.fontSize = randomSize;

    // Vị trí bắt đầu ngẫu nhiên theo chiều ngang
    snowflake.style.left = Math.random() * 100 + '%';

    // Thời gian rơi ngẫu nhiên
    const randomFallTime = Math.random() * 10 + 5 + 's';
    snowflake.style.animationDuration = randomFallTime;

    // Độ trễ ngẫu nhiên để các bông tuyết không rơi cùng lúc
    const randomDelay = Math.random() * 5 + 's';
    snowflake.style.animationDelay = '-' + randomDelay;

    // Loại bỏ bông tuyết khi nó rơi hết màn hình để tránh quá nhiều phần tử
    setTimeout(() => {
        snowflake.remove();
    }, parseFloat(randomFallTime) * 1000);
}

// Tạo bông tuyết sau mỗi khoảng thời gian ngẫu nhiên
setInterval(createSnowflake, 200); // Điều chỉnh số 200 (milliseconds) để thay đổi tần suất bông tuyết rơi