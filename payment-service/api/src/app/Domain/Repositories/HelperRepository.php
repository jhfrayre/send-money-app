<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Repositories\HelperRepositoryInterface;
use App\Domain\ValueObjects\PaymentSystem;
use Illuminate\Support\Facades\DB;

class HelperRepository implements HelperRepositoryInterface
{
    public function findACHParticipants(?PaymentSystem $paymentSystem)
    {
        $query = DB::table('ach_participants')
            ->join('financial_institutions', 'financial_institutions.id', '=', 'financial_institution_id')
            ->join('payment_systems', 'payment_systems.id', '=', 'payment_system_id')
            ->select('financial_institution_id', 'financial_institutions.name AS bank_name', 'short_name',
                'type', 'payment_system_id', 'payment_systems.name AS payment_system_name', 'role', 'is_deactivated'
            )->where('is_deactivated', '=', '0')
            ->whereIn('role', [1, 2]);
        if (isset($paymentSystem)) {
            $query->where('payment_system_id', '=', $paymentSystem->id());
        }
        $data = $query->get()
            ->toArray();
        return $data;
    }
}
