<?php

namespace App\Http\Controllers;

use App\Domain\Entities\MoneyTransaction;
use App\Domain\Repositories\{
    BalanceRepository,
    TransactionRepository,
    UserRepository
};
use App\Domain\Services\MoneyTransactionService;
use App\Domain\ValueObjects\{
    PaymentSystem,
    TransactionParticipant,
    UserId
};
use App\Models\User as UserModel;
use \DateTimeImmutable;
use \Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $userRepo;
    protected $balanceRepo;
    protected $transactionRepo;
    protected $transactionService;

    public function __construct(
        UserRepository $userRepo,
        BalanceRepository $balanceRepo,
        TransactionRepository $transactionRepo,
        UserModel $userModel
    ) {
        $this->userRepo = $userRepo;
        $this->balanceRepo = $balanceRepo;
        $this->transactionRepo = $transactionRepo;
        $this->transactionService = new MoneyTransactionService(
            $this->transactionRepo,
            $this->balanceRepo
        );
        $this->userModel = $userModel;
    }

    public function sendMoneyToUser(Request $request)
    {
        $user = auth()->user();
        $userId = UserId::make($user['id']);
        $postedAt = new DateTimeImmutable('now');
        $beginningBalance = $this->balanceRepo->findUserCurrentBalance($userId);
        $amount = $request->request->get('amount');
        $senderTransaction = new MoneyTransaction(
            $userId,
            new PaymentSystem(PaymentSystem::THIS_SERVICE),
            $postedAt,
            $beginningBalance->{'balance'},
            $amount,
            MoneyTransaction::CREDIT
        );
        $senderTransaction->setDescription('Send Money');
        $senderDetails = new TransactionParticipant([
            TransactionParticipant::DIRECT_TO_USER => [
                'user_id' => $userId->value(),
                'email' => $user['email']
            ]
        ]);

        $recipientEmail = $request->request->get('email');
        $recipientUser = $this->userModel->where('email', '=', $recipientEmail)->first();
        if (isset($recipientUser) && is_int($recipientUser->getAuthIdentifier())) {
            $recipientUserId = UserId::make($recipientUser->getAuthIdentifier());
            $recipientObject = new TransactionParticipant([
                TransactionParticipant::DIRECT_TO_USER => [
                    'user_id' => $recipientUserId->value(),
                    'email' => $recipientEmail
                ]
            ]);
            $senderTransaction->setPayee($recipientObject);
        }

        if ($senderTransaction->isValid() &&
            $senderTransaction->payee() instanceof TransactionParticipant &&
            $recipientUserId->value() !== $userId->value() //Prevent sending money to self
        ) {
            try {
                $completedAt = new DateTimeImmutable('now');
                $senderTransaction = $this->transactionService->sendMoneyToUser(
                    $senderTransaction,
                    $senderDetails,
                    $completedAt
                );
                return response()->json(['transaction' => $senderTransaction], 200);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'Transaction is invalid.'], 409);
        }
    }

    public function bankTransfer(Request $request)
    {
        $user = auth()->user();
        $userId = UserId::make($user['id']);
        $postedAt = new DateTimeImmutable('now');
        $beginningBalance = $this->balanceRepo->findUserCurrentBalance($userId);

        $requestData = $request->request;
        $amount = $requestData->get('amount');
        $paymentSystemId = $requestData->get('payment_system_id');
        $paymentSystemName = $requestData->get('payment_system_name');
        $paymentSystem = new PaymentSystem($paymentSystemId, $paymentSystemName);

        $senderTransaction = new MoneyTransaction(
            $userId,
            $paymentSystem,
            $postedAt,
            $beginningBalance->{'balance'},
            $amount,
            MoneyTransaction::CREDIT
        );
        $senderTransaction->setDescription('Send money via ' . $paymentSystem->name());

        $recipient = TransactionParticipant::fromJson($requestData->get('recipient'));
        $senderTransaction->setPayee($recipient);

        if ($senderTransaction->isValid() && $senderTransaction->payee() instanceof TransactionParticipant) {
            try {
                $completedAt = new DateTimeImmutable('now');
                $senderTransaction = $this->transactionService->sendMoneyViaBankTransfer(
                    $senderTransaction,
                    $completedAt
                );
                return response()->json(['transaction' => $senderTransaction], 200);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage(), 500]);
            }
        } else {
            return response()->json(['error' => 'Transaction is invalid.', 409]);
        }
    }

    public function userTransactionHistory()
    {
        $user = auth()->user();
        $userId = UserId::make($user['id']);
        $transactionList = $this->transactionRepo->findLatestTransactions($userId, $limit = 5);

        return response()->json(['transactions' => $transactionList], 200);
    }
}
