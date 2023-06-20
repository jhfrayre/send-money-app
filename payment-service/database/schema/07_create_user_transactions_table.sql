CREATE TABLE `user_transactions` (
  `id` bigint(9) unsigned NOT NULL AUTO_INCREMENT COMMENT "Reference Number",
  `user_id` bigint unsigned NOT NULL COMMENT "users.id",
  `payment_system_id` int unsigned NOT NULL COMMENT "payment_systems.id",
  `type` tinyint(2) signed NOT NULL COMMENT "-1 = Credit; +1 = Debit",
  `payee` json NULL DEFAULT NULL COMMENT "Details on the entity receiving the payment",
  `payer` json NULL DEFAULT NULL COMMENT "Details on the entity making the payment",
  `amount`decimal(8,2) unsigned NOT NULL COMMENT "Amount in PHP",
  `beginning_balance` decimal(9,2) unsigned NOT NULL,
  `ending_balance` decimal(9,2) unsigned NOT NULL,
  `description` varchar(100) COMMENT "e.g. Deposit, Send Money, etc.",
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `key_user_payment` (`user_id`, `payment_system_id`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT "Primary table containing all transactions initiated by the users";
