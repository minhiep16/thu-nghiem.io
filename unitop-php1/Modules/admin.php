
<?php
// --- Cấu hình kết nối Database (giống hệt file process-form.php) ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datlich";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Đặt charset thành utf8 để hiển thị tiếng Việt chính xác
$conn->set_charset("utf8");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Câu lệnh SQL để lấy tất cả dữ liệu từ bảng appointments, sắp xếp theo ngày tạo mới nhất
$sql = "SELECT id, title, name, phone, email, services, brand, schedule, message, created_at FROM appointments ORDER BY created_at DESC";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Danh Sách Lịch Hẹn</title>
    <link rel="stylesheet" href="../Assets/styles/admin.css"> <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
       <link rel="stylesheet" href="../Assets/styles/ds-lichhen.css"> 
</head>
<body>

    <div class="admin-container">
        <h1>Danh Sách Lịch Hẹn Đã Đặt</h1>
        <p>Tổng số lịch hẹn: <strong><?php echo $result->num_rows; ?></strong></p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ngày Đặt</th>
                    <th>Danh xưng</th>
                    <th>Họ Tên</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Dịch vụ</th>
                    <th>Hãng xe</th>
                    <th>Ngày hẹn</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Hiển thị dữ liệu của mỗi hàng
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                        // Định dạng lại ngày đặt cho dễ đọc
                        echo "<td>" . date("d/m/Y H:i", strtotime($row["created_at"])) . "</td>";
                        echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["services"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["brand"]) . "</td>";
                        // Định dạng lại ngày hẹn cho dễ đọc
                        echo "<td>" . ($row["schedule"] ? date("d/m/Y", strtotime($row["schedule"])) : 'Chưa có') . "</td>";
                        echo "<td class='message-cell'>" . nl2br(htmlspecialchars($row["message"])) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='no-data'>Chưa có lịch hẹn nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>