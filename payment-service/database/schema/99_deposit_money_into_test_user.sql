INSERT INTO user_transactions (user_id, payment_system_id, type, amount, payer, beginning_balance, ending_balance, description)
VALUES
(11, 1, 1, 1000, '{"bank":{"financial_institution_id":8,"bank_name":"Bank of the Philippine Islands","account_number":"123456789","account_name":"Test User"}}', 0.00, 1000.00, "Add Money");
INSERT INTO user_current_balance (user_id, balance) VALUES (11, 1000);
INSERT INTO user_current_balance (user_id, balance) VALUES (12, 0);

