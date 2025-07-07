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
  
  `appointment_datetime` DATETIME NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'chờ xác nhận',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_appointment_datetime` (`appointment_datetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;