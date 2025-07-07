<?php
// admin/quan-ly-lich.php (ĐÃ ĐƠN GIẢN HÓA)
session_start();
if (!isset($_SESSION['id'])) { // Thêm kiểm tra quyền admin ở đây nếu có
    header('Location: ../login.php');
    exit();
}

$conn = new mysqli("localhost", "root", "", "datlich");
$conn->set_charset("utf8mb4");
$sql = "SELECT id, name, phone, email, services, appointment_datetime, status FROM appointments ORDER BY appointment_datetime DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Lịch Hẹn - Admin</title>
    <link rel="stylesheet" href="../Assets/styles/quan-ly-lich.css">
</head>
<body>
    <div class="container">
        <a href="./admin_dashboard.php">Back</a>
        <h1>Bảng điều khiển Lịch hẹn (Admin)</h1>
        <div class="table-responsive">
            <table id="appointments-table">
                <thead>
                    <tr>
                        <th>Khách hàng</th>
                        <th>Ngày giờ hẹn</th>
                        <th>Trạng thái</th>
                        <th class="actions-header">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr data-id="<?php echo $row['id']; ?>">
                                <td class="customer-details">
                                    <p class="customer-name"><?php echo htmlspecialchars($row['name']); ?></p>
                                    <p class="customer-contact"><?php echo htmlspecialchars($row['phone']); ?></p>
                                    <p class="customer-services"><strong>Dịch vụ:</strong> <?php echo htmlspecialchars($row['services']); ?></p>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($row['appointment_datetime'])); ?></td>
                                <td>
                                    <span class="status status-<?php echo str_replace(' ', '-', $row['status']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($row['status'])); ?>
                                    </span>
                                </td>
                                <td class="actions">
                                    <?php if ($row['status'] == 'chờ xác nhận'): ?>
                                        <button class="btn btn-success" data-action="confirm">Xác nhận</button>
                                    <?php else: ?>
                                        <span>Đã xử lý</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../Layouts/quan-ly-lich.js"></script>
</body>
</html>
<?php $conn->close(); ?>