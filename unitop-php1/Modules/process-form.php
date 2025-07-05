<?php
// <<< THÊM MỚI: BẢO VỆ TOÀN BỘ FILE >>>
session_start();

// Kiểm tra nếu session 'id' không tồn tại, tức là chưa đăng nhập
if (!isset($_SESSION['id'])) {
    // Trả về lỗi và dừng thực thi ngay lập tức
    header('Content-Type: application/json');
    http_response_code(403); // Lỗi Forbidden
    echo json_encode(['error' => 'Truy cập bị từ chối. Bạn phải đăng nhập để thực hiện hành động này.']);
    exit();
}


// --- PHẦN CÒN LẠI CỦA FILE ---

// --- Cấu hình kết nối Database ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datlich";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi kết nối CSDL: ' . $conn->connect_error]);
    exit();
}

// <<< THÊM MỚI: Lấy user_id từ session đã được xác thực >>>
$user_id = $_SESSION['id'];

// Lấy dữ liệu từ POST (vì form được submit theo phương thức POST)
$data = $_POST;
// Dự phòng nếu dữ liệu được gửi dưới dạng JSON
if (empty($data)) {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);
}


// Lấy từng giá trị từ dữ liệu
$title = $data['title'] ?? null;
$name = $data['name'] ?? null;
$phone = $data['phone'] ?? null;
$email = $data['email'] ?? null;
$brand = $data['brand'] ?? null;
$schedule = $data['schedule'] ?: null;
$message = $data['message'] ?? null;
$servicesString = isset($data['services']) ? implode(', ', $data['services']) : null;


// <<< SỬA: Thêm user_id vào câu lệnh INSERT để liên kết lịch hẹn với người dùng >>>
$sql = "INSERT INTO appointments (user_id, title, name, phone, email, services, brand, schedule, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode(['error' => 'Lỗi khi chuẩn bị câu lệnh SQL: ' . $conn->error]);
    exit();
}

// <<< SỬA: Thêm "i" cho user_id và truyền biến $user_id vào >>>
$stmt->bind_param("issssssss", $user_id, $title, $name, $phone, $email, $servicesString, $brand, $schedule, $message);

$response = [];
if ($stmt->execute()) {
    $response['message'] = 'Đặt lịch thành công! Chúng tôi sẽ liên hệ với bạn sớm.';
    $response['appointmentId'] = $stmt->insert_id;
} else {
    http_response_code(400);
    $response['error'] = 'Lỗi khi thực thi: ' . $stmt->error;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>