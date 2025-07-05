-- Tạo cơ sở dữ liệu nếu nó chưa tồn tại.
CREATE DATABASE IF NOT EXISTS `datlich` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `datlich`;

--
-- Cấu trúc bảng cho `products`
-- Lưu trữ thông tin chung của sản phẩm.
--
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên sản phẩm, ví dụ: Hoodie with pouch pocket',
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Loại sản phẩm, ví dụ: DRESS, T-SHIRT',
  `base_price` decimal(10,2) NOT NULL COMMENT 'Giá gốc của sản phẩm',
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Đường dẫn ảnh đại diện',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Thêm dữ liệu mẫu cho bảng `products`
--
INSERT INTO `products` (`id`, `name`, `description`, `category`, `base_price`, `image_url`) VALUES
(1, 'Hoodie with pouch pocket', 'A comfortable hoodie made from high-quality cotton.', 'DRESS', 75.00, 'https://via.placeholder.com/100x120');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho `product_variants`
-- Lưu trữ các biến thể của sản phẩm (ví dụ: màu Mint, size S).
--
CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT 'Khóa ngoại liên kết đến bảng products',
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0 COMMENT 'Số lượng tồn kho của biến thể này',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Thêm dữ liệu mẫu cho bảng `product_variants`
--
INSERT INTO `product_variants` (`id`, `product_id`, `color`, `size`, `stock_quantity`) VALUES
(1, 1, 'Mint', 'S', 50),
(2, 1, 'Mint', 'M', 50),
(3, 1, 'Mint', 'L', 40),
(4, 1, 'Brown', 'S', 30),
(5, 1, 'Brown', 'M', 30),
(6, 1, 'Brown', 'L', 25);