<?php
$entryFile = basename($_SERVER['SCRIPT_FILENAME']);

if (!isset($conn)) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "datlich";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

// Lấy tất cả dữ liệu trước để đảm bảo các chức năng khác có dữ liệu để xử lý
$chassisItems = [];
$sql_select_all = "SELECT id, image_url, name, price FROM chassis ORDER BY id DESC";
$result = $conn->query($sql_select_all);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chassisItems[] = $row;
    }
}

// Đường dẫn đến thư mục upload
define('UPLOAD_DIR_RELATIVE', '../Assets/Uploads/');
define('UPLOAD_DIR_ABSOLUTE_URL', '/nhom4/../Assets/Uploads/');

//XỬ LÝ POST (Thêm / Sửa)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image_path_for_db = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        if (!is_dir(UPLOAD_DIR_RELATIVE)) {
            mkdir(UPLOAD_DIR_RELATIVE, 0777, true);
        }
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_name = uniqid() . '-' . basename($_FILES['image']['name']);
        
        $target_file_on_server = UPLOAD_DIR_RELATIVE . $image_name;
        $image_path_for_db = UPLOAD_DIR_ABSOLUTE_URL . $image_name;

        move_uploaded_file($tmp_name, $target_file_on_server);
    }

    // Xử lý Thêm
    if (isset($_POST['add_chassis']) && !empty($image_path_for_db)) {
        $sql = "INSERT INTO chassis (image_url, name, price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $image_path_for_db, $name, $price);
        if ($stmt->execute()) {
            header("Location: $entryFile");
            exit();
        }
    // Xử lý Sửa
    } elseif (isset($_POST['edit_chassis'])) {
        $id = $_POST['id'];
        $current_image_url = $_POST['current_image_url'];
        $final_image_path = !empty($image_path_for_db) ? $image_path_for_db : $current_image_url;

        $sql = "UPDATE chassis SET image_url = ?, name = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $final_image_path, $name, $price, $id);
        if ($stmt->execute()) {
             header("Location: $entryFile");
             exit();
        }
    }
}

//XỬ LÝ GET (Xóa)
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_delete = "DELETE FROM chassis WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);
    if ($stmt_delete->execute()) {
        header("Location: $entryFile");
        exit();
    }
}

//XỬ LÝ HIỂN THỊ FORM SỬA
$edit_chassis = null;
$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    foreach ($chassisItems as $item) {
        if ($item['id'] == $edit_id) {
            $edit_chassis = $item;
            $edit_mode = true;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khung Xe</title>
    <link rel="stylesheet" href="../Assets/Styles/Addchassis.css">
</head>
<body>
    <div class="container">
        <h1>Danh Sách Phụ Kiện</h1>

        <div class="form-section">
            <h2><?php echo $edit_mode ? 'Chỉnh Sửa' : 'Thêm'; ?></h2>
            <form action="<?php echo $entryFile; ?>" method="POST" enctype="multipart/form-data">
                <?php if ($edit_mode): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_chassis['id']); ?>">
                    <input type="hidden" name="current_image_url" value="<?php echo htmlspecialchars($edit_chassis['image_url']); ?>">
                <?php endif; ?>

                <label for="image">Hình ảnh:</label>
                <?php if ($edit_mode && !empty($edit_chassis['image_url'])): ?>
                    <div class="current-image-preview">
                        <p>Hình ảnh hiện tại:</p>
                        <img src="<?php echo htmlspecialchars($edit_chassis['image_url']); ?>" alt="Current Image">
                        <p>Tải lên ảnh mới để thay thế:</p>
                    </div>
                <?php endif; ?>
                <input type="file" id="image" name="image" accept="image/*" <?php echo !$edit_mode ? 'required' : ''; ?>>

                <label for="name">Tên:</label>
                <input type="text" id="name" name="name"
                       value="<?php echo $edit_chassis ? htmlspecialchars($edit_chassis['name']) : ''; ?>"
                       placeholder="Nhập tên" required>

                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" step="1"
                       value="<?php echo $edit_chassis ? htmlspecialchars($edit_chassis['price']) : ''; ?>"
                       placeholder="Nhập giá" required>

                <button type="submit" name="<?php echo $edit_mode ? 'edit_chassis' : 'add_chassis'; ?>">
                    <?php echo $edit_mode ? 'Cập Nhật' : 'Thêm'; ?>
                </button>
                <?php if ($edit_mode): ?>
                    <a href="<?php echo $entryFile; ?>" class="cancel-button">Hủy</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="product-list">
            <?php if (!empty($chassisItems)): ?>
                <?php foreach ($chassisItems as $item): ?>
                    <div class="product-item">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="price"><?php echo number_format($item['price'])," "; ?>Đ</p>
                        <div class="actions">
                            <a href="<?php echo $entryFile; ?>?edit=<?php echo $item['id']; ?>" class="edit-btn">Sửa</a>
                            <a href="<?php echo $entryFile; ?>?delete=<?php echo $item['id']; ?>" class="delete-btn" onclick="return confirmDelete();">Xóa</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có khung xe nào trong cơ sở dữ liệu.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="../Layouts/Addchassis.js"></script>
</body>
</html>