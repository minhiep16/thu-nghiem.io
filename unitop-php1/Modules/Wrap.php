<?php
require "../Components/footer.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Assets/Styles/Wrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>

    <div class="hero-section">
        <img src="../Assets/img/Wrap2.png" alt="" class="hero-image">
        <div class="hero-text">
            <h1><span id="typing-text-h1"></span></h1>
            <p><span id="typing-text-p"></span></p>
        </div>
    </div>
    <div class="main-container">
        <main class="content-grid">
            <div class="left-column" data-aos="fade-right">
                <h2>Vì Sao Nên WRAP?</h2>
                <div class="w-logo-container">
                    <div class="w-logo">W</div>
                    <p>
                        Wrapping không hoàn toàn là một giải pháp thay thế việc sơn mới xe, còn hơn thế nữa, wrapping giúp cá nhân hóa xe của bạn một cách linh hoạt & ấn tượng nhất.
                    </p>
                </div>
            </div>
            <div class="right-column">
                <div class="feature" data-aos="fade-left">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                    </div>
                    <h3>THƯƠNG HIỆU</h3>
                    <p>Thương hiệu hàng đầu thế giới trong lĩnh vực cá nhân hóa ô tô</p>
                </div>
                <div class="feature" data-aos="fade-left" data-aos-delay="100">
                    <div class="icon-wrapper">
                         <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"></path><path d="M15 6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM9 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 12a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path></svg>
                    </div>
                    <h3>ĐỘI NGŨ</h3>
                    <p>Đội ngũ Designer chuyên nghiệp với nhiều dự án được đánh giá cao</p>
                </div>
                <div class="feature" data-aos="fade-left" data-aos-delay="200">
                    <div class="icon-wrapper check-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <h3>QUI TRÌNH</h3>
                    <p>Qui trình làm việc tiêu chuẩn. Được đào tạo từ các chuyên gia Châu Âu</p>
                </div>
            </div>
        </main>
    </div>

    <section class="design-section">
        <div class="design-container">
            <div class="design-column-left" data-aos="fade-right">
                <h2>DESIGN FIRST</h2>
                <p class="design-subtitle">YOUR CAR. YOUR STYLE.</p>
                <p>
                    Với hệ thống chi nhánh trên toàn thế giới liên kết với nhau, sở hữu một nguồn cảm hứng & tài nguyên thiết kế vô cùng đồ sộ. Điều này có nghĩa là chúng tôi có thể mang đến cho bạn bất cứ ý tưởng nào từ tối giản đến phức tạp, áp dụng thiết kế trên bất cứ dòng xe nào có trên thị trường hiện nay.
                </p>
                <p>
                    Cá nhân hóa bằng phương pháp Wrapping vô cùng linh hoạt và phổ biến hiện nay. Bạn có thể khẳng định phong cách & cá tính của riêng mình thông qua các thiết kế, giúp xế yêu của bạn hoàn toàn nổi bật giữa đám đông. Đồng thời cũng là phương pháp bảo vệ lớp sơn gốc một cách hiệu quả.
                </p>
                <button>ĐẶT LỊCH NGAY</button>
            </div>

            <div class="design-column-right" data-aos="fade-left">
                <img src="../Assets/img/Wrap3.webp" alt="" class="map-image">
            </div>
        </div>
    </section>

    <script src="../Layouts/Wrap.js"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 1000, // Thời gian hiệu ứng (ms)
        once: true,     // Chỉ chạy hiệu ứng một lần
      });
    </script>
</body>
</html>

<?php
require "../Components/navbar.php";
?>