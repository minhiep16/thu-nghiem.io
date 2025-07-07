<?php
/**
 * user/user-cancel-appointment.php
 * File này xử lý yêu cầu hủy lịch hẹn từ phía người dùng.
 */

session_start();
header('Content-Type: application/json');

// --- BẢO MẬT: Kiểm tra phương thức và phiên đăng nhập ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Phương thức yêu cầu không hợp lệ.']);
    exit();
}

if (!isset($_SESSION['id'])) {
    http_response_code(403); // Forbidden
    echo json_encode(['error' => 'Bạn phải đăng nhập để thực hiện hành động này.']);
    exit();
}

// --- Lấy dữ liệu từ yêu cầu ---
$userId = $_SESSION['id'];
$data = json_decode(file_get_contents('php://input'), true);
$appointmentId = $data['id'] ?? null;

if (empty($appointmentId)) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Thiếu ID của lịch hẹn.']);
    exit();
}

// --- Kết nối và xử lý Database ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datlich";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra lỗi kết nối
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Lỗi kết nối đến cơ sở dữ liệu.']);
    exit();
}

$conn->set_charset("utf8mb4");

// --- Logic XÓA ---
// Câu lệnh SQL này rất an toàn, nó chỉ xóa khi:
// 1. `id` của lịch hẹn khớp.
// 2. `user_id` của lịch hẹn khớp với người đang đăng nhập.
// 3. Trạng thái của lịch hẹn phải là 'chờ xác nhận'.
$sql = "DELETE FROM appointments WHERE id = ? AND user_id = ? AND status = 'chờ xác nhận'";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi khi chuẩn bị câu lệnh SQL.']);
    $conn->close();
    exit();
}

$stmt->bind_param("ii", $appointmentId, $userId);

if ($stmt->execute()) {
    // Kiểm tra xem có hàng nào thực sự bị xóa không
    if ($stmt->affected_rows > 0) {
        // Thành công
        echo json_encode([
            'success' => true,
            'message' => 'Đã hủy lịch hẹn thành công.'
        ]);
    } else {
        // Không có hàng nào bị xóa, có thể do lịch đã được xác nhận hoặc không tồn tại
        http_response_code(403);
        echo json_encode(['error' => 'Không thể hủy lịch hẹn này. Có thể nó đã được admin xác nhận hoặc không tồn tại.']);
    }
} else {
    // Lỗi khi thực thi câu lệnh
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi server khi cố gắng hủy lịch hẹn.']);
}

$stmt->close();
$conn->close();
?>