CREATE TABLE `ach_participants` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `financial_institution_id` int unsigned NOT NULL COMMENT "financial_institutions.id",
  `payment_system_id` int NOT NULL COMMENT "payment_systems.id; Electronic fund transfer (EFT) service the institution participates in e.g. PESONet or InstaPay",
  `role` tinyint(2) unsigned NOT NULL DEFAULT "1" COMMENT "1 = Sender and Receiver; 1 = Receiver only; 2 = Sender only",
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT "0" COMMENT "0 = inactive or disabled; 1 = active",
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY `fkey_financial_institution_id` (`financial_institution_id`) REFERENCES financial_institutions(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT "Table containing participants of automated clearing houses (ACH) in the Philippines";
