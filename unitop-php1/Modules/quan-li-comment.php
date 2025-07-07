<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "datlich";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, name, rating, comment, submission_date FROM reviews ORDER BY submission_date DESC";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Bình luận</title>

    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; }
        .container { max-width: 1400px; margin: auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; }
        th { background-color:#343a40; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        tr:hover { background-color: #e9ecef; }
        .actions a {
            text-decoration: none;
            padding: 6px 12px;
            margin: 0 4px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
        }
        .edit-btn { background-color: #ffc107; }
        .delete-btn { background-color: #dc3545; }
        .container a{
            text-decoration:none ;
            color: #343a40;
        }
    </style>
</head>
<body>

    <div class="container">
        <a href="./admin_dashboard.php">Back</a>
        <h1>Danh sách Bình luận của Khách hàng</h1>

        <?php if (isset($_GET['message'])): ?>
            <p style="color: green; text-align: center; font-weight: bold;"><?php echo htmlspecialchars($_GET['message']); ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khách hàng</th>
                    <th>Đánh giá (Sao)</th>
                    <th>Nội dung</th>
                    <th>Ngày gửi</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo htmlspecialchars($row["name"]); ?></td>
                            <td><?php echo $row["rating"]; ?></td>
                            <td><?php echo nl2br(htmlspecialchars($row["comment"])); ?></td>
                            <td><?php echo date("d/m/Y H:i", strtotime($row["submission_date"])); ?></td>
                            <td class="actions">
                                <a href="edit_comment.php?id=<?php echo $row['id']; ?>" class="edit-btn">Sửa</a>
                                <a href="delete_comment.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Chưa có bình luận nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
$conn->close();
?>
