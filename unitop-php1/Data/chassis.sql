
CREATE DATABASE IF NOT EXISTS `datlich` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `datlich`;
CREATE TABLE `chassis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `chassis` (`id`, `name`, `description`, `price`, `image_url`) VALUES
(1, 'Phuộc Cao Cấp Pro-Fender', 'Bộ phuộc hiệu suất cao, tăng cường độ ổn định và êm ái.', 15000000, '../Assets/img/phuoc-cao-cap.jpg'),
(2, 'Thanh Cân Bằng Ultra Racing', 'Giảm thiểu sự vặn xoắn của thân xe khi vào cua.', 4500000, '../Assets/img/thanh-can-bang.jpg'),
(3, 'Bộ Càng A Hợp Kim Nhôm', 'Trọng lượng nhẹ, tăng độ cứng vững cho hệ thống treo.', 8200000, '../Assets/img/cang-a-hop-kim.jpg');


-- Cấu trúc bảng cho các đơn hàng
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_note` text DEFAULT NULL,
  `total_amount` decimal(12,0) NOT NULL,
  `status` enum('pending','processing','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Cấu trúc bảng cho chi tiết của từng đơn hàng

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_purchase` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `chassis` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;