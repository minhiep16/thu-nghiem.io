   <?php
    require "../Components/navbar.php";
    ?>
    

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuyên Sửa Chữa & Nâng Cấp Động Cơ Ô Tô</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="../Assets/styles/suaDongco.css">
</head>
<body>

    <div class="hero" id="home">
        <div class="container" data-aos="fade-in" data-aos-duration="1500">
            <h1>SỬA CHỮA ĐỘNG CƠ <br><span>CHUYÊN SÂU</span></h1>
            <p>Dịch vụ chẩn đoán, sửa chữa và nâng cấp hiệu suất động cơ hàng đầu với công nghệ hiện đại và đội ngũ chuyên gia tận tâm.</p>
            <a href="#contact" class="cta-button">Đặt Lịch Ngay</a>
        </div>
    </div>

    <section class="why-us" id="about">
        <div class="container">
            <div class="why-us-content" data-aos="fade-right">
                <div class="title-group">
                    <span class="letter">T</span>
                    <h2>Tại Sao Chọn Chúng Tôi?</h2>
                </div>
                <p>Chúng tôi không chỉ sửa chữa, chúng tôi phục hồi "trái tim" cho chiếc xe của bạn. Với sự kết hợp giữa kinh nghiệm dày dặn và niềm đam mê công nghệ, chúng tôi cam kết mang đến giải pháp toàn diện, giúp động cơ của bạn hoạt động mạnh mẽ, bền bỉ và hiệu quả hơn bao giờ hết.</p>
            </div>
            <div class="why-us-image" data-aos="fade-left" data-aos-delay="200">
                <img src="../Assets/img/suadongco_1.jpg" alt="Hai kỹ thuật viên đang làm việc">
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="container">
            <h2 data-aos="fade-up">Dịch Vụ Của Chúng Tôi</h2>
            <div class="services-grid">
                <div class="service-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://api.iconify.design/mdi:account-wrench.svg" alt="Kỹ thuật viên chuyên nghiệp">
                    <h3>Kỹ Thuật Viên Chuyên Nghiệp</h3>
                    <p>Đội ngũ chuyên gia được đào tạo bài bản, có nhiều năm kinh nghiệm trong việc xử lý các dòng động cơ phức tạp nhất.</p>
                </div>
                <div class="service-item" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://api.iconify.design/mdi:scanner.svg" alt="Chẩn đoán hiện đại">
                    <h3>Chẩn Đoán Hiện Đại</h3>
                    <p>Sử dụng thiết bị chẩn đoán tiên tiến nhất để xác định chính xác vấn đề, tiết kiệm thời gian và chi phí cho bạn.</p>
                </div>
                <div class="service-item" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://api.iconify.design/mdi:cogs.svg" alt="Phụ tùng chất lượng">
                    <h3>Phụ Tùng Chất Lượng</h3>
                    <p>Cam kết sử dụng phụ tùng chính hãng hoặc OEM chất lượng cao, đảm bảo độ bền và hiệu suất tối ưu cho động cơ.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="precision" id="process">
        <div class="container">
            <div class="precision-image" data-aos="fade-right" data-aos-delay="200">
                <img src="../Assets/img/suadongco_2.jpg" alt="Kỹ thuật viên đang kiểm tra chi tiết động cơ">
            </div>
            <div class="precision-content" data-aos="fade-left">
                <h2>QUY TRÌNH CHÍNH XÁC</h2>
                <p class="subtitle">TỪNG CHI TIẾT, TRỌN VẸN NIỀM TIN</p>
                <p>Mọi công đoạn, từ tháo rã, kiểm tra, sửa chữa đến lắp ráp, đều được thực hiện với sự tỉ mỉ và chính xác tuyệt đối. Chúng tôi đảm bảo mọi thành phần của động cơ đều được chăm sóc cẩn thận, phục hồi lại trạng thái hoạt động hoàn hảo như mới.</p>
                
            </div>
        </div>
    </section>

    <section class="performance" id="performance">
        <div class="container">
            <h2 data-aos="fade-up">NÂNG TẦM HIỆU SUẤT</h2>
            <p data-aos="fade-up" data-aos-delay="100">Không chỉ dừng lại ở sửa chữa, chúng tôi còn là chuyên gia trong việc nâng cấp và "độ" hiệu suất. Từ tinh chỉnh ECU, lắp đặt turbo tăng áp đến các giải pháp tùy chỉnh riêng biệt, chúng tôi giúp bạn khai phá toàn bộ sức mạnh tiềm ẩn của chiếc xe.</p>
            <div class="performance-image" data-aos="zoom-in" data-aos-delay="200">
                <img src="../Assets/img/suadongco_3.jpg" alt="Siêu xe với động cơ nâng cấp">
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="../Layouts/suaDongco.js"></script>

</body>
</html>
<?php
    require "../Components/footer.php";
    ?>