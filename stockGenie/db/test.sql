-- Create `attendances` Table
CREATE TABLE `attendances` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT(20) UNSIGNED NOT NULL,
  `att_time` VARCHAR(255) NOT NULL,
  `att_date` DATE NOT NULL,
  `att_year` YEAR NOT NULL,
  `attendance` VARCHAR(255) NOT NULL,
  `edit_date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `attendances` (`user_id`, `att_time`, `att_date`, `att_year`, `attendance`, `edit_date`, `created_at`, `updated_at`) VALUES
(5, '13:41:17', '2024-10-13', '2024', 'Present', '2024-10-13', NULL, NULL);

-- Create `category` Table
CREATE TABLE `category` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`category_name`, `created_at`, `updated_at`) VALUES
('est', '2024-10-08 17:38:19', '2024-10-08 17:38:19'),
('voluptatem', '2024-10-08 17:38:19', '2024-10-08 17:38:19'),
('et', '2024-10-08 17:38:19', '2024-10-08 17:38:19'),
('aut', '2024-10-08 17:38:19', '2024-10-08 17:38:19'),
('corporis', '2024-10-08 17:38:19', '2024-10-08 17:38:19'),
('omnis', '2024-10-08 17:38:19', '2024-10-08 17:38:19'),
('repellendus', '2024-10-08 17:38:19', '2024-10-08 17:38:19') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;;

-- Create `employees` Table
CREATE TABLE `employees` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` BIGINT(20) UNSIGNED NOT NULL UNIQUE,
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `email` VARCHAR(255) NOT NULL DEFAULT '',
  `phone` VARCHAR(255) NOT NULL DEFAULT '',
  `address` VARCHAR(255) NOT NULL DEFAULT '',
  `experience` INT DEFAULT NULL,
  `photo` VARCHAR(255) NOT NULL DEFAULT '',
  `salary` DECIMAL(15,2) NOT NULL DEFAULT '0.00',
  `vacation` INT NOT NULL DEFAULT '0',
  `city` VARCHAR(255) NOT NULL DEFAULT '',
  `nid` BIGINT(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`employee_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `employees` (`employee_id`, `name`, `email`, `phone`, `address`, `experience`, `photo`, `salary`, `vacation`, `city`, `nid`, `created_at`, `updated_at`) VALUES
(5, 'lemon', 'lemon@gmail.com', '01234567892', 'XYZ, JatraBark, Dhaka 1204', NULL, '', 0.00, 0, 'Dhaka', NULL, NULL, NULL);

-- Create `expenses` Table
CREATE TABLE `expenses` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `details` VARCHAR(255) NOT NULL,
  `amount` DECIMAL(15,2) NOT NULL,
  `date` DATE NOT NULL,
  `month` VARCHAR(255) NOT NULL,
  `year` YEAR NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `expenses` (`details`, `amount`, `date`, `month`, `year`, `created_at`, `updated_at`) VALUES
('Employee Salary', 200000.00, '2024-10-13', 'October', 2024, NULL, NULL);

-- Create `orders` Table
CREATE TABLE `orders` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` BIGINT(20) UNSIGNED DEFAULT NULL,
  `order_date` DATE NOT NULL,
  `order_month` VARCHAR(255) NOT NULL,
  `order_year` YEAR NOT NULL,
  `order_status` VARCHAR(255) NOT NULL,
  `total_products` INT NOT NULL,
  `sub_total` DECIMAL(15,2) NOT NULL,
  `vat` DECIMAL(15,2) NOT NULL,
  `total` DECIMAL(15,2) NOT NULL,
  `payment_status` VARCHAR(255) NOT NULL,
  `pay` DECIMAL(15,2) DEFAULT NULL,
  `due` DECIMAL(15,2) DEFAULT NULL,
  `returnAmount` DECIMAL(15,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`customer_id`) REFERENCES `customer`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`customer_id`, `order_date`, `order_month`, `order_year`, `order_status`, `total_products`, `sub_total`, `vat`, `total`, `payment_status`, `pay`, `due`, `returnAmount`, `created_at`, `updated_at`) VALUES
(NULL, '2024-10-10', 'October', 2024, 'success', 1, 80.86, 8.09, 88.95, 'Cash', 90.00, 0.00, 1.05, NULL, NULL),
(NULL, '2024-10-13', 'October', 2024, 'success', 2, 43.20, 4.32, 47.52, 'Cash', 50.00, 0.00, 2.48, NULL, NULL);

-- Create `order_details` Table
CREATE TABLE `order_details` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` BIGINT(20) UNSIGNED NOT NULL,
  `product_id` BIGINT(20) UNSIGNED NOT NULL,
  `quantity` INT NOT NULL,
  `unitCost` DECIMAL(15,2) NOT NULL,
  `total` DECIMAL(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`),
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_details` (`order_id`, `product_id`, `quantity`, `unitCost`, `total`, `created_at`, `updated_at`) VALUES
(1, 46, 1, 81.00, 89.00, NULL, NULL),
(2, 1, 1, 7.00, 7.00, NULL, NULL),
(2, 2, 1, 37.00, 40.00, NULL, NULL);

-- Create `password_reset_tokens` Table
CREATE TABLE `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('test@example.com', '9d29e9de453290b788e3e59840d3e3bc', NULL);

-- Create `products` Table
CREATE TABLE `products` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(255) NOT NULL DEFAULT '',
  `product_code` VARCHAR(255) NOT NULL DEFAULT '',
  `category_id` BIGINT(20) UNSIGNED NOT NULL,
  `quantity` INT NOT NULL,
  `unit_price` DECIMAL(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `category`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`product_name`, `product_code`, `category_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
('Sugar', 'SUGAR123', 1, 100, 50.00, NULL, NULL),
('Salt', 'SALT123', 2, 200, 30.00, NULL, NULL),
('Oil', 'OIL123', 3, 150, 75.00, NULL, NULL);

-- -- Create `roles` Table
-- CREATE TABLE `roles` (
--   `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
--   `role` VARCHAR(255) NOT NULL,
 
  
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- INSERT INTO `roles` (`role`, `created_at`, `updated_at`) VALUES
-- ('Admin', NULL, NULL),
-- ('User', NULL, NULL);

-- Create `user_role` Table
CREATE TABLE `user_role` (
  `user_id` BIGINT(20) UNSIGNED NOT NULL,
  `role_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(5, 1);
