<?php

namespace App\Domain\ValueObjects;

/*
 * See payment-service/database/definitions/user_transactions.md
 */
class TransactionParticipant
{
    public const DIRECT_TO_USER = 'user';
    public const VIA_BANK_TRANSFER = 'bank';

    protected $path;
    protected ?UserId $userId = null;
    protected ?string $userEmail = null;
    protected ?int $financialInstitutionId = null;
    protected ?string $financialInstitutionName = null;
    protected ?string $accountNumber = null;
    protected ?string $accountName = null;

    public function __construct(array $details)
    {
        if (isset($details[self::DIRECT_TO_USER])) {
            $participant = $details[self::DIRECT_TO_USER];
            $this->path = self::DIRECT_TO_USER;
            $this->userId = UserId::make($participant['user_id']);
            $this->userEmail = $participant['email'];
        } elseif (isset($details[self::VIA_BANK_TRANSFER])) {
            $participant = $details[self::VIA_BANK_TRANSFER];
            $this->path = self::VIA_BANK_TRANSFER;
            $this->financialInstitutionId = $participant['financial_institution_id'];
            $this->financialInstitutionName = $participant['bank_name'];
            $this->accountNumber = $participant['account_number'];
            $this->accountName = $participant['account_name'];
        }
    }

    public static function fromJson(string $args): self
    {
        $details = json_decode($args, $associative = true);
        return new self($details);
    }

    public function toJson(): string
    {
        switch ($this->path()) {
            case self::DIRECT_TO_USER:
                $data = [
                    $this->path() => [
                        'user_id' => $this->userId()->value(),
                        'email' => $this->userEmail()
                    ]
                ];
                break;
            case self::VIA_BANK_TRANSFER:
                $data = [
                    $this->path() => [
                        'financial_institution_id' => $this->financialInstitutionId(),
                        'bank_name' => $this->financialInstitutionName(),
                        'account_number' => $this->accountNumber(),
                        'account_name' => $this->accountName()
                    ]
                ];
                break;
            default:
                $data = null;
                break;
        }

        return json_encode($data);
    }

    public function path(): string
    {
        return $this->path;
    }

    public function userId(): ?UserId
    {
        return $this->userId;
    }

    public function userEmail(): ?string
    {
        return $this->userEmail;
    }

    public function financialInstitutionId(): ?int
    {
        return $this->financialInstitutionId;
    }

    public function financialInstitutionName(): ?string
    {
        return $this->financialInstitutionName;
    }

    public function accountNumber(): ?string
    {
        return $this->accountNumber;
    }

    public function accountName(): ?string
    {
        return $this->accountName;
    }
}
