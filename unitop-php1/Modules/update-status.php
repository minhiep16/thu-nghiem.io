<?php
// update-status.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
header('Content-Type: application/json');

// --- BẢO MẬT ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Phương thức không được phép.']);
    exit();
}

if (!isset($_SESSION['id'])) {
    http_response_code(403); // Forbidden
    echo json_encode(['error' => 'Bạn không có quyền thực hiện hành động này.']);
    exit();
}

// --- NHẬN DỮ LIỆU ---
$data = json_decode(file_get_contents('php://input'), true);
$appointmentId = $data['id'] ?? null;
$newStatus = $data['status'] ?? null;

// --- XÁC THỰC DỮ LIỆU ---
if (empty($appointmentId) || empty($newStatus)) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Dữ liệu không hợp lệ.']);
    exit();
}

$allowed_statuses = ['đã xác nhận', 'đã hủy'];
if (!in_array($newStatus, $allowed_statuses)) {
    http_response_code(400);
    echo json_encode(['error' => 'Trạng thái cập nhật không hợp lệ.']);
    exit();
}


// --- KẾT NỐI VÀ CẬP NHẬT DATABASE ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datlich";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi kết nối CSDL.']);
    exit();
}
$conn->set_charset("utf8mb4");

$sql = "UPDATE appointments SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $newStatus, $appointmentId);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Cập nhật trạng thái thành công!',
        'new_status' => $newStatus
    ]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi khi cập nhật CSDL.']);
}

$stmt->close();
$conn->close();

?>