<?php

namespace App\Http\Controllers;

use App\Domain\ValueObjects\UserId;
use App\Domain\Repositories\UserRepository;
use App\Models\User;
use \DateTimeImmutable;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(Request $request)
    {
        $now = new DateTimeImmutable('now');
        $email = $request->email;
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $userId = UserId::make($user->getAuthIdentifier());
            $token = $user->createToken('accessToken')->accessToken;
            $this->userRepo->logUserLogin($userId, $now);
            return response()->json(['token' => $token], 200);
        } else {
            $user = User::where('email', '=', $request->email)->first();
            if (isset($user) && is_int($user->getAuthIdentifier())) {
                $userId = UserId::make($user->getAuthIdentifier());
                $this->userRepo->logUserLogin($userId, $now, $isSuccess = false);
            }
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Logged out'], 200);
    }

    public function userInfo(Request $request)
    {
        $user = $request->user();
        return response()->json(['user' => $user], 200);
    }
}
