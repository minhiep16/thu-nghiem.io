<?php
// edit-appointment.php (FILE MỚI)
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Truy cập bị từ chối.']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

// Xác thực dữ liệu
$id = $data['id'] ?? 0;
$name = $data['name'] ?? '';
$phone = $data['phone'] ?? '';
$email = $data['email'] ?? '';
$services = $data['services'] ?? '';
$date = $data['date'] ?? '';
$time = $data['time'] ?? '';

if (empty($id) || empty($name) || empty($phone) || empty($date) || empty($time)) {
    http_response_code(400);
    echo json_encode(['error' => 'Vui lòng điền đầy đủ các trường bắt buộc.']);
    exit();
}

$appointment_datetime = $date . ' ' . $time;

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

$sql = "UPDATE appointments SET name=?, phone=?, email=?, services=?, appointment_datetime=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $name, $phone, $email, $services, $appointment_datetime, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi khi cập nhật lịch hẹn.']);
}

$stmt->close();
$conn->close();
?>