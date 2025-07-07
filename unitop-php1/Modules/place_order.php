<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datlich";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Phương thức không hợp lệ.']);
    exit;
}

if (empty($_SESSION['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Giỏ hàng của bạn đang trống.']);
    exit;
}

if (empty($_POST['customer_name']) || empty($_POST['customer_phone']) || empty($_POST['customer_address'])) {
    echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin giao hàng.']);
    exit;
}

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Lỗi kết nối cơ sở dữ liệu.']);
    exit;
}

$conn->begin_transaction();

try {
    $product_ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    
    $sql_products = "SELECT id, price FROM chassis WHERE id IN ($placeholders)";
    $stmt_products = $conn->prepare($sql_products);
    $types = str_repeat('i', count($product_ids));
    $stmt_products->bind_param($types, ...$product_ids);
    $stmt_products->execute();
    $result = $stmt_products->get_result();

    $subtotal = 0;
    $products_from_db = [];
    while ($row = $result->fetch_assoc()) {
        $quantity = $_SESSION['cart'][$row['id']];
        $subtotal += $row['price'] * $quantity;
        $products_from_db[$row['id']] = $row['price'];
    }
    
    if (count($products_from_db) !== count($product_ids)) {
        throw new Exception("Có sản phẩm không hợp lệ trong giỏ hàng.");
    }

    $shipping = $subtotal > 0 ? 20000 : 0;
    $total_amount = $subtotal + $shipping;

    $sql_order = "INSERT INTO orders (customer_name, customer_phone, customer_address, customer_note, total_amount, status) VALUES (?, ?, ?, ?, ?, 'pending')";
    $stmt_order = $conn->prepare($sql_order);
    $customer_note = $_POST['customer_note'] ?? '';
    $stmt_order->bind_param("ssssd", $_POST['customer_name'], $_POST['customer_phone'], $_POST['customer_address'], $customer_note, $total_amount);
    $stmt_order->execute();

    $order_id = $conn->insert_id;

    $sql_details = "INSERT INTO order_details (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)";
    $stmt_details = $conn->prepare($sql_details);

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $price_at_purchase = $products_from_db[$product_id];
        $stmt_details->bind_param("iiid", $order_id, $product_id, $quantity, $price_at_purchase);
        $stmt_details->execute();
    }
    
    $conn->commit();
    unset($_SESSION['cart']);

    echo json_encode(['success' => true, 'message' => 'Đặt hàng thành công!']);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Đã xảy ra lỗi khi đặt hàng: ' . $e->getMessage()]);
}

$conn->close();
?>