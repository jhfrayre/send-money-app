<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\{
    BalanceRepository,
    TransactionRepository,
    UserRepository
};
use App\Domain\ValueObjects\UserId;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $userRepo;
    protected $balanceRepo;
    protected $transactionRepo;

    public function __construct(
        UserRepository $userRepo,
        BalanceRepository $balanceRepo,
        TransactionRepository $transactionRepo
    ) {
        $this->userRepo = $userRepo;
        $this->balanceRepo = $balanceRepo;
        $this->transactionRepo = $transactionRepo;
    }

    public function sendMoneyForm()
    {

    }

    public function sendMoney(Request $request)
    {


    }

    public function userTransactionHistory(Request $request)
    {
        $user = auth()->user();
        $userId = UserId::make($user['id']);
        $transactionList = $this->transactionRepo->findLatestTransactions($userId, $limit = 5);

        return response()->json(['transactions' => $transactionList], 200);
    }
}
