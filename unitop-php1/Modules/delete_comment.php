<?php
// delete_comment.php

$servername = "localhost"; $username = "root"; $password = ""; $dbname = "datlich";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy ID từ URL
$comment_id = $_GET['id'] ?? 0;

if ($comment_id > 0) {
    $sql = "DELETE FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);

    if ($stmt->execute()) {
        // Nếu xóa thành công, chuyển hướng về trang quản lý với thông báo
        header("Location: quan-li-comment.php?message=Đã xóa bình luận thành công!");
        exit();
    } else {
        die("Lỗi: Không thể xóa bình luận.");
    }
    $stmt->close();
} else {
    die("ID không hợp lệ.");
}

$conn->close();
?>