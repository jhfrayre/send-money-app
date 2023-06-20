<?php

namespace App\Domain\Services;

use App\Domain\Contracts\{
    Repositories\BalanceRepositoryInterface,
    Repositories\TransactionRepositoryInterface,
    Services\MoneyTransactionServiceInterface
};
use App\Domain\Entities\MoneyTransaction;
use App\Domain\ValueObjects\{
    TransactionParticipant,
    UserId
};
use \DateTimeImmutable;
use \Exception;
use Illuminate\Support\Facades\DB;

class MoneyTransactionService implements MoneyTransactionServiceInterface
{
    protected $transactionRepo;
    protected $balanceRepo;

    public function __construct(
        TransactionRepositoryInterface $transactionRepo,
        BalanceRepositoryInterface $balanceRepo
    ) {
        $this->transactionRepo = $transactionRepo;
        $this->balanceRepo = $balanceRepo;
    }

    /**
     * @param MoneyTransaction $senderTransaction
     * @param TransactionParticipant $senderDetails
     * @param DateTimeImmutable $now
     *
     * @return MoneyTransaction $senderTransaction
     */
    public function sendMoneyToUser(
        MoneyTransaction $senderTransaction,
        TransactionParticipant $senderDetails,
        DateTimeImmutable $now
    ): MoneyTransaction {
        $recipientId = $senderTransaction->payee()->userId();
        $recipientBalance = $this->balanceRepo->findUserCurrentBalance($recipientId);
        $recipientTransaction = new MoneyTransaction(
            $recipientId,
            $senderTransaction->paymentSystem(),
            $senderTransaction->postedAt(),
            $recipientBalance->{'balance'},
            $senderTransaction->amount(),
            MoneyTransaction::DEBIT
        );
        $recipientTransaction->setPayer($senderDetails);
        $recipientTransaction->setDescription('Receive Money');
        try {
            DB::beginTransaction();
            $userBalance = $this->balanceRepo->findUserCurrentBalance($senderTransaction->userId());
            $senderTransaction->setBeginningBalance($userBalance->{'balance'});
            if ($senderTransaction->isValid()) {
                $isSendMoneySuccess = $this->transactionRepo->postTransaction($senderTransaction, $now);
                $isReceiveMoneySuccess = $this->transactionRepo->postTransaction($recipientTransaction, $now);
                if ($isSendMoneySuccess && $isReceiveMoneySuccess) {
                    $updateSenderBalance = $this->balanceRepo->updateUserCurrentBalance(
                        $senderTransaction->userId(), $now, $senderTransaction->endingBalance()
                    );
                    $updateRecipientBalance = $this->balanceRepo->updateUserCurrentBalance(
                        $recipientId, $now, $recipientTransaction->endingBalance()
                    );
                }
                DB::commit();
                $senderTransaction->setCompletedAt($now);
                $senderTransaction->setStatus(MoneyTransaction::COMPLETED);
            } else {
                DB::rollBack();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $senderTransaction->setStatus(MoneyTransaction::VOID);
        }
        return $senderTransaction;
    }

    /**
     * @param MoneyTransaction $transaction
     * @param DateTimeImmutable $now
     *
     * @return MoneyTransaction $transaction
     */
    public function sendMoneyViaBankTransfer(
        MoneyTransaction $transaction,
        DateTimeImmutable $now
    ): MoneyTransaction {
        try {
            DB::beginTransaction();
            $userBalance = $this->balanceRepo->findUserCurrentBalance($transaction->userId());
            $transaction->setBeginningBalance($userBalance->{'balance'});
            if ($transaction->isValid()) {
                $this->transactionRepo->postTransaction($transaction, $now);
                $this->balanceRepo->updateUserCurrentBalance(
                    $transaction->userId(),
                    $now,
                    $transaction->endingBalance()
                );
                DB::commit();
                $transaction->setCompletedAt($now);
                $transaction->setStatus(MoneyTransaction::COMPLETED);
            } else {
                DB::rollBack();
            }
        } catch (Exception $e) {
            DB::rollBack();
            $transaction->setStatus(MoneyTransaction::VOID);
        }
        return $transaction;
    }

    public function checkUserCurrentBalance(UserId $userId): array
    {
        $data = $this->balanceRepo->findUserCurrentBalance($userId);
        return $data;
    }
}
