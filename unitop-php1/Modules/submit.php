<?php
session_start();


if (!isset($_SESSION['id'])) {
    header('Content-Type: application/json');
    http_response_code(403); 
    echo json_encode(['success' => false, 'message' => 'Bạn phải đăng nhập để gửi đánh giá.']);
    exit(); 
}


$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "datlich";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Lỗi kết nối CSDL.']);
    die();
}
$user_id = $_SESSION['id'];
$name    = trim($_POST['name'] ?? ''); 

$rating  = trim($_POST['rating'] ?? '');
$comment = trim($_POST['comment'] ?? '');

if (empty($rating) || !is_numeric($rating) || $rating < 1 || $rating > 5) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Vui lòng chọn điểm đánh giá hợp lệ.']);
    die();
}

$sql = "INSERT INTO reviews (user_id, name, rating, comment) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Lỗi khi chuẩn bị câu lệnh.']);
    die();
}

$stmt->bind_param("isis", $user_id, $name, $rating, $comment);

header('Content-Type: application/json');

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cảm ơn bạn đã gửi đánh giá!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gửi đánh giá thất bại. Vui lòng thử lại.']);
}

$stmt->close();
$conn->close();
?>