<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/Styles/Chassis.css">
    <title>Document</title>
</head>
<body>
    <div class="hero-section">
        <img src="Assets/Images/Chassis.webp" alt="A red sports car on a winding road with a mountain in the background" class="hero-image">
        <div class="overlay"></div>
        <div class="content">
            <p class="subtitle">DỊCH VỤ</p>
            <h1 class="title">KHUNG GẦM</h1>
        </div>
    </div>

    <?php
    // Chi tiết kết nối cơ sở dữ liệu
    $servername = "localhost";
    $username = "root"; // Thay thế bằng tên người dùng cơ sở dữ liệu của bạn
    $password = ""; // Thay thế bằng mật khẩu cơ sở dữ liệu của bạn
    $dbname = "datlich"; // Thay thế bằng tên cơ sở dữ liệu của bạn

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hàm để lấy các mục theo loại (Phụ kiện hoặc Dịch vụ)
    function getChassisItems($conn, $itemType) {
        $sql = "SELECT image_path, name, price FROM chassis WHERE item_type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $itemType);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    }

    // Lấy Phụ kiện
    $accessories = getChassisItems($conn, 'Accessory');
    // Lấy Dịch vụ
    $services = getChassisItems($conn, 'Service');
    ?>

    <div class="content1">
        <h1>PHỤ KIỆN KHUNG GẦM</h1>
        <div class="Dichvunoibat">
            <?php foreach ($accessories as $item): ?>
                <div class="Dichvunoibat1">
                    <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                    <p>Giá: <?php echo number_format($item['price'], 2); ?> VNĐ</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div> 
    
    <div class="content1">
        <h1>SỬA CHỮA KHUNG GẦM</h1>
        <div class="Dichvunoibat">
            <?php foreach ($services as $item): ?>
                <div class="Dichvunoibat1">
                    <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                    <p>Giá: <?php echo number_format($item['price'], 2); ?> VNĐ</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php
    $conn->close();
    ?>
    <script src="../Layouts/Chassis.js"></script>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/Styles/Chassis.css">
    <title>Document</title>
</head>
<body>
    <div class="hero-section">
        <img src="Assets/Images/Chassis.webp" alt="A red sports car on a winding road with a mountain in the background" class="hero-image">
        <div class="overlay"></div>
        <div class="content">
            <p class="subtitle">DỊCH VỤ</p>
            <h1 class="title">KHUNG GẦM</h1>
        </div>
    </div>
    <div class="content1">
        <h1>PHỤ KIỆN KHUNG GẦM</h1>
            <div class="Dichvunoibat">
                <div class="Dichvunoibat1">
                    <img src="Assets/Images/PPF1.webp" alt="">
                    <h2>Phuộc Ohlin</h2>
                    <p>Giá:</p>
                </div>
            </div>
    </div> 
    <div class="content1">
        <h1>DỊCH VỤ KHUNG GẦM</h1>
            <div class="Dichvunoibat">
                <div class="Dichvunoibat1">
                    <img src="Assets/Images/PPF1.webp" alt="">
                    <h2>Gầm Fox</h2>
                    <p>Giá:</p>
                </div>
            </div>
    </div>

</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/Styles/Chassis.css">
    <title>Quản Lý Khung Gầm</title> </head>
<body>
    <div class="hero-section">
        <img src="Assets/Images/Chassis.webp" alt="A red sports car on a winding road with a mountain in the background" class="hero-image">
        <div class="overlay"></div>
        <div class="content">
            <p class="subtitle">DỊCH VỤ</p>
            <h1 class="title">KHUNG GẦM</h1>
        </div>
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "datlich";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hàm để lấy TẤT CẢ các mục từ bảng chassis
    function getAllChassisItems($conn) {
        $sql = "SELECT image_url, name, price FROM chassis ORDER BY name ASC"; // Sắp xếp theo tên cho dễ nhìn
        
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Lỗi prepare SQL: ' . htmlspecialchars($conn->error) . ' | Câu lệnh SQL: ' . $sql);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    }

    // Lấy tất cả các mục khung gầm
    $chassisItems = getAllChassisItems($conn);
    ?>

    <div class="content1">
        <h1>PHỤ KIỆN</h1> <div class="Dichvunoibat">
            <?php 
            if (!empty($chassisItems)):
                foreach ($chassisItems as $item): ?>
                    <div class="Dichvunoibat1">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                        <p>Giá: <?php echo number_format($item['price'], 2); ?> VNĐ</p>
                    </div>
                <?php endforeach; 
            else: ?>
                <p>Không có dữ liệu khung gầm nào để hiển thị.</p>
            <?php endif; ?>
        </div>
    </div> 
    
    <?php
    $conn->close();
    ?>
    <script src="Layouts/Chassis.js"></script>
</body>
</html>

chassis 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/Styles/Chassis.css">
    <title>Quản Lý Khung Gầm</title> </head>
<body>
    <div class="hero-section">
        <img src="Assets/Images/Chassis.webp" alt="A red sports car on a winding road with a mountain in the background" class="hero-image">
        <div class="overlay"></div>
        <div class="content">
            <p class="subtitle">DỊCH VỤ</p>
            <h1 class="title">KHUNG GẦM</h1>
        </div>
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "datlich";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hàm để lấy TẤT CẢ các mục từ bảng chassis
    function getAllChassisItems($conn) {
        $sql = "SELECT image_url, name, price FROM chassis ORDER BY name ASC"; // Sắp xếp theo tên cho dễ nhìn
        
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Lỗi prepare SQL: ' . htmlspecialchars($conn->error) . ' | Câu lệnh SQL: ' . $sql);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    }

    // Lấy tất cả các mục khung gầm
    $chassisItems = getAllChassisItems($conn);
    ?>

    <div class="content1">
        <h1>PHỤ KIỆN</h1> <div class="Dichvunoibat">
            <?php 
            if (!empty($chassisItems)):
                foreach ($chassisItems as $item): ?>
                    <div class="Dichvunoibat1">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <h2><?php echo htmlspecialchars($item['name']); ?></h2>
                        <p>Giá: <?php echo number_format($item['price'], 2); ?> VNĐ</p>
                    </div>
                <?php endforeach; 
            else: ?>
                <p>Không có dữ liệu khung gầm nào để hiển thị.</p>
            <?php endif; ?>
        </div>
    </div> 
    
    <?php
    $conn->close();
    ?>
    <script src="Layouts/Chassis.js"></script>
</body>
</html>

add
<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "datlich";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Xử lý Thêm/Sửa Khung xe ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_chassis'])) {
        // Xử lý thêm khung xe mới
        $image_url = $_POST['image_url'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        $sql = "INSERT INTO chassis (image_url, name, price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $image_url, $name, $price);
        
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Lỗi khi thêm khung xe: " . $stmt->error;
        }
        $stmt->close();

    } elseif (isset($_POST['edit_chassis'])) {
        // Xử lý chỉnh sửa khung xe
        $id = $_POST['id'];
        $image_url = $_POST['image_url'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        $sql = "UPDATE chassis SET image_url = ?, name = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $image_url, $name, $price, $id);
        
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật khung xe: " . $stmt->error;
        }
        $stmt->close();
    }
}

// --- Xử lý Xóa Khung xe ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM chassis WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi khi xóa khung xe: " . $stmt->error;
    }
    $stmt->close();
}

