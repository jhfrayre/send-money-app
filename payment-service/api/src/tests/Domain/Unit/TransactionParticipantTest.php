<?php

use App\Domain\ValueObjects\{TransactionParticipant, UserId};

test('TransactionParticipant is instantiable', function () {
    $directTransfer = '{"user":{"user_id":17,"email":"test@example.com"}}';
    $participant = new TransactionParticipant(json_decode($directTransfer, true));
    expect($participant instanceof TransactionParticipant)->toBe(true);
});

test('TransactionParticipant fromJson path="user"', function () {
    $directTransfer = '{"user":{"user_id":17,"email":"test@example.com"}}';
    $participant = TransactionParticipant::fromJson($directTransfer);
    expect($participant->path())->toBeString()->toBe('user');
    expect($participant->userId() instanceof UserId)->toBe(true);
    expect($participant->userId()->value())->toBeInt()->toBe(17);

    expect($participant->financialInstitutionId())->toBe(null);
    expect($participant->financialInstitutionName())->toBe(null);
    expect($participant->accountNumber())->toBe(null);
    expect($participant->accountName())->toBe(null);
});

test('TransactionParticipant fromJson path="bank', function () {
    $bankTransfer = '{
        "bank":{
            "financial_institution_id":17,
            "bank_name":"Bank of the Philippine Islands",
            "account_number":"123456789",
            "account_name":"Test User"
        }
    }';
    $participant = TransactionParticipant::fromJson($bankTransfer);
    expect($participant->path())->toBeString()->toBe('bank');
    expect($participant->financialInstitutionId())->toBeInt()->toBe(17);
    expect($participant->financialInstitutionName())->toBeString()->toBe('Bank of the Philippine Islands');
    expect($participant->accountNumber())->toBeString()->toBe('123456789');
    expect($participant->accountName())->toBeString()->toBe('Test User');

    expect($participant->userId())->toBe(null);
    expect($participant->userEmail())->toBe(null);
});

test('TransactionParticipant toJson path="user"', function () {
    $directTransfer = '{
        "user":{
            "user_id": 17,
            "email": "test@example.com"
        }
    }';
    $participant = TransactionParticipant::fromJson($directTransfer);
    $output = $participant->toJson();
    expect($output)->toBeString();
    expect(json_decode($output, $associative = true))->toBe(json_decode($directTransfer, $associative = true));
});

test('TransactionParticipant toJson path="bank"', function () {
    $bankTransfer = '{
        "bank":{
            "financial_institution_id": 17,
            "bank_name": "Bank of the Philippine Islands",
            "account_number": "123456789",
            "account_name": "Test User"
        }
    }';
    $participant = TransactionParticipant::fromJson($bankTransfer);
    $output = $participant->toJson();
    expect($output)->toBeString();
    expect(json_decode($output, $associative = true))->toBe(json_decode($bankTransfer, $associative = true));
});
