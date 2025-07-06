<?php
require_once 'db.php';
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Định dạng email không hợp lệ.";
    } elseif ($password !== $confirm_password) {
        $error = "Mật khẩu xác nhận không khớp.";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error = "Email này đã được đăng ký.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_sql = "INSERT INTO users (email, password) VALUES (?, ?)";
                if ($insert_stmt = $conn->prepare($insert_sql)) {
                    $insert_stmt->bind_param("ss", $email, $hashed_password);
                    if ($insert_stmt->execute()) {
                        header("location: login.php?registration_success=1");
                        exit();
                    } else {
                        $error = "Đã xảy ra lỗi. Vui lòng thử lại.";
                    }
                    $insert_stmt->close();
                }
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Tài Khoản</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../Assets/styles/login.css">
</head>
<body>
    <div class="container">
        <div class="info-panel">
            <div class="logo-wizard">
                <a href="../Modules/Home.php"><i class="fa-solid fa-house"></i>Car Care</a>
            </div>
            <div class="brand-name"></div>
            <h1>Chưa có tài khoản ?</h1>
            <div class="social-icons">
                <a href="https://www.facebook.com/?locale=vi_VN" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://github.com/" aria-label="Github"><i class="fab fa-github"></i></a>
            </div>
        </div>

        <div class="form-panel">
            <div class="logo-sharecode"></div>
            <h2>Đăng Kí</h2>    
            
            <?php if(!empty($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Mật Khẩu" required>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
                </div>
                <div class="form-group terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the all statements in <a href="#">Terms of service</a></label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Đăng Kí </button>
                </div>
                <div class="form-footer">
                    <p>Bạn đã có tài khoản ? <a href="login.php">Đăng Nhập</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>