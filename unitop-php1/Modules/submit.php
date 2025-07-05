<?php
// submit.php

// Luôn bắt đầu session ở đầu file
session_start();

// <<< BẢO VỆ FILE: KIỂM TRA ĐĂNG NHẬP >>>
// Nếu không có session 'id', tức là chưa đăng nhập -> chặn ngay lập tức
if (!isset($_SESSION['id'])) {
    header('Content-Type: application/json');
    http_response_code(403); // Lỗi Forbidden (Cấm truy cập)
    echo json_encode(['success' => false, 'message' => 'Bạn phải đăng nhập để gửi đánh giá.']);
    exit(); // Dừng hoàn toàn
}


// --- 1. THÔNG TIN KẾT NỐI DATABASE ---
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "datlich";

// --- 2. TẠO VÀ KIỂM TRA KẾT NỐI ---
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Lỗi kết nối CSDL.']);
    die();
}
// --- 3. NHẬN DỮ LIỆU ---
// Lấy thông tin người dùng từ SESSION, không lấy từ form để đảm bảo an toàn
$user_id = $_SESSION['id'];

// <<< SỬA: Lấy tên trực tiếp từ form thay vì session >>>
$name    = trim($_POST['name'] ?? ''); 

$rating  = trim($_POST['rating'] ?? '');
$comment = trim($_POST['comment'] ?? '');

// Lấy thông tin người dùng từ SESSION, không lấy từ form để đảm bảo an toàn
// $user_id = $_SESSION['id'];
// $name    = $_SESSION['name'] ?? 'Ngươi an danh'; // Lấy tên từ session

// $rating  = trim($_POST['rating'] ?? '');
// $comment = trim($_POST['comment'] ?? '');

// --- 4. XÁC THỰC DỮ LIỆU ---
if (empty($rating) || !is_numeric($rating) || $rating < 1 || $rating > 5) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Vui lòng chọn điểm đánh giá hợp lệ.']);
    die();
}

// --- 5. CHUẨN BỊ LỆNH SQL ---
// Thêm user_id vào câu lệnh INSERT
$sql = "INSERT INTO reviews (user_id, name, rating, comment) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Lỗi khi chuẩn bị câu lệnh.']);
    die();
}

// --- 6. GẮN BIẾN VÀO LỆNH ---
// Thêm "i" cho user_id và biến $user_id
$stmt->bind_param("isis", $user_id, $name, $rating, $comment);

// --- 7. THỰC THI LỆNH VÀ TRẢ KẾT QUẢ ---
header('Content-Type: application/json');

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cảm ơn bạn đã gửi đánh giá!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gửi đánh giá thất bại. Vui lòng thử lại.']);
}

// --- 8. ĐÓNG KẾT NỐI ---
$stmt->close();
$conn->close();
?>