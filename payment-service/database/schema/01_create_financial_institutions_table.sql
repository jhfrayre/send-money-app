CREATE TABLE `financial_institutions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT "Full or legal name",
  `short_name` varchar(50) NULL DEFAULT NULL COMMENT "Short name or more commonly known name",
  `type` tinyint(2) NOT NULL COMMENT "1 = Universal and Commercial Bank; 2 = Thrift Bank; 3 = Rural Bank; 4 = Digital Bank; 5 = Electronic Money Issuer/Others",
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ukey_institution_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT "List of financial institutions in the Philippines";
