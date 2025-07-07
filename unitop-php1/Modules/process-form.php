<?php
// process-form.php (Đã nâng cấp)

// Thêm cơ chế xử lý lỗi an toàn
ini_set('display_errors', 0);
error_reporting(E_ALL);
set_exception_handler(function ($exception) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'Lỗi máy chủ không xác định.',
        'details' => $exception->getMessage()
    ]);
    exit();
});

session_start();
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['id'])) {
        http_response_code(403);
        echo json_encode(['error' => 'Truy cập bị từ chối. Bạn phải đăng nhập để thực hiện hành động này.']);
        exit();
    }

    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['error' => 'Dữ liệu JSON không hợp lệ.']);
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "datlich";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception('Lỗi kết nối CSDL: ' . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");

    // Lấy dữ liệu từ form
    $user_id = $_SESSION['id'];
    $title = $data['title'] ?? null;
    $name = $data['name'] ?? null;
    $phone = $data['phone'] ?? null;
    $email = $data['email'] ?? null;
    $message = $data['message'] ?? null;
    $address = $data['address'] ?? null;
    $servicesString = isset($data['services']) && is_array($data['services']) ? implode(', ', $data['services']) : null;
    
    // Nâng cấp: Lấy và xác thực ngày giờ
    $appointment_date = $data['date'] ?? null;
    $appointment_time = $data['time'] ?? null;

    if (empty($name) || empty($phone) || empty($email) || empty($appointment_date) || empty($appointment_time)) {
        http_response_code(400);
        echo json_encode(['error' => 'Vui lòng điền đầy đủ các trường bắt buộc: Tên, SDT, Email, Ngày và Giờ hẹn.']);
        exit();
    }
    
    // Nâng cấp: Kết hợp ngày và giờ, sau đó kiểm tra tính hợp lệ
    $appointment_datetime_str = $appointment_date . ' ' . $appointment_time;
    $appointment_datetime_obj = date_create_from_format('Y-m-d H:i', $appointment_datetime_str);

    if ($appointment_datetime_obj === false) {
        http_response_code(400);
        echo json_encode(['error' => 'Định dạng ngày giờ không hợp lệ.']);
        exit();
    }

    // Không cho đặt lịch trong quá khứ
    if ($appointment_datetime_obj < new DateTime()) {
        http_response_code(400);
        echo json_encode(['error' => 'Không thể đặt lịch trong quá khứ. Vui lòng chọn thời gian khác.']);
        exit();
    }
    
    $appointment_datetime_sql = $appointment_datetime_obj->format('Y-m-d H:i:s');
    
    // Nâng cấp: Logic kiểm tra xung đột lịch hẹn
    // Giả sử mỗi cuộc hẹn kéo dài 2 giờ. Ta sẽ kiểm tra xem có cuộc hẹn nào khác trong khoảng +/- 2 giờ không.
    $check_sql = "SELECT id FROM appointments WHERE status = 'đã xác nhận' AND appointment_datetime BETWEEN DATE_SUB(?, INTERVAL 1 HOUR) AND DATE_ADD(?, INTERVAL 1 HOUR)";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $appointment_datetime_sql, $appointment_datetime_sql);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        http_response_code(409); // 409 Conflict
        echo json_encode(['error' => 'Khung giờ bạn chọn đã có người đặt. Vui lòng chọn một thời gian khác.']);
        $check_stmt->close();
        $conn->close();
        exit();
    }
    $check_stmt->close();


    // Câu lệnh INSERT đã được cập nhật
    $sql = "INSERT INTO appointments (user_id, title, name, phone, email, services, message, address, appointment_datetime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        throw new Exception('Lỗi khi chuẩn bị câu lệnh SQL: ' . $conn->error);
    }
    
    // Cập nhật bind_param
    $stmt->bind_param("issssssss", $user_id, $title, $name, $phone, $email, $servicesString, $message, $address, $appointment_datetime_sql);

    $response = [];
    if ($stmt->execute()) {
        $response['message'] = 'Đặt lịch thành công! Lịch hẹn của bạn đang ở trạng thái "chờ xác nhận". Chúng tôi sẽ liên hệ sớm.';
    } else {
        http_response_code(400);
        $response['error'] = 'Lỗi khi thực thi câu lệnh: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Đã có lỗi xảy ra trong quá trình xử lý.',
        'details' => $e->getMessage()
    ]);
}
?>