CREATE TABLE `user_current_balance` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL COMMENT "users.id",
  `balance`decimal(9,2) unsigned NOT NULL COMMENT "Balance in PHP",
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ukey_user_id` (`user_id`),
  FOREIGN KEY `ukey_user_id` (`user_id`) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT "Table to store the users' latest updated balance";
