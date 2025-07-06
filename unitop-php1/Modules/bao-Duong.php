<?php
require "../Components/navbar.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Auto - Bảo Dưỡng & Nâng Cấp Siêu Xe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="../Assets\styles\bao-Duong.css">
</head>
<body>
    <header class="hero" id="home">
        <div class="hero-content">
            <h3 data-aos="fade-down">APEX AUTO PERFORMANCE</h3>
            <h1 data-aos="fade-up" data-aos-delay="100">DỊCH VỤ ĐẲNG CẤP <br><span>DÀNH CHO OTÔ</span></h1>
            <a href="#services" class="cta-button" data-aos="fade-up" data-aos-delay="200">Khám Phá Dịch Vụ</a>
        </div>
    </header>

    <section class="intro" id="about">
        <div class="container">
            <div class="intro-image" data-aos="zoom-in-right">
                <img src="..\Assets\img\toandien5.jpg" alt="">
            </div>
            <div class="intro-content" data-aos="fade-left">
                <h2>ĐỘ CHÍNH XÁC LÀ NIỀM ĐAM MÊ</h2>
                <p>Tại Apex Auto, chúng tôi tin rằng mỗi chiếc siêu xe là một kiệt tác kỹ thuật. Đó là lý do chúng tôi thực hiện mỗi quy trình bảo dưỡng với sự tỉ mỉ tuyệt đối, kết hợp giữa tay nghề thủ công và công nghệ chẩn đoán tiên tiến nhất.</p>
                <div class="stats">
                    <div class="stat-item">
                        <h4>1</h4>
                        <p>Tuần kinh nghiệm</p>
                    </div>
                    <div class="stat-item">
                        <h4>500+</h4>
                        <p>Khách hàng hài lòng</p>
                    </div>
                    <div class="stat-item">
                        <h4>24/7</h4>
                        <p>Hỗ trợ chuyên gia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>DỊCH VỤ ĐẲNG CẤP</h2>
                <p>Từ bảo dưỡng định kỳ đến nâng cấp hiệu suất phức tạp, chúng tôi cung cấp giải pháp toàn diện.</p>
            </div>
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-icon">
                        <img src="https://api.iconify.design/mdi:car-wrench.svg" alt="Kiểm tra tổng quát">
                    </div>
                    <h3>Kiểm Tra Tổng Quát</h3>
                    <p>Soi rọi từng chi tiết với quy trình kiểm tra toàn diện, đảm bảo mọi hệ thống hoạt động hoàn hảo.</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-icon">
                        <img src="https://api.iconify.design/mdi:oil-level.svg" alt="Thay dầu và chất lỏng">
                    </div>
                    <h3>Thay Dầu & Chất Lỏng</h3>
                    <p>Sử dụng các loại dầu và dung dịch cao cấp nhất, được khuyến nghị bởi nhà sản xuất.</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-icon">
                        <img src="https://api.iconify.design/mdi:rocket-launch-outline.svg" alt="Nâng cấp hiệu suất">
                    </div>
                    <h3>Nâng Cấp Hiệu Suất</h3>
                    <p>Giải phóng sức mạnh tiềm ẩn với các gói nâng cấp ECU, pô, và hệ thống nạp/xả.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="process" id="process">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>QUY TRÌNH LÀM VIỆC</h2>
                <p>Minh bạch, chuyên nghiệp và hiệu quả trong từng bước.</p>
            </div>
            <div class="process-timeline">
                <div class="timeline-item" data-aos="fade-right">
                    <div class="timeline-content">
                        <span class="step-number">01</span>
                        <h3>Tiếp Nhận & Tư Vấn</h3>
                        <p>Lắng nghe nhu cầu của bạn và kiểm tra sơ bộ tình trạng xe.</p>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-left">
                    <div class="timeline-content">
                        <span class="step-number">02</span>
                        <h3>Chẩn Đoán Công Nghệ Cao</h3>
                        <p>Sử dụng thiết bị hiện đại để xác định chính xác mọi vấn đề.</p>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-right">
                    <div class="timeline-content">
                        <span class="step-number">03</span>
                        <h3>Thực Hiện Dịch Vụ</h3>
                        <p>Các kỹ thuật viên lành nghề tiến hành bảo dưỡng hoặc sửa chữa.</p>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-left">
                    <div class="timeline-content">
                        <span class="step-number">04</span>
                        <h3>Kiểm Tra & Bàn Giao</h3>
                        <p>Kiểm tra chất lượng lần cuối và bàn giao xe trong tình trạng hoàn hảo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery" id="gallery">
        <div class="container">
             <div class="section-title" data-aos="fade-up">
                <h2>DỰ ÁN NỔI BẬT</h2>
                <p>Nơi những kiệt tác được chăm sóc và thăng hoa.</p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item" data-aos="zoom-in"><img src="..\Assets\img\toandien4.jpg" alt=""></div>
                <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100"><img src="..\Assets\img\toandien2.jpg" alt=""></div>
                <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200"><img src="..\Assets\img\toandien1.jpg" alt=""></div>
                <div class="gallery-item" data-aos="zoom-in" data-aos-delay="300"><img src="..\Assets\img\toandien3.jpg" alt=""></div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <h2 data-aos="fade-up">SẴN SÀNG TRẢI NGHIỆM SỰ KHÁC BIỆT?</h2>
            <p data-aos="fade-up" data-aos-delay="100">Hãy để các chuyên gia của chúng tôi chăm sóc chiếc xe của bạn.</p>
            <a href="#contact" class="cta-button" data-aos="fade-up" data-aos-delay="200">Đặt Lịch Ngay</a>
        </div>
    </section>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="../Layouts\bao-Duong.js"></script>

</body>
</html>
<?php
require "../Components/footer.php";
?>