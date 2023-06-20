<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\HelperRepository;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    protected $helperRepo;

    public function __construct(HelperRepository $helperRepo)
    {
        $this->helperRepo = $helperRepo;
    }

    public function institutions()
    {
        $data = $this->helperRepo->findACHParticipants();
        return response()->json(['financial-institutions' => $data], 200);
    }
}