// --- Lấy danh sách khung xe để hiển thị ---
$chassisItems = []; 
$sql = "SELECT id, image_url, name, price FROM chassis ORDER BY id DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chassisItems[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Assets/Styles/Addchassis.css">
</head>
<body>
    <div class="container">
        <h1>Danh Sách Phụ Kiện</h1>

        <div class="form-section">
            <?php
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
            <h2><?php echo $edit_mode ? 'Chỉnh Sửa' : 'Thêm Khung'; ?></h2>
            <form action="index.php" method="POST">
                <?php if ($edit_mode): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_chassis['id']); ?>">
                <?php endif; ?>
                
                <label for="image_url">Đường dẫn hình ảnh:</label>
                <input type="text" id="image_url" name="image_url" 
                       value="<?php echo $edit_chassis ? htmlspecialchars($edit_chassis['image_url']) : ''; ?>" 
                       placeholder="" required>

                <label for="name">Tên:</label>
                <input type="text" id="name" name="name" 
                       value="<?php echo $edit_chassis ? htmlspecialchars($edit_chassis['name']) : ''; ?>" 
                       placeholder="Nhập tên" required>

                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" step="0.01" 
                       value="<?php echo $edit_chassis ? htmlspecialchars($edit_chassis['price']) : ''; ?>" 
                       placeholder="Nhập giá" required>

                <button type="submit" name="<?php echo $edit_mode ? 'edit_chassis' : 'add_chassis'; ?>">
                    <?php echo $edit_mode ? 'Cập Nhật ' : 'Thêm '; ?>
                </button>
                <?php if ($edit_mode): ?>
                    <a href="index.php" class="cancel-button">Hủy</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="product-list">
            <?php if (!empty($chassisItems)): ?>
                <?php foreach ($chassisItems as $item): ?>
                    <div class="product-item">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="price">$<?php echo number_format($item['price'], 2, '.', ','); ?></p>
                        <div class="actions">
                            <a href="index.php?edit=<?php echo $item['id']; ?>" class="edit-btn">Sửa</a>
                            <a href="index.php?delete=<?php echo $item['id']; ?>" class="delete-btn" onclick="return confirmDelete();">Xóa</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có phụ kiện nào trong cơ sở dữ liệu.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="Layouts/Addchassis.js"></script>
