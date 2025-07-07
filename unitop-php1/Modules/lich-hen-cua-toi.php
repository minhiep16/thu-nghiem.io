<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../login.php');
    exit();
}

$userId = $_SESSION['id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datlich";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Lỗi kết nối CSDL: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$sql = "SELECT id, services, appointment_datetime, status FROM appointments WHERE user_id = ? ORDER BY appointment_datetime DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$appData = [
    'isLoggedIn' => isset($_SESSION['id']),
    'userName'   => isset($_SESSION['id']) ? ($_SESSION['name'] ?? 'Người dùng') : '',
    'userEmail'  => isset($_SESSION['id']) ? ($_SESSION['email'] ?? '') : ''
];

require "../Components/navbar.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Hẹn Của Tôi</title>
    <link rel="stylesheet" href="../Assets/styles/user-style.css"> </head>
<body class='lichhen'>
    <div class="containerl">
        <h1>Lịch Hẹn Của Tôi</h1>
        <p>Xin chào, <strong><?php echo htmlspecialchars($_SESSION['name'] ?? 'Bạn'); ?></strong>. Dưới đây là danh sách các lịch hẹn của bạn.</p>
        
        <div class="table-responsive">
            <table id="my-appointments-table">
                <thead>
                    <tr>
                        <th>Dịch vụ</th>
                        <th>Ngày giờ hẹn</th>
                        <th>Trạng thái</th>
                        <th class="actions-header">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr data-id="<?php echo $row['id']; ?>">
                                <td><?php echo htmlspecialchars($row['services']); ?></td>
                                <td class="appointment-time"><?php echo date('d/m/Y H:i', strtotime($row['appointment_datetime'])); ?></td>
                                <td>
                                    <span class="status status-<?php echo str_replace(' ', '-', $row['status']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($row['status'])); ?>
                                    </span>
                                </td>
                                <td class="actions">
                                    <?php if ($row['status'] == 'chờ xác nhận'): ?>
                                        <button class="btn btn-edit" data-action="edit">Sửa</button>
                                        <button class="btn btn-danger" data-action="cancel">Hủy</button>
                                    <?php else: ?>
                                        <span>Không thể thao tác</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px;">Bạn chưa có lịch hẹn nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Chỉnh sửa Lịch hẹn</h2>
            <form id="edit-form">
                <input type="hidden" id="edit-id" name="id">
                <div class="form-group">
                    <label for="edit-date">Ngày hẹn mới:</label>
                    <input type="date" id="edit-date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="edit-time">Giờ hẹn mới:</label>
                    <input type="time" id="edit-time" name="time" required>
                </div>
                 <div class="form-group">
                    <label for="edit-services">Dịch vụ:</label>
                    <input type="text" id="edit-services" name="services">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../Layouts/lich-hen-cua-toi.js"></script>
</body>
</html>
<?php $stmt->close(); $conn->close(); ?>