-- --
-- -- Cấu trúc Cơ sở dữ liệu cho dự án Đặt Lịch
-- -- AI Viết Web Pro tạo lúc 21:05 ngày 30/06/2025
-- --

-- -- Bước 1: Tạo cơ sở dữ liệu `datlich` nếu nó chưa tồn tại.
-- -- Sử dụng `utf8mb4` để hỗ trợ đầy đủ ký tự tiếng Việt và biểu tượng cảm xúc.
-- CREATE DATABASE IF NOT EXISTS `datlich` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- -- Bước 2: Chọn cơ sở dữ liệu `datlich` để làm việc
-- USE `datlich`;

-- -- Bước 3: Xóa bảng `appointments` cũ nếu có để tạo lại từ đầu (tùy chọn)
-- -- DROP TABLE IF EXISTS `appointments`;

-- -- Bước 4: Tạo bảng `appointments` mới
-- CREATE TABLE `appointments` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `title` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `brand` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `schedule` date DEFAULT NULL,
--   `message` text COLLATE utf8mb4_unicode_ci,
--   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`),
--   UNIQUE KEY `email_unique` (`email`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- CREATE DATABASE IF NOT EXISTS `datlich` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- USE `datlich`;

-- DROP TABLE IF EXISTS `appointments`;

-- CREATE TABLE `appointments` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `user_id` int(11) NOT NULL,
--   `title` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `message` text COLLATE utf8mb4_unicode_ci, 
--   `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
--   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE DATABASE IF NOT EXISTS `datlich` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `datlich`;

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci, 
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  
  -- Nâng cấp: Thêm cột ngày giờ và trạng thái
  `appointment_datetime` DATETIME NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'chờ xác nhận', -- Các trạng thái: chờ xác nhận, đã xác nhận, đã hủy

  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_appointment_datetime` (`appointment_datetime`) -- Thêm index để tăng tốc độ truy vấn ngày giờ
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;