</body>
</html>
css
body {
    max-width: 1620px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #1a1a1a;
    color: #b0b0b0;
    margin: 0 auto;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    line-height: 1.6;
}

.container {
    background-color: #282828;
    padding: 35px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.6);
    width: 95%;
    max-width: 1200px;
    text-align: center;
    border: 1px solid #3a3a3a;
}

h1, h2 {
    color: #FFDA44;
    margin-bottom: 25px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

.form-section {
    background-color: #363636;
    padding: 25px;
    border-radius: 8px;
    margin-bottom: 40px;
    text-align: left;
    border: 1px solid #4a4a4a;
}

.form-section label {
    display: block;
    margin-bottom: 10px;
    color: #e0e0e0;
    font-weight: bold;
}

.form-section input[type="text"],
.form-section input[type="number"] {
    width: calc(100% - 24px);
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #666;
    border-radius: 5px;
    background-color: #444;
    color: #f0f0f0;
    font-size: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-section input[type="text"]:focus,
.form-section input[type="number"]:focus {
    border-color: #FFDA44;
    box-shadow: 0 0 8px rgba(255, 218, 68, 0.4);
    outline: none;
}

/* --- CSS MỚI CHO INPUT FILE --- */
.form-section input[type="file"] {
    width: 100%;
    padding: 10px 0;
    margin-bottom: 20px;
    background-color: #444;
    border: 1px solid #666;
    border-radius: 5px;
    color: #f0f0f0;
    font-size: 0.95rem;
    box-sizing: border-box;
}

.form-section input[type="file"]::file-selector-button {
    background-color: #FFDA44;
    color: #1a1a1a;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    margin-right: 15px;
    transition: background-color 0.3s ease;
}

.form-section input[type="file"]::file-selector-button:hover {
    background-color: #e0b824;
}
/* --- KẾT THÚC CSS MỚI --- */

.current-image-preview {
    margin-bottom: 15px;
    background-color: #444;
    padding: 10px;
    border-radius: 5px;
}
.current-image-preview p {
    margin: 0 0 10px 0;
    color: #e0e0e0;
}
.current-image-preview img {
    max-width: 150px;
    height: auto;
    border-radius: 6px;
    border: 1px solid #555;
}


.form-section button {
    background-color: #FFDA44;
    color: #1a1a1a;
    font-weight: bold;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    margin-right: 15px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.form-section button:hover {
    background-color: #e0b824;
    transform: translateY(-2px);
}

.cancel-button {
    background-color: #6c757d;
    color: white;
    padding: 12px 25px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1rem;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.cancel-button:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
}

.product-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    padding-top: 10px;
}

.product-item {
    background-color: #363636;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #4a4a4a;
}

.product-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.7);
}

