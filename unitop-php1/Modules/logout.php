<?php
// Bắt đầu session để có thể truy cập và hủy nó
session_start();

// Hủy tất cả các biến session
$_SESSION = array();

// Hủy session
session_destroy();

// Chuyển hướng người dùng về trang chủ
header("location: /unitop-php1/Modules/Home.php");
exit;
?>