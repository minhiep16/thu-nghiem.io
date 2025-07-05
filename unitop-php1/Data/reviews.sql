ALTER TABLE `reviews`
ADD COLUMN `user_id` INT(11) NOT NULL AFTER `id`,
ADD KEY `user_id` (`user_id`);