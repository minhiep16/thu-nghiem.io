<?php
session_start();

if (!isset($_SESSION['id'])) { 
    $_SESSION['redirect_after_login'] = '../Modules/Home.php';

    header("Location: login.php?error=Vui lòng đăng nhập để đặt lịch");
    exit();
}


$loggedInUserName = $_SESSION['name'] ?? 'Người dùng'; 
$loggedInUserEmail = $_SESSION['email'] ?? '';

require "../Components/navbar.php";
?>
        
   
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Care - Đặt Lịch Hẹn</title>
    <link rel="stylesheet" href="../Assets/styles/datlich.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="content"> 
        <div class="booking-container">
            <div class="info-side">
                <div class="logo-text"><h1>NÂNG CẤP</h1><h1 class="yellow-text">CHUYẾN ĐI</h1><h1 class="yellow-text">CỦA BẠN</h1></div>
                <div class="contact-info">
                    <p>Để có những trải nghiệm tốt nhất khi đến với Car Care, bạn có thể đặt lịch trước theo form hoặc liên hệ qua số Hotline: <strong>+84 909 999 999</strong></p>
                    <p>Hoặc liên hệ theo các thông tin bên dưới.</p>
                </div>
            </div>
            
            <div class="form-side">
                <h2>Thông Tin Cá Nhân</h2>
                <div id="js-stripe-bar" class="stripe-bar"></div>

                <div id="auth-error" class="auth-error-message" style="display:none;"></div>

                <form id="booking-form" action="process-form.php" method="POST">
                    <div class="form-row">
                        <div class="form-group half-width">
                            <select id="title" name="title">
                                <option value="Mr">Mr</option> <option value="Mrs">Mrs</option> <option value="Ms">Ms</option>
                            </select>
                        </div>
                        <div class="form-group half-width">
                            <input type="text" id="name" name="name" placeholder="Tên" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="tel" id="phone" name="phone" placeholder="SDT" required>
                    </div>

                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <label class="services-label">Dịch Vụ</label>
                        <div class="checkbox-group">
                            <label><input type="checkbox" name="services[]" value="wrapping"> WRAPPING</label>
                            <label><input type="checkbox" name="services[]" value="detailing"> WASHING</label>
                            <label><input type="checkbox" name="services[]" value="ppf"> PPF</label>
                            <label><input type="checkbox" name="services[]" value="window_tinting"> SỬA CHỮA KHUNG GẦM</label>
                            <label><input type="checkbox" name="services[]" value="others"> SỬA CHỮA ĐỘNG CƠ</label>
                            <label><input type="checkbox" name="services[]" value="others"> SỬA CHỮA TOÀN DIỆN</label>
                            <label><input type="checkbox" name="services[]" value="others"> OTHERS</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group half-width">
                            <div class="form-group">
                                <textarea id="message" name="message" rows="5" placeholder="Lưu ý ngày giờ"></textarea>
                            </div>
                            </select>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" rows="5" placeholder="Địa chỉ"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="terms-label">
                            <input type="checkbox" id="terms" name="terms" required> I have read the "General Terms Of Use" and agree with it
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit">ĐẶT LỊCH HẸN</button>
                    </div>
                </form>
               <script src="../Layouts/dat-lich.js"></script>
        </div>
    </div>  
</div>  
</body>
</html>     
    




<?php
require "../Components/footer.php";
?>