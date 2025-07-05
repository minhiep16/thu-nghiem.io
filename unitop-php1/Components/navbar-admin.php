<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Giữ nguyên logic PHP của bạn
$adminName = $_SESSION['name'] ?? 'Admin';
$newProjects = 278; $newClients = 156; $conversionRate = 64.89; $supportTickets = 423;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../Assets/styles/admin_style.css">
</head>
<body>

<div class="d-flex" id="wrapper">
    <aside id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-uppercase">
            <i class="fas fa-crown me-2"></i>Rooast
        </div>
        <div class="list-group list-group-flush my-3">
            <a href="#" class="list-group-item list-group-item-action active"><i class="fas fa-tachometer-alt"></i>Trang tổng quan</a>
            <a href="../Modules/admin.php" class="list-group-item list-group-item-action"><i class="fas fa-chart-line"></i>Danh sách lịch hẹn</a>
            <a href="../Modules/quan-li-comment.php" class="list-group-item list-group-item-action"><i class="fas fa-file-invoice-dollar"></i>Quản lí bình luận</a>
            <a href="../Modules/Addchassis.php" class="list-group-item list-group-item-action"><i class="fas fa-users"></i>Thêm sản phẩm</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-project-diagram"></i>Projects</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-cogs"></i>Settings</a>
            <a href="logout.php" class="list-group-item list-group-item-action text-danger"><i class="fas fa-power-off"></i>Logout</a>
        </div>
    </aside>

    <div id="page-content-wrapper">
        <header class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 border-bottom">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left fs-4 me-3" id="menu-toggle"></i>
                <h2 class="fs-2 m-0">Dashboard</h2>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a href="#" class="btn btn-primary">Upgrade to PRO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-2"></i><?php echo htmlspecialchars($adminName); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>