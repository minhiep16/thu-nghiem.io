 <?php
    require "../Components/navbar.php";
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAR CARE</title>
    <link rel="stylesheet" href="../Assets/Styles/Wash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <div class="cont">
        <div class="banner">
            <div class="banner-content">
                <h1 class="main-title">RỬA XE</h1>
                <p class="subtitle">WASHING</p>
            </div>
            <div class="race-track">
                <i class="fa-solid fa-car-side car-icon car-color" data-speed="1.5"></i>
                <i class="fa-solid fa-plane car-icon plane-color" data-speed="2.0"></i>
                <i class="fa-solid fa-shuttle-space car-icon shuttle-color" data-speed="2.5"></i>
                <i class="fa-solid fa-person-biking car-icon biking-color" data-speed="1.0"></i>
            </div>
        </div>

        <div class="container1">
            <div class="card" data-aos="fade-right">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wheel">
                        <path d="M22 12a10 10 0 1 1-20 0a10 10 0 0 1 20 0Z"/>
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0-4 0Z"/>
                        <path d="M12 2v2"/><path d="M12 20v2"/><path d="M22 12h-2"/><path d="M4 12H2"/>
                        <path d="m19.39 4.61-1.41 1.41"/><path d="m6.02 17.98-1.41 1.41"/>
                        <path d="m4.61 4.61 1.41 1.41"/><path d="m17.98 17.98 1.41 1.41"/>
                    </svg>
                </div>
                <h2>NGOẠI THẤT</h2>
                <p>Chăm sóc ngoại thất giúp bảo vệ và duy trì giá trị của xe. Phát hiện kịp thời những vấn đề tiềm ẩn ở các bộ phận quan trọng (phanh, lốp, đèn...) để khắc phục và sửa chữa, đảm bảo sự an toàn khi lái xe...</p>
            </div>

            <div class="main-image" data-aos="fade-up">
                <img src="../Assets/img/Wash1.png" alt="Car Washing">
            </div>

            <div class="card" data-aos="fade-left">
                <div class="icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-box"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><path d="M16 8h-6a2 2 0 0 0-2 2v6h6a2 2 0 0 0 2-2V8z"/></svg>
                </div>
                <h2>NỘI THẤT</h2>
                <p>Loại bỏ các tác nhân gây hại cho sức khỏe (bụi bẩn, vết bám, mùi hôi...) bên trong phát sinh khi sử dụng xe. Tạo cảm giác thoải mái, thư giãn khi lái xe. Đồng thời giúp duy trì vẻ đẹp nguyên bản của xe...</p>
            </div>
        </div>

        <div class="container2">
            <div class="main-image" data-aos="fade-right">
                <img src="../Assets/img/Wash2.png" alt="Car Washing">
            </div>

            <div class="card" data-aos="fade-up">
                <div class="icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                </div>
                <h2>CHUYÊN SÂU</h2>
                <p>Rửa xe chuyên sâu giúp làm sạch toàn diện từ trong ra ngoài, bảo vệ sơn xe, tăng độ bền và giữ xe luôn như mới.</p>
            </div>

            <div class="main-image" data-aos="fade-left">
                <img src="../Assets/img/Wash3.jpg" alt="Car Washing">
            </div>
        </div>

        <div class="container3">
            <video autoplay muted loop id="background-video">
                <source src="../Assets/img/Wash.mp4" type="video/mp4">
            </video>
            <div class="card" data-aos="zoom-in">
                <p>Dịch vụ rửa xe chuyên nghiệp của chúng tôi mang đến sự chăm sóc toàn diện cho xế yêu của bạn. Từ rửa xe cơ bản đến rửa xe chuyên sâu, chúng tôi sử dụng công nghệ hiện đại và dung dịch chất lượng cao để đảm bảo xe sạch bóng, bền đẹp và luôn như mới. Hãy trải nghiệm sự khác biệt ngay hôm nay!</p>
                <a href ="../Modules/login.php" ><button>ĐẶT LỊCH NGAY</button> </a>
            </div>
        </div>
    </div>
    <script src="../Layouts/Wash.js"></script>
    
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