.product-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 15px;
    border: 1px solid #555;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}

.product-item h3 {
    color: #FFDA44;
    margin-bottom: 10px;
    font-size: 1.3rem;
    font-weight: 500;
    word-wrap: break-word;
}

.product-item .price {
    color: #FFDA44;
    font-weight: bold;
    font-size: 1.4rem;
    margin-bottom: 20px;
    padding: 5px 10px;
    background-color: #4a4a4a;
    border-radius: 5px;
    display: inline-block;
}

.actions {
    margin-top: auto;
    width: 100%;
}

.actions a {
    display: inline-block;
    padding: 10px 15px;
    margin: 0 8px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-size: 0.95rem;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.edit-btn {
    background-color: #2196F3;
}

.edit-btn:hover {
    background-color: #0b7dda;
    transform: translateY(-2px);
}

.delete-btn {
    background-color: #f44336;
}

.delete-btn:hover {
    background-color: #da190b;
    transform: translateY(-2px);
}

p {
    color: #a0a0a0;
}
 add new
 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nhom4";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. SỬA ĐƯỜNG DẪN: Phải đi ngược ra một cấp (../) để tìm thư mục Assets
define('UPLOAD_DIR', '../Assets/Uploads/');

// --- Xử lý Thêm/Sửa Khung xe ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $new_image_path = '';

    // --- Xử lý tải tệp lên ---
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Tạo thư mục nếu nó không tồn tại
        if (!is_dir(UPLOAD_DIR)) {
            mkdir(UPLOAD_DIR, 0777, true);
        }

        $tmp_name = $_FILES['image']['tmp_name'];
        // Tạo tên tệp duy nhất để tránh ghi đè
        $image_name = uniqid() . '-' . basename($_FILES['image']['name']);
        $target_file = UPLOAD_DIR . $image_name;

        if (move_uploaded_file($tmp_name, $target_file)) {
            $new_image_path = $target_file;
        } else {
            echo "Lỗi khi tải lên hình ảnh.";
        }
    }

    // --- Xử lý Thêm ---
    if (isset($_POST['add_chassis'])) {
        if (!empty($new_image_path)) {
            $sql = "INSERT INTO chassis (image_url, name, price) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssd", $new_image_path, $name, $price);

            if ($stmt->execute()) {
                header("Location: Addchassis.php");
                exit();
            } else {
                echo "Lỗi khi thêm khung xe: " . $stmt->error;
            }
            $stmt->close();
        } else {
             echo "Lỗi: Vui lòng chọn một hình ảnh để tải lên.";
        }
    }
    // --- Xử lý Sửa ---
    elseif (isset($_POST['edit_chassis'])) {
        $id = $_POST['id'];
        $current_image_url = $_POST['current_image_url'];

        // Nếu một hình ảnh mới đã được tải lên, sử dụng đường dẫn mới. Nếu không, giữ lại đường dẫn cũ.
        $final_image_path = !empty($new_image_path) ? $new_image_path : $current_image_url;

        $sql = "UPDATE chassis SET image_url = ?, name = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $final_image_path, $name, $price, $id);

        if ($stmt->execute()) {
            if (!empty($new_image_path) && $new_image_path !== $current_image_url && file_exists($current_image_url)) {
                unlink($current_image_url);
            }
            header("Location: Addchassis.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật khung xe: " . $stmt->error;
        }
        $stmt->close();
    }
}

