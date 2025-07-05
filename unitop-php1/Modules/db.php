<?php
// db.php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Mật khẩu mặc định của XAMPP là rỗng
define('DB_NAME', 'datlich');

// Tạo kết nối bằng MySQLi
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Kiểm tra kết nối
if($conn === false){
    die("LỖI: Không thể kết nối. " . $conn->connect_error);
}
?>