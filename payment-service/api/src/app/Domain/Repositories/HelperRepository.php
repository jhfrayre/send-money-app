<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Repositories\HelperRepositoryInterface;
use Illuminate\Support\Facades\DB;

class HelperRepository implements HelperRepositoryInterface
{
    public function findACHParticipants()
    {
        $data = DB::table('ach_participants')
            ->join('financial_institutions', 'financial_institutions.id', '=', 'financial_institution_id')
            ->join('payment_systems', 'payment_systems.id', '=', 'payment_system_id')
            ->select('financial_institution_id', 'financial_institutions.name AS bank_name', 'short_name',
                'type', 'payment_system_id', 'payment_systems.name AS payment_system_name', 'role', 'is_deactivated'
            )->get()
            ->toArray();
        return $data;
    }
}