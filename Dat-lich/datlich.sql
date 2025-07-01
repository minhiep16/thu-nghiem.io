--
-- Cấu trúc Cơ sở dữ liệu cho dự án Đặt Lịch
-- AI Viết Web Pro tạo lúc 21:05 ngày 30/06/2025
--

-- Bước 1: Tạo cơ sở dữ liệu `datlich` nếu nó chưa tồn tại.
-- Sử dụng `utf8mb4` để hỗ trợ đầy đủ ký tự tiếng Việt và biểu tượng cảm xúc.
CREATE DATABASE IF NOT EXISTS `datlich` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Bước 2: Chọn cơ sở dữ liệu `datlich` để làm việc
USE `datlich`;

-- Bước 3: Xóa bảng `appointments` cũ nếu có để tạo lại từ đầu (tùy chọn)
-- DROP TABLE IF EXISTS `appointments`;

-- Bước 4: Tạo bảng `appointments` mới
CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule` date DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;