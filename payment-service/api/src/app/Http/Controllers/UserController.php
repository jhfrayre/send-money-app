<?php

namespace App\Http\Controllers;

use App\Domain\ValueObjects\UserId;
use App\Domain\Repositories\{BalanceRepository, UserRepository};
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo;
    protected $balanceRepo;
    protected $transactionRepo;

    public function __construct(UserRepository $userRepo, BalanceRepository $balanceRepo)
    {
        $this->userRepo = $userRepo;
        $this->balanceRepo = $balanceRepo;
    }

    public function userInfo(Request $request)
    {
        $user = auth()->user();
        $userId = UserId::make($user['id']);
        $balance = $this->balanceRepo->findUserCurrentBalance($userId);
        $user['balance'] = $balance->{'balance'};

        return response()->json(['user' => $user], 200);
    }
}
