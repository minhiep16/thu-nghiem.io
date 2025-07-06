<?php
session_start();
require_once 'db.php';
$error = '';

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if ($_SESSION["role"] === 'admin') {
        header("location: admin_dashboard.php");
    } else {
        header("location: dashboard.php");
    }
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if (empty($email) || empty($password)) {
        $error = "Vui lòng nhập email và mật khẩu.";
    } else {
        $sql = "SELECT id, email, password, role FROM users WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $email, $hashed_password, $role);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["role"] = $role;                            
                            if ($role === 'admin') {
                                header("location: admin_dashboard.php");
                            } else {
                                header("location: dashboard.php");
                            }
                        } else {
                            $error = "Mật khẩu bạn nhập không đúng.";
                        }
                    }
                } else {
                    $error = "Không tìm thấy tài khoản với email này.";
                }
            } else {
                echo "Đã xảy ra lỗi. Vui lòng thử lại sau.";
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
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../Assets/styles/login.css">
</head>
<body>
    <div class="container"> 
        <div class="info-panel">
            <div class="logo-wizard">
                <a href="../Modules/Home.php"><i class="fa-solid fa-house"></i>Car Care</a>
            </div>
            <h1>WELCOME</h1>
            <p>Đăng nhập để trải nghiệm dịch vụ</p>
             <div class="social-icons">
                <a href="https://www.facebook.com/?locale=vi_VN" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://github.com/" aria-label="Github"><i class="fab fa-github"></i></a>
            </div>
        </div>

        <div class="form-panel">
            <div class="logo-sharecode"></div>
            <h2>Đăng Nhập</h2>

            <?php 
            if(!empty($error)){
                echo '<div class="error-message">' . $error . '</div>';
            }
            if(isset($_GET['registration_success'])){
                echo '<div class="success-message">Đăng ký thành công! Vui lòng đăng nhập.</div>';
            }
            ?>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Mật Khẩu" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Đăng Nhập </button>
                </div>
                <div class="form-footer">
                    <p>Chưa có tài khoản ? <a href="../Modules/register.php">Đăng Kí</a></p>
                </div>
            </form>
        </div>
    </div>
     
    <script src="../Assets/scripts/vanta-init.js"></script>
    
</body>
</html>