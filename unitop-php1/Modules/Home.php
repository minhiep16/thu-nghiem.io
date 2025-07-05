<?php
// Home.php (Đã cập nhật)
require "../Components/navbar.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - WrapStyle</title>
    <link rel="stylesheet" href="../Assets/styles/Home.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>

    <section class="hero-section">
        <video autoplay muted loop id="background-video">
            <source src="../Assets/img/Home.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="overlay"></div>
        <div class="hero-content" data-aos="fade-in" data-aos-duration="1500">
            <h1>CAR TUNING</h1>
            <p class="subtitle">DESIGN | WRAPPING & PAINTING | BODY KIT | INTERIOR</p>
            <p class="description">
                Một ý tưởng "đột phá" sẽ giúp xe của bạn nổi bật giữa hàng ngàn chiếc khác. Từ dáng vẻ, hiệu suất đến từng chi tiết nhỏ đều có thể là điểm nhấn nổi bật của riêng bạn.
            </p>
        </div>
    </section>

    <section class="slider">
        <div class="slideritems">
            <div class="slideritem"><img src="../Assets/img/Banner5.webp" alt="Banner 5"></div>
            <div class="slideritem"><img src="../Assets/img/Banner1.jpg" alt="Banner 1"></div>
            <div class="slideritem"><img src="../Assets/img/Banner2.jpg" alt="Banner 2"></div>
            <div class="slideritem"><img src="../Assets/img/Banner3.webp" alt="Banner 3"></div>
            <div class="slideritem"><img src="../Assets/img/Banner4.jpg" alt="Banner 4"></div>
        </div>
    </section>

    <div class="container page-container">
        <section class="featured-services">
            <h1 data-aos="fade-up">DỊCH VỤ NỔI BẬT</h1>
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <img src="../Assets/img/PPF1.webp" alt="Dán PPF">
                    <h2>DÁN PPF</h2>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <img src="../Assets/img/Wrap1.webp" alt="Wrap đổi màu">
                    <h2>WRAP ĐỔI MÀU</h2>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <img src="../Assets/img/Wash1.png" alt="Rửa xe detailing">
                    <h2>RỬA XE DETAILING</h2>
                </div>
            </div>
        </section>

        <section class="about-us-title" data-aos="fade-up">
            VỀ CHÚNG TÔI
        </section>

        <section class="about-us-content">
            <div class="about-text" data-aos="fade-right">
                <h2>NIỀM ĐAM MÊ BẤT TẬN</h2>
                <p>
                    Tại đây, chúng tôi không chỉ coi xe hơi là một phương tiện, mà đó còn là một tài sản và niềm đam mê. Được thành lập bởi đội ngũ chuyên gia giàu kinh nghiệm, chúng tôi ra đời với sứ mệnh mang đến những giải pháp chăm sóc và nâng cấp xe toàn diện, chuyên nghiệp và đáng tin cậy nhất cho khách hàng.
                </p>
                <a href="vechungtoi.php" class="btn-more">TÌM HIỂU THÊM</a>
            </div>
            <div class="about-image" data-aos="fade-left">
                 <img src="../Assets/img/Vechungtoi.webp" alt="Về chúng tôi">
            </div>
        </section>
    </div>

    <?php require "../Components/footer.php"; ?>

    <script src="../Layouts/Home.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 1000, 
        once: true, // Hiệu ứng chỉ chạy 1 lần
      });
    </script>
</body>
</html>