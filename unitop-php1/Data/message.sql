--
-- Cấu trúc bảng cho `reviews`
-- Đã cập nhật để thêm user_id
--
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'Khóa ngoại liên kết đến bảng users',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint(1) NOT NULL COMMENT 'Điểm đánh giá từ 1 đến 5',
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Thêm constraint để đảm bảo điểm đánh giá chỉ từ 1 đến 5
--
ALTER TABLE `reviews`
ADD CONSTRAINT `chk_rating` CHECK (`rating` >= 1 AND `rating` <= 5);

-- Gợi ý: Bạn nên thêm khóa ngoại để đảm bảo toàn vẹn dữ liệu
-- ALTER TABLE `reviews` ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