// --- Xử lý Xóa Khung xe ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_select = "SELECT image_url FROM chassis WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();
    if ($row = $result_select->fetch_assoc()) {
        $image_to_delete = $row['image_url'];
        if (file_exists($image_to_delete)) {
            unlink($image_to_delete);
        }
    }
    $stmt_select->close();

    $sql_delete = "DELETE FROM chassis WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);

    if ($stmt_delete->execute()) {
        header("Location: Addchassis.php");
        exit();
    } else {
        echo "Lỗi khi xóa khung xe: " . $stmt_delete->error;
    }
    $stmt_delete->close();
}

// --- Lấy danh sách khung xe để hiển thị ---
$chassisItems = [];
$sql = "SELECT id, image_url, name, price FROM chassis ORDER BY id DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chassisItems[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khung Xe</title>
    <link rel="stylesheet" href="Assets/Styles/Addchassis.css">
</head>
<body>
    <div class="container">
        <h1>Danh Sách Khung Xe</h1>

        <div class="form-section">
            <?php
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
            <h2><?php echo $edit_mode ? 'Chỉnh Sửa Khung Xe' : 'Thêm Khung Xe Mới'; ?></h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <?php if ($edit_mode): ?>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_chassis['id']); ?>">
                    <input type="hidden" name="current_image_url" value="<?php echo htmlspecialchars($edit_chassis['image_url']); ?>">
                <?php endif; ?>

                <label for="image">Hình ảnh:</label>
                <?php if ($edit_mode && !empty($edit_chassis['image_url'])): ?>
                    <div class="current-image-preview">
                        <p>Hình ảnh hiện tại:</p>
                        <img src="<?php echo htmlspecialchars($edit_chassis['image_url']); ?>" alt="Current Image">
                        <p>Tải lên ảnh mới để thay thế (để trống nếu không đổi):</p>
                    </div>
                <?php endif; ?>
                <input type="file" id="image" name="image" accept="image/*" <?php echo !$edit_mode ? 'required' : ''; ?>>

                <label for="name">Tên:</label>
                <input type="text" id="name" name="name"
                       value="<?php echo $edit_chassis ? htmlspecialchars($edit_chassis['name']) : ''; ?>"
                       placeholder="Nhập tên" required>

                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" step="0.01"
                       value="<?php echo $edit_chassis ? htmlspecialchars($edit_chassis['price']) : ''; ?>"
                       placeholder="Nhập giá" required>

                <button type="submit" name="<?php echo $edit_mode ? 'edit_chassis' : 'add_chassis'; ?>">
                    <?php echo $edit_mode ? 'Cập Nhật' : 'Thêm'; ?>
                </button>
                <?php if ($edit_mode): ?>
                    <a href="Addchassis.php" class="cancel-button">Hủy</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="product-list">
            <?php if (!empty($chassisItems)): ?>
                <?php foreach ($chassisItems as $item): ?>
                    <div class="product-item">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p class="price">$<?php echo number_format($item['price'], 2, '.', ','); ?></p>
                        <div class="actions">
                            <a href="Addchassis.php?edit=<?php echo $item['id']; ?>" class="edit-btn">Sửa</a>
                            <a href="Addchassis.php?delete=<?php echo $item['id']; ?>" class="delete-btn" onclick="return confirmDelete();">Xóa</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có khung xe nào trong cơ sở dữ liệu.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="Layouts/Addchassis.js"></script>
</body>
</html>



