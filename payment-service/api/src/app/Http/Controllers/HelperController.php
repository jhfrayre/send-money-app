<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\HelperRepository;
use App\Domain\ValueObjects\PaymentSystem;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    protected $helperRepo;

    public function __construct(HelperRepository $helperRepo)
    {
        $this->helperRepo = $helperRepo;
    }

    public function institutions($paymentSystemId)
    {
        $paymentSystem = null;
        if (is_int($paymentSystemId)) {
            $paymentSystem = new PaymentSystem($paymentSystemId);
        }
        $data = $this->helperRepo->findACHParticipants($paymentSystem);
        return response()->json(['financial-institutions' => $data], 200);
    }
}
