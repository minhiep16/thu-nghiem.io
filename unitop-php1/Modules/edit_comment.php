<?php
// edit_comment.php

$servername = "localhost"; $username = "root"; $password = ""; $dbname = "datlich";
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$comment_id = $_GET['id'] ?? 0;
$message = '';
$comment_data = null;

// Xử lý khi người dùng nhấn nút "Cập nhật"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $rating = trim($_POST['rating']);
    $comment_text = trim($_POST['comment']);

    $sql = "UPDATE reviews SET name = ?, rating = ?, comment = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $name, $rating, $comment_text, $id);

    if ($stmt->execute()) {
        // Chuyển hướng về trang quản lý với thông báo thành công
        header("Location: quan-li-comment.php?message=Cập nhật bình luận thành công!");
        exit();
    } else {
        $message = "Lỗi: Không thể cập nhật bình luận.";
    }
    $stmt->close();
}

// Lấy dữ liệu bình luận hiện tại để điền vào form
if ($comment_id > 0) {
    $sql = "SELECT id, name, rating, comment FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $comment_data = $result->fetch_assoc();
    } else {
        die("Không tìm thấy bình luận.");
    }
    $stmt->close();
} else {
    die("ID không hợp lệ.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Bình luận</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input[type="text"], input[type="number"], textarea {
            width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;
        }
        textarea { height: 120px; }
        .submit-btn {
            background-color: #28a745; color: white; padding: 12px 20px; border: none;
            border-radius: 4px; cursor: pointer; font-size: 16px;
        }
        .submit-btn:hover { background-color: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chỉnh sửa Bình luận</h1>
        <?php if ($message): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if ($comment_data): ?>
            <form action="edit_comment.php?id=<?php echo $comment_data['id']; ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $comment_data['id']; ?>">
                <div class="form-group">
                    <label for="name">Tên Khách hàng:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($comment_data['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="rating">Đánh giá (1-5):</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" value="<?php echo $comment_data['rating']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="comment">Nội dung:</label>
                    <textarea id="comment" name="comment"><?php echo htmlspecialchars($comment_data['comment']); ?></textarea>
                </div>
                <button type="submit" class="submit-btn">Cập nhật</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>