<?php
// Home.php (Đã cập nhật)
require "../Components/navbar.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - WrapStyle</title>
    <link rel="stylesheet" href="../Assets/styles/Home.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
        <section class="hero-section">
        <video autoplay muted loop id="background-video">
            <source src="../Assets/img/Home.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="overlay"></div>
        <div class="hero-content" data-aos="fade-in" data-aos-duration="1500">
            <h1>CAR TUNING</h1>
            <p class="subtitle">DESIGN | WRAPPING & PAINTING | BODY KIT | INTERIOR</p>
            <p class="description">
                Một ý tưởng "đột phá" sẽ giúp xe của bạn nổi bật giữa hàng ngàn chiếc khác. Từ dáng vẻ, hiệu suất đến từng chi tiết nhỏ đều có thể là điểm nhấn nổi bật của riêng bạn.
            </p>
        </div>
    </section>
    <section class="slider">
        <div class="slideritems">
            <div class="slideritem"><img src="../Assets/img/Banner5.webp" alt="Banner 5"></div>
            <div class="slideritem"><img src="../Assets/img/Banner1.jpg" alt="Banner 1"></div>
            <div class="slideritem"><img src="../Assets/img/Banner2.jpg" alt="Banner 2"></div>
            <div class="slideritem"><img src="../Assets/img/Banner3.webp" alt="Banner 3"></div>
            <div class="slideritem"><img src="../Assets/img/Banner4.jpg" alt="Banner 4"></div>
        </div>
    </section>

    <div class="container page-container">
        <section class="featured-services">
            <h1 data-aos="fade-up">DỊCH VỤ NỔI BẬT</h1>
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <img src="../Assets/img/PPF1.webp" alt="Dán PPF">
                    <h2>DÁN PPF</h2>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <img src="../Assets/img/Wrap1.webp" alt="Wrap đổi màu">
                    <h2>WRAP ĐỔI MÀU</h2>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <img src="../Assets/img/Wash1.png" alt="Rửa xe detailing">
                    <h2>RỬA XE DETAILING</h2>
                </div>
            </div>
        </section>

        <section class="about-us-title" data-aos="fade-up">
            VỀ CHÚNG TÔI
        </section>

        <section class="about-us-content">
            <div class="about-text" data-aos="fade-right">
                <h2>NIỀM ĐAM MÊ BẤT TẬN</h2>
                <p>
                    Tại đây, chúng tôi không chỉ coi xe hơi là một phương tiện, mà đó còn là một tài sản và niềm đam mê. Được thành lập bởi đội ngũ chuyên gia giàu kinh nghiệm, chúng tôi ra đời với sứ mệnh mang đến những giải pháp chăm sóc và nâng cấp xe toàn diện, chuyên nghiệp và đáng tin cậy nhất cho khách hàng.
                </p>
                <a href="vechungtoi.php" class="btn-more">TÌM HIỂU THÊM</a>
            </div>
            <div class="about-image" data-aos="fade-left">
                 <img src="../Assets/img/Vechungtoi.webp" alt="Về chúng tôi">
            </div>
        </section>

        <section class="hero-section">
        <video autoplay muted loop id="background-video">
            <source src="../Assets/img/Home.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="overlay"></div>
        <div class="hero-content" data-aos="fade-in" data-aos-duration="1500">
            <h1>CAR TUNING</h1>
            <p class="subtitle">DESIGN | WRAPPING & PAINTING | BODY KIT | INTERIOR</p>
            <p class="description">
                Một ý tưởng "đột phá" sẽ giúp xe của bạn nổi bật giữa hàng ngàn chiếc khác. Từ dáng vẻ, hiệu suất đến từng chi tiết nhỏ đều có thể là điểm nhấn nổi bật của riêng bạn.
            </p>
        </div>
    </section>
    </div>
    <?php require "../Components/footer.php"; ?>
    <script src="../Layouts/Home.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 1000, 
        once: true, // Hiệu ứng chỉ chạy 1 lần
      });
    </script>
</body>
</html>





/* Home.css (Đã tân trang) */

