<?php
require "../Components/navbar.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAR CARE</title>
    <link rel="stylesheet" href="../Assets/styles/PPF.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <div class="cont">
        <div class="hero-section">
            <img src="../Assets/img/PPF2.jpg" alt="" class="hero-image">
            <div class="hero-text">
                <h1><span id="typing-text-h1"></span></h1>
                <p><span id="typing-text-p"></span></p>
            </div>
        </div>
        <section class="design-section">
            <div class="design-PPF5">
                <div class="timeline" data-aos="fade-right">
                    <h1>Quy Trình Dán PPF</h1>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h2>Bước 1: Vệ sinh bề mặt</h2>
                            <p>Làm sạch hoàn toàn bụi bẩn, dầu mỡ trên bề mặt cần dán để đảm bảo độ bám dính tốt nhất.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h2>Bước 2: Canh chỉnh & cắt phim</h2>
                            <p>Đo đạc chính xác và cắt phim PPF theo hình dạng phù hợp với bề mặt thiết bị hoặc xe.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h2>Bước 3: Dán phim</h2>
                            <p>Sử dụng dung dịch hỗ trợ và dụng cụ gạt để dán đều phim lên bề mặt mà không để lại bọt khí.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h2>Bước 4: Hoàn thiện & kiểm tra</h2>
                            <p>Gạt khô, sấy phim, kiểm tra kỹ các góc cạnh và đảm bảo độ bám dính hoàn hảo.</p>
                        </div>
                    </div>
                </div>
                <img src="../Assets/img/PPF5.jpg" alt="" data-aos="fade-left">
            </div>
            <div class="design-container">
                <div class="design-column-right" data-aos="fade-right">
                    <img src="../Assets/img/PPF3.jpg" alt="" class="map-image">
                </div>
                <div class="design-column-left" data-aos="fade-left">
                    <h2>DÁN PPF</h2>
                    <p class="design-subtitle">Bảo vệ bề mặt sơn</p>
                    <p>
                        PPF hay còn gọi là Paint Protection Film là một lớp keo đặc biệt có vai trò như tấm lá chắn bảo vệ lớp sơn “zin” khỏi những vết xước đáng tiếc và các tác nhân thời tiết.
                    </p>
                    <img src="../Assets/img/PPF4.jpg" alt="">
                    <a href="../Modules/login.php"><button>ĐẶT LỊCH NGAY</button></a>
                </div>
            </div>
        </section>
    </div>
    <script src="Layouts/PPF.js"></script>
    
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 1000, 
        once: true,
      });
    </script>
</body>
</html>

<?php
require "../Components/footer.php";
?>