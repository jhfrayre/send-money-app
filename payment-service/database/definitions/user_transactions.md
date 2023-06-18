## user_transactions.payer/payee JSON format

#### Case: Send to user

```json
{
    "user":{
        "user_id":17,
        "email":"test@example.com"
    }
}
```

#### Case: Bank transfer
```json
{
    "bank":{
        "financial_institution_id":17,
        "bank_name":"Bank of the Philippine Islands",
        "account_number":"123456789",
        "account_name":"Test User"
    }
}
```
