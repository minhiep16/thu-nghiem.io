<?php
// user/user-edit-appointment.php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Truy cập bị từ chối.']);
    exit();
}

$userId = $_SESSION['id'];
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? 0;
$services = $data['services'] ?? '';
$date = $data['date'] ?? '';
$time = $data['time'] ?? '';

if (empty($id) || empty($date) || empty($time)) {
    http_response_code(400);
    echo json_encode(['error' => 'Vui lòng điền đầy đủ các trường.']);
    exit();
}
$appointment_datetime = $date . ' ' . $time;

$conn = new mysqli("localhost", "root", "", "datlich");
$conn->set_charset("utf8mb4");

// Bảo mật: Cập nhật chỉ khi `id` và `user_id` khớp VÀ trạng thái là 'chờ xác nhận'
$sql = "UPDATE appointments SET services=?, appointment_datetime=? WHERE id=? AND user_id=? AND status='chờ xác nhận'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $services, $appointment_datetime, $id, $userId);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(403);
        echo json_encode(['error' => 'Không thể sửa lịch hẹn này. Có thể nó đã được xác nhận hoặc không phải của bạn.']);
    }
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi khi cập nhật.']);
}
$stmt->close();
$conn->close();
?>