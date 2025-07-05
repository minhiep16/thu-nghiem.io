<?php
// cart_handler.php

// Luôn bắt đầu session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// <<< THÊM MỚI: BẢO VỆ TOÀN BỘ FILE >>>
// Kiểm tra nếu session 'id' không tồn tại, tức là chưa đăng nhập
if (!isset($_SESSION['id'])) {
    // Trả về lỗi và dừng thực thi ngay lập tức
    header('Content-Type: application/json');
    http_response_code(403); // Lỗi 403 Forbidden (Cấm truy cập)
    echo json_encode([
        'success' => false,
        'message' => 'Bạn phải đăng nhập để thực hiện hành động này.',
        'action' => 'redirect_login' // Gửi tín hiệu để JS chuyển hướng
    ]);
    exit();
}
// --- KẾT THÚC PHẦN BẢO VỆ ---


// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Lấy hành động từ yêu cầu POST của JavaScript
$action = $_POST['action'] ?? '';
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

// Xử lý các hành động khác nhau
switch ($action) {
    case 'add':
        if ($product_id > 0) {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]++; // Tăng số lượng nếu đã có
            } else {
                $_SESSION['cart'][$product_id] = 1; // Thêm mới nếu chưa có
            }
        }
        break;

    case 'remove':
        if ($product_id > 0 && isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm
        }
        break;

    case 'update':
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
        if ($product_id > 0 && isset($_SESSION['cart'][$product_id])) {
            if ($quantity > 0) {
                $_SESSION['cart'][$product_id] = $quantity; // Cập nhật số lượng mới
            } else {
                unset($_SESSION['cart'][$product_id]); // Nếu số lượng là 0 thì xóa
            }
        }
        break;
}

// Sau khi xử lý, trả về thông tin giỏ hàng dưới dạng JSON
// để JavaScript có thể cập nhật giao diện
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'cartCount' => count($_SESSION['cart']) // Trả về số lượng loại sản phẩm trong giỏ
]);
exit();
?>
