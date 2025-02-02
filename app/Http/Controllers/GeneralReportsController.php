<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Models\RequisitionItemsSerial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->roles->first()->name ?? 'default';

        if (in_array($role, ['laboratory', 'dean', 'superadmin'])) {
            return view("reports.{$role}-index");
        }
    }


    public function filter(Request $request)
    {
        $filterType = $request->input('filter');
        $data = [];

        switch ($filterType) {
            case 'lost_damaged':
                $data = $this->getLostDamagedItems();
                $data->put('damage_lost_items', true);
                break;
            case 'requisition':
                $data = $this->getRequisitionItems();
                break;
            default:
                return collect();
                break;
        }

        return response()->json($data);
    }

    protected function getLostDamagedItems()
    {
        $items = RequisitionItemsSerial::where('borrow_status', 'Damaged')
            ->with(['equipmentBelongs.category', 'serialRelatedItem'])
            ->get();
        return collect(['items' => $items, 'damage_lost_items' => true]);
    }

    protected function getRequisitionItems()
    {
        return Requisition::with(['category', 'items.serials.equipmentBelongs', 'items.serials.serialRelatedItem', 'students', 'instructor'])->get();
    }
}
