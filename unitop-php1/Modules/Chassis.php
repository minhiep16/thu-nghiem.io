<?php
    // Giả sử navbar.php đã bắt đầu session
    require "../Components/navbar.php";

    // <<< THÊM MỚI: Lấy trạng thái đăng nhập >>>
    $isUserLoggedIn = isset($_SESSION['id']);
    
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dịch Vụ Khung Gầm Chuyên Nghiệp</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/Styles/Chassis.css">
</head>
<body>
    <div class="hero-section">
        <img src="../Assets/img/Chassis.webp" alt="Xe thể thao trên đường đèo" class="hero-image">
        <div class="overlay"></div>
        <div class="content">
            <p class="subtitle">DỊCH VỤ</p>
            <h1 class="title">KHUNG GẦM</h1>
        </div>
    </div>

    <?php
    // Kết nối CSDL (giữ nguyên)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "datlich";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function getAllChassisItems($conn) {
        // Đã sửa để lấy cả ID
        $sql = "SELECT id, image_url, name, price FROM chassis ORDER BY name ASC";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Lỗi prepare SQL: ' . htmlspecialchars($conn->error));
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    }

    $chassisItems = getAllChassisItems($conn);
    ?>

    <div class="content1">
        <h1 data-aos="fade-up">PHỤ KIỆN NÂNG CẤP</h1>
        <div class="Dichvunoibat">
            <?php if (!empty($chassisItems)):
                foreach ($chassisItems as $item): ?>
                    <div class="Dichvunoibat1" data-aos="fade-up">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                        <p>Giá: <?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</p>
                        <button class="add-to-cart-btn" data-id="<?php echo $item['id']; ?>">Thêm vào giỏ hàng</button>
                    </div>
                <?php endforeach; 
            endif; ?>
        </div>
    </div> 
    
    
    <div id="toast-message"></div>

    <?php
    $conn->close();
    ?>

    <div class="info-section">
        <h1>KHUNG GẦM</h1>
        <div class="info-block layout-image-left" data-aos="fade-right">
            <div class="info-image">
                <img src="../Assets/img/Chassis2.png" alt="">
            </div>
            <div class="info-text">
                <h2>GIỚI THIỆU CHUNG</h2>
                <p class="sub-heading">KHUNG GẦM VÀ PHỤ KIỆN</p>
                <p>Dịch vụ khung gầm là một trong những hạng mục bảo dưỡng quan trọng...</p>
            </div>
        </div>
        <div class="info-block layout-text-top" data-aos="fade-left">
            <div class="info-text">
                <h2>QUY TRÌNH THỰC HIỆN</h2>
                <p>Chúng tôi tiến hành kiểm tra tổng thể hệ thống khung gầm bằng máy chuyên dụng...</p>
            </div>
            <button>ĐẶT LỊCH NGAY</button>
            <div class="info-image">
                <img src="../Assets/img/Chassis3.jpg" alt="">
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="../Layouts/Chassis.js"></script> </body>
</body>
</html>

<?php
    require "../Components/footer.php";
?>