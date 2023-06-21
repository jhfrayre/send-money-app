/* 01_create_financial_institutions_table.sql */
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

/* 02_insert_financial_institutions.sql */
/* Universal and commercial banks */
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Al-Amanah Islamic Investment Bank of the Philippines", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Asia United Bank Corporation", "AUB", 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Australia and New Zealand Banking Group Ltd.", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Bangkok Bank Public Co. Ltd.", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Bank of America, N.A", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Bank of China (Hongkong) Limited-Manila Branch", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Bank of Commerce", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Bank of the Philippine Islands", "BPI", 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("BDO Unibank, Inc.", "BDO", 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Cathay United Bank Co., Ltd. - Manila Branch", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("China Banking Corporation", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("CIMB Bank Philippines, Inc.", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Citibank, N.A.", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("CTBC Bank (Philippines) Corporation", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Deutsche Bank AG", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Development Bank of the Philippines", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("East West Banking Corporation", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Industrial and Commercial Bank of China, Ltd. - Manila Branch", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Industrial Bank of Korea Manila Branch", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("JP Morgan Chase Bank, N.A.", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("KEB Hana Bank - Manila Branch", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Land Bank of the Philippines", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Maybank Philippines, Inc.", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Mega International Commercial Bank Co., Ltd.", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Metropolitan Bank and Trust Company", "Metrobank", 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Mizuho Bank, Ltd. - Manila Branch", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("MUFG Bank, Ltd.", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Philippine Bank of Communications", "PBOC", 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Philippine National Bank", "PNB", 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Philippine Trust Company", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Philippine Veterans Bank", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rizal Commercial Banking Corporation", "RCBC", 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Robinsons Bank Corporation", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Security Bank Corporation", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Shinhan Bank - Manila Branch", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Standard Chartered Bank", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Sumitomo Mitsui Banking Corporation - Manila Branch", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("The Hongkong & Shanghai Banking Corporation", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Union Bank of the Philippines", NULL, 1);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("United Overseas Bank Limited, Manila Branch", NULL, 1);

/* Thrift Banks */
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("AllBank (A Thrift Bank), Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Bangko Kabayan, Inc. (A Private Development Bank)", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Bank of Makati (A Savings Bank), Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("BPI Direct BanKO, Inc., A Savings Bank", "BPI Direct BanKO", 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Card SME Bank Inc., A Thrift Bank", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("China Bank Savings, Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Dumaguete City Development Bank, Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Equicom Savings Bank, Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("First Consolidated Bank, Inc. (A Private Development Bank)", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("HSBC Savings Bank (Phils), Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("ISLA Bank (A Thrift Bank), Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Legazpi Savings Bank, Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Luzon Development Bank", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Malayan Savings Bank, Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Pacific Ace Savings Bank, Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Philippine Business Bank, Inc., A Savings Bank", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Philippine Savings Bank", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Producers Savings Bank Corporation", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Queen City Development Bank, Inc. ", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Sterling Bank of Asia, Inc. (A Savings Bank)", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Sun Savings Bank, Inc.", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("UCPB Savings Bank", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Wealth Development Bank Corporation", NULL, 2);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Yuanta Savings Bank Philippines, Inc.", NULL, 2);

/* Rural Banks */
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Bangko Mabuhay (A Rural Bank), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Bangko Nuestra Senora del Pilar, Inc. (A Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("BDO Network Bank, Inc. (A Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Biñan Rural Bank, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("BOF, Inc. (A Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Camalig Bank, Inc. (A Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Cantilan Bank, Inc. (A Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Card Bank, Inc. (A MicrofinanceOriented Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Cebuana Lhuillier Rural Bank, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Cooperative Bank of Quezon Province", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Country Builders Bank, Inc. (A Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Dungganon Bank (A Microfinance Rural Bank), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Dungganon Bank (A MicrofinanceRural Bank), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("East West Rural Bank, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Entrepreneur Rural Bank, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Guagua Rural Bank, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Innovative Rural Bank, Inc. (A Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Laguna Prestige Banking Corporation, (A Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Malarayat Rural Bank, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Mindanao Consolidated Cooperative Bank", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Money Mall Rural Bank, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("MVSM Bank (Rural Bank Since 1953), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Netbank (A Rural Bank), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("New Rural Bank of San Leonardo (Nueva Ecija), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Partner Rural Bank (Cotabato), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Quezon Capital Rural Bank, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rang-Ay Bank, Inc. (A Rural Bank)", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("RBT Bank, Inc., A Rural Bank", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Bacolod City, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Bauang, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Digos, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Guinobatan, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of La Paz, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Lebak (Sultan Kudarat), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Montalban, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Porac (Pampanga), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Rosario (La Union), Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Sagay, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Rural Bank of Sta. Ignacia, Inc.", NULL, 3);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("SeaBank Philippines Inc. (A Rural Bank)", NULL, 3);

/* Digital Banks */
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("GoTyme Bank Corporation", NULL, 4);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Maya Bank, Inc.", NULL, 4);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Tonik Digital Bank, Inc.", NULL, 4);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Union Digital Bank", NULL, 4);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("UNObank, Inc.", NULL, 4);

/* Electronic Money Issuers / Others */
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Alipay Philippines, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("CIS Bayad Center, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("DCPAY Philippines, Inc.", "Coins.ph", 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("G-Xchange, Inc. (GXI)", "GCash", 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Gpay Network PH, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("I-Remit, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Infoserve, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Lulu Financial Services (Phils.), Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("OmniPay, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Paymongo Payments, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Philippine Digital Asset Exchange, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("PPS-PEPP Financial Services Corp.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("ShopeePay Philippines, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("SpeedyPay, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("StarPay Corporation", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("TayoCash, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Traxion Pay, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("USSC Money Services, Inc.", NULL, 5);
INSERT INTO `financial_institutions` (name, short_name, type) VALUES ("Zybi Tech, Inc.", NULL, 5);

/* 03_create_payment_systems_table.sql */
CREATE TABLE `payment_systems` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ukey_system_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT "List of payment schemes/systems in the Philippines";

/* 04_insert_payment_systems.sql */
INSERT INTO `payment_systems` (name) VALUES
("InstaPay"),
("PESONet"),
("Payment App (Internal)");

/* 05_create_ach_participants_table.sql */
CREATE TABLE `ach_participants` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `financial_institution_id` int unsigned NOT NULL COMMENT "financial_institutions.id",
  `payment_system_id` int NOT NULL COMMENT "payment_systems.id; Electronic fund transfer (EFT) service the institution participates in e.g. PESONet or InstaPay",
  `role` tinyint(2) unsigned NOT NULL DEFAULT "1" COMMENT "1 = Sender and Receiver; 2 = Receiver only; 3 = Sender only",
  `is_deactivated` tinyint(1) unsigned NOT NULL DEFAULT "0" COMMENT "0 = active; 1 = inactive; 2 = disabled",
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY `fkey_financial_institution_id` (`financial_institution_id`) REFERENCES financial_institutions(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT "Table containing participants of automated clearing houses (ACH) in the Philippines";

/* 06_insert_ach_participants.sql */
/* Univeral and Commercial banks - InstaPay */
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (2, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (6, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (7, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (8, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (9, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (11, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (12, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (14, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (16, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (17, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (22, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (25, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (28, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (29, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (30, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (31, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (32, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (33, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (34, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (36, 1, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`)  VALUES (39, 1, 1);


/* Universal and Commercial banks - PESONet */
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (1, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (2, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (3, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (4, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (5, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (6, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (7, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (8, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (9, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (10, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (11, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (12, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (13, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (14, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (15, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (16, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (17, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (18, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (19, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (20, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (21, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (22, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (23, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (24, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (25, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (26, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (27, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (28, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (29, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (30, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (31, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (32, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (33, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (34, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (35, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (36, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (37, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (38, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (39, 2, 1);
INSERT INTO `ach_participants` (financial_institution_id, payment_system_id, `role`) VALUES (40, 2, 1);

/* 07_create_user_transactions_table.sql */
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

/* 08_create_user_current_balance_table.sql */
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

/* 09_create_user_login_history_table.sql */
CREATE TABLE `user_login_history` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL COMMENT "users.id",
  `is_success` tinyint(1) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `key_user_login` (`user_id`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT "Logs of user login attempts";

