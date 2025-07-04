    <?php
    session_start();

    // <<< THAY ĐỔI QUAN TRỌNG: Đồng bộ tên biến session >>>
    // Sử dụng 'id' thay vì 'user_id' để khớp với file login.php của bạn.
    if (!isset($_SESSION['id'])) { 
        // <<< THÊM MỚI: Ghi nhớ lại URL trang này >>>
        // Trước khi chuyển hướng đi, lưu lại đường dẫn hiện tại để có thể quay về.
        $_SESSION['redirect_after_login'] = '/dat-lich.php'; // Hoặc $_SERVER['REQUEST_URI']

        // Chuyển hướng đến trang login.php của bạn
        header("Location: login.php?error=Vui lòng đăng nhập để đặt lịch");
        exit();
    }

    // Lấy thông tin user từ session (đồng bộ với file login.php của bạn)
    // Giả sử bạn cũng lưu 'name' vào session sau khi login. Nếu không, bạn cần truy vấn DB để lấy.
    $loggedInUserName = $_SESSION['name'] ?? 'Người dùng'; 
    $loggedInUserEmail = $_SESSION['email'] ?? '';

    require "../Components/navbar.php";
    ?>
            
   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/styles/Home.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>Document</title>
</head>
<body>
    <div class="cont">
        <section class="slider">
            <div class="slideritems">
                <div class="slideritem">
                    <img src="../Assets/img/Banner5.webp" alt="">
                </div>
                <div class="slideritem">
                    <img src="../Assets/img/Banner1.jpg" alt="">
                </div>
                <div class="slideritem">
                    <img src="../Assets/img/Banner2.jpg" alt="">
                </div>
                <div class="slideritem">
                    <img src="../Assets/img/Banner3.webp" alt="">
                </div>
                <div class="slideritem">
                    <img src="../Assets/img/Banner4.jpg" alt="">
                </div>
                <div class="slideritem">
                    <img src="../Assets/img/Banner5.webp" alt="">
                </div>
                <div class="slideritem">
                    <img src="../Assets/img/Banner1.jpg" alt="">
                </div>
            </div>
        </section>

        <section class="content1">
            <h1 data-aos="fade-up">DỊCH VỤ NỔI BẬT</h1>
            <div class="Dichvunoibat">
                <div class="Dichvunoibat1" data-aos="fade-up" data-aos-delay="100">
                    <img src="../Assets/img/PPF1.webp" alt="">
                    <h2>DÁN PPF</h2>
                </div>
                <div class="Dichvunoibat1" data-aos="fade-up" data-aos-delay="200">
                    <img src="../Assets/img/Wrap1.webp" alt="">
                    <h2>WRAP</h2>
                </div>
                <div class="Dichvunoibat1" data-aos="fade-up" data-aos-delay="300">
                    <img src="../Assets/img/Wash1.png" alt="">
                    <h2>RỬA XE</h2>
                </div>
            </div>
        </section>

        <section class="content15" data-aos="fade-up">
            VỀ CHÚNG TÔI
        </section>

        <section class="content2">
            <div class="Vechungtoi" data-aos="fade-right">
                <p>Là một công ty hàng đầu từ dưới đếm lên trong lĩnh vực xe hơi. Với bề dày lịch sử hơn 1 tuần hình thành và phát triển, luôn là sự lựa chọn chưa tin cậy lắm cho các tín đồ đam mê xe.</p>
                <p>Là đơn vị chuyên cung cấp các dịch vụ về xe cộ như rửa và sửa xe. Tại đây chúng tôi không cam kết khách hàng sẽ nhận được những dịch vụ được thực hiện với: <br>
                    -Kỹ thuật viên chuyên môn cao, được đào tạo chính quy <br>
                    -Trang thiết bị hiện đại, đảm bảo độ chính xác cao <br>
                    -Thao tác nhanh, gọn, chính xác, đúng tiêu chuẩn <br>
                    -Không gian khoang dịch vụ sạch sẽ, ngăn nắp​ <br>
                    -Chi phí dịch vụ với chất lượng phù hợp</p>
            </div>
            <img src="../Assets/img/Vechungtoi.webp" alt="" data-aos="fade-left">
        </section>

        <section class="hero-section">
            <video autoplay muted loop id="background-video">
                <source src="../Assets/img/Home.mp4" type="video/mp4">
            </video>
            <div class="overlay"></div>
            <div class="content">
                <h1>CAR TUNING</h1>
                <p class="subtitle">DESIGN | WRAPPING & PAINTING | BODY KIT | INTERIOR</p>
                <p class="description">
                    Một ý tưởng "đổi tốt" sẽ giúp xe của bạn nổi bật giữa hàng ngàn chiếc khác. Tứ dáng vẻ, hiệu suất đến từng chi tiết nhỏ đều có thể là điểm nhấn nổi bật của riêng bạn. Ý tưởng không chỉ dừng lại ở khía cạnh tưởng tượng, đôi khi nó đến từ sự đam mê, kinh nghiệm & trải nghiệm. Và ý tưởng giúp cho bạn vượt và khỏi những khuôn mẫu có sẵn.
                </p>
            </div>
        </section>
    </div> 

    <script src="../Layouts/Home.js"></script>

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