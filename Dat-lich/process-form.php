<?php
// file: htdocs/car-booking/process-form.php

// --- Cấu hình kết nối Database ---
$servername = "localhost";
$username = "root"; // Tên người dùng mặc định của XAMPP
$password = "";     // Mật khẩu mặc định của XAMPP là rỗng
$dbname = "datlich";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    // Trả về lỗi nếu không kết nối được và thoát
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi kết nối CSDL: ' . $conn->connect_error]);
    exit();
}

// Lấy dữ liệu JSON được gửi từ JavaScript
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

// Lấy từng giá trị từ dữ liệu
$title = $data['title'] ?? null;
$name = $data['name'] ?? null;
$phone = $data['phone'] ?? null;
$email = $data['email'] ?? null;
$brand = $data['brand'] ?? null;
$schedule = $data['schedule'] ? ($data['schedule'] ?: null) : null;
$message = $data['message'] ?? null;

// Chuyển mảng services thành một chuỗi duy nhất, phân cách bởi dấu phẩy
$servicesString = isset($data['services']) ? implode(', ', $data['services']) : null;

// --- Sử dụng Prepared Statements để chống SQL Injection ---
$sql = "INSERT INTO appointments (title, name, phone, email, services, brand, schedule, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi khi chuẩn bị câu lệnh SQL: ' . $conn->error]);
    exit();
}

// "s" nghĩa là string, "d" là double, "i" là integer. Tất cả các biến của chúng ta đều là string.
$stmt->bind_param("ssssssss", $title, $name, $phone, $email, $servicesString, $brand, $schedule, $message);

// Thực thi câu lệnh
$response = [];
if ($stmt->execute()) {
    $response['message'] = 'Đặt lịch thành công! Chúng tôi sẽ liên hệ với bạn sớm.';
    $response['appointmentId'] = $stmt->insert_id;
} else {
    http_response_code(400); // Bad Request
    if ($conn->errno == 1062) { // Mã lỗi cho việc trùng lặp UNIQUE key
        $response['error'] = 'Email này đã được sử dụng để đặt lịch.';
    } else {
        $response['error'] = 'Lỗi khi thực thi: ' . $stmt->error;
    }
}

// Đóng kết nối
$stmt->close();
$conn->close();

// Trả về phản hồi dạng JSON cho JavaScript
header('Content-Type: application/json');
echo json_encode($response);

?>