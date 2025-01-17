<?php

namespace App\Http\Controllers\OfficePanel;

use App\Models\Supplies;
use App\Models\TransactionOffice;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{
    public function index()
    {
        $totals = [
            'supplies' => Supplies::count('item'),
            'equipment' => Equipment::count('item')
        ];
        $requests = DB::table('office_requests')
            ->select(
                'office_requests.*',
                'supplies.item as supply_item',
                'supplies.quantity as supply_quantity',
                'equipment.item as equipment_item',
                'equipment.quantity as equipment_quantity',
                'users.name as requested_by_name'
            )
            ->leftJoin('supplies', function ($join) {
                $join->on('office_requests.item_id', '=', 'supplies.id')
                    ->where('office_requests.item_type', '=', 'Supplies');
            })
            ->leftJoin('equipment', function ($join) {
                $join->on('office_requests.item_id', '=', 'equipment.id')
                    ->where('office_requests.item_type', '=', 'Equipments');
            })
            ->leftJoin('users', 'office_requests.requested_by', '=', 'users.id')
            // ->where('office_requests.status', '=', 'Received')
            // ->whereRaw('DATEDIFF(CURRENT_DATE, office_requests.created_at) >= 3')
            ->latest()
            ->get();

        return view('office.dashboardo', compact('totals', 'requests'));
    }
}
