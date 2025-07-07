<?php
// get-appointment-details.php (FILE MỚI)
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['id']) || !isset($_GET['id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Truy cập bị từ chối hoặc thiếu ID.']);
    exit();
}

$id = intval($_GET['id']);
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

$sql = "SELECT id, name, phone, email, services, appointment_datetime FROM appointments WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Không tìm thấy lịch hẹn.']);
}

$stmt->close();
$conn->close();
?>