/* --- CÀI ĐẶT CHUNG & BIẾN MÀU --- */
:root {
    --primary-color: #ffffff; 
    --secondary-color: #cccccc; 
    --accent-color: #fbc833;
    --dark-bg: #1a1a1a; 
    --text-dark: #201c1c;
    --text-light: #c6c6c6;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
    max-width: 1920px; /* Hỗ trợ màn hình rộng hơn */
    margin: 0 auto;
    font-family: 'Roboto', sans-serif, Arial;
    line-height: 1.6;
    overflow-x: hidden;
    background-color: #fff;
    animation: fadeInAnimation ease 1s;
    animation-iteration-count: 1;
    animation-fill-mode: forwards;
}

@keyframes fadeInAnimation {
  from { opacity: 0; }
  to { opacity: 1; }
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.page-container {
    padding-top: 60px;
    padding-bottom: 60px;
}


/* --- HERO VIDEO SECTION --- */
.hero-section {
    position: relative;
    width: 100%;
    height: 90vh; /* Chiều cao chiếm 90% màn hình */
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: var(--primary-color);
}

#background-video {
    position: absolute;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -2; 
    transform: translate(-50%, -50%);
    object-fit: cover; 
}

.hero-section .overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6); 
    z-index: -1;
}

.hero-content h1 {
    font-size: clamp(3rem, 10vw, 6rem); /* Font tự co giãn */
    font-weight: 700;
    margin-bottom: 15px;
    letter-spacing: 5px;
}
.hero-content .subtitle {
    font-size: clamp(1rem, 4vw, 1.5rem);
    font-weight: 300;
    margin-bottom: 30px;
    letter-spacing: 2px;
    color: var(--secondary-color);
}
.hero-content .description {
    font-size: 1.1em;
    margin: 0 auto 40px auto;
    line-height: 1.8;
    color: var(--secondary-color);
    max-width: 700px;
}


/* --- SLIDER SECTION --- */
.slider {
    position: relative;
    width: 100%;
    height: 600px; /* Tăng chiều cao slider */
    overflow: hidden;
}
.slideritems {
    position: relative;
    width: 100%;
    height: 100%;
}
.slideritem {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 1s ease-in-out;
    z-index: 0;
}
.slideritem img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Giữ tỷ lệ ảnh đẹp hơn */
}
.slideritem.active {
    opacity: 1;
    z-index: 1;
}


/* --- FEATURED SERVICES SECTION --- */
.featured-services h1 {
    text-align: center;
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 50px;
    color: var(--text-dark);
}
.services-grid {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap; /* SỬA: Tự động xuống hàng trên mobile */
}
.service-card {
    background: #201c1c;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    width: 320px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}
.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 16px 32px rgba(0,0,0,0.2);
}
.service-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}
.service-card h2 {
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    padding: 15px 10px;
    color: var(--text-light);
}


/* --- ABOUT US SECTION --- */
.about-us-title {
    font-size: 3em;
    margin-top: 100px;
    margin-bottom: 50px;
    padding: 20px;
    text-align: center;
    color: var(--primary-color);
    background-color: var(--dark-bg);
}
.about-us-content {
    display: grid; /* SỬA: Dùng grid cho layout linh hoạt */
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    align-items: center;
    margin-top: 50px;
}
.about-text {
    text-align: justify;
}
.about-text h2 {
    font-size: 3em;
    margin-top: 10px;
    margin-bottom: 20px;
}
.about-text p {
    font-size: 1.2em;
    color: var(--text-dark);
    line-height: 1.8;
    margin-bottom: 30px;
}
.about-image img {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
.btn-more {
    display: inline-block;
    background-color: var(--dark-bg);
    color: var(--primary-color);
    padding: 12px 30px;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
.btn-more:hover {
    background-color: #000;
}

/* --- MEDIA QUERIES FOR RESPONSIVE --- */
@media (max-width: 992px) {
    .about-us-content {
        grid-template-columns: 1fr; /* Chuyển thành 1 cột trên tablet */
    }
    .about-text {
        text-align: center;
    }
}
@media (max-width: 768px) {
    .services-grid {
        gap: 20px;
    }
    .hero-section {
        height: 70vh;
    }
}