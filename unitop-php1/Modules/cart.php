<?php
 if (session_status() == PHP_SESSION_NONE) { session_start(); }
 require "../Components/navbar.php"; 
 $servername = "localhost"; $username = "root"; $password = ""; $dbname = "datlich";
 $conn = new mysqli($servername, $username, $password, $dbname);
 $conn->set_charset("utf8mb4");
 if ($conn->connect_error) { die("Lỗi kết nối CSDL."); }
 
 $products_in_cart = [];
 $subtotal = 0;
 $shipping = 0;
 $total = 0;
 
 if (!empty($_SESSION['cart'])) {
     $product_ids = array_keys($_SESSION['cart']);
     $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
     
     $sql = "SELECT id, name, price, image_url FROM chassis WHERE id IN ($placeholders)";
     $stmt = $conn->prepare($sql);
     $types = str_repeat('i', count($product_ids));
     $stmt->bind_param($types, ...$product_ids);
     $stmt->execute();
     $result = $stmt->get_result();
 
     while ($product = $result->fetch_assoc()) {
         $quantity = $_SESSION['cart'][$product['id']];
         $products_in_cart[] = [
             'id' => $product['id'],
             'name' => $product['name'],
             'price' => $product['price'],
             'quantity' => $quantity,
             'image' => $product['image_url']
         ];
         $subtotal += $product['price'] * $quantity;
     }
     if ($subtotal > 0) $shipping = 20000; 
 }
 $total = $subtotal + $shipping;
 ?>
 <!DOCTYPE html>
 <html lang="vi">
 <head>
     <meta charset="UTF-8">
     <title>Giỏ hàng của bạn</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="../Assets/Styles/cart.css"> </head>
 <body>
     <div class="container">
         <header class="cart-header">
             <h1>Giỏ Hàng</h1>
         </header>
 
         <main class="cart-container">
             <div class="cart-items">
                <div id="cart-item-list">
                    <?php if (empty($products_in_cart)): ?>
                        <p class="empty-cart-message">Giỏ hàng của bạn đang trống.</p>
                    <?php else: ?>
                        <?php foreach ($products_in_cart as $product): ?>
                        <div class="cart-item" data-id="<?php echo $product['id']; ?>" data-price="<?php echo $product['price']; ?>">
                            <div class="cart-item-image">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>
                            <div class="cart-item-details">
                                <p class="cart-item-name"><?php echo htmlspecialchars($product['name']); ?></p>
                                <p class="cart-item-price-single"><?php echo number_format($product['price']); ?> VNĐ</p>
                            </div>
                            <div class="quantity-adjuster">
                                <button class="quantity-btn" data-action="decrease">-</button>
                                <input type="number" class="quantity-input" value="<?php echo $product['quantity']; ?>" min="1" data-id="<?php echo $product['id']; ?>">
                                <button class="quantity-btn" data-action="increase">+</button>
                            </div>
                            <div class="cart-item-total-price">
                               <?php echo number_format($product['price'] * $product['quantity']); ?> VNĐ
                            </div>
                            <button class="remove-btn" data-id="<?php echo $product['id']; ?>">&times;</button>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
             </div>
 
             <aside class="cart-summary">
                 <h2>Sản Phẩm</h2>
                 <div class="summary-row">
                     <span>Giá</span>
                     <span id="summary-subtotal"><?php echo number_format($subtotal); ?> VNĐ</span>
                 </div>
                 <div class="summary-row">
                     <span>Thuế</span>
                     <span id="summary-shipping"><?php echo number_format($shipping); ?> VNĐ</span>
                 </div>
                 <div class="summary-row total">
                     <span>TỔng tiền</span>
                     <span id="summary-total">VND <?php echo number_format($total); ?></span>
                 </div>
                 <button class="checkout-btn" id="checkout-btn">Thanh Toán</button>
             </aside>
         </main>
     </div>
 
     <div id="checkout-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="close-modal-btn">&times;</span>
            <h2>Quét mã để thanh toán</h2>
            <p>Sử dụng App ngân hàng hoặc Ví điện tử để thanh toán.</p>
            <img id="qr-code-image" src="https://api.vietqr.io/image/970436-0987654321-2P4E2n.jpg?accountName=TEN%20CHU%20KHOAN&amount=<?php echo $total; ?>&addInfo=DH<?php echo rand(1000,9999); ?>" alt="Mã QR Thanh toán">
            <p>Tổng tiền: <strong id="qr-total-amount"><?php echo number_format($total); ?> VNĐ</strong></p>
        </div>
     </div>
     
     <?php require "../Components/footer.php"; ?>
     <script src="../Layouts/cart.js"></script>
 </body>
 </html>