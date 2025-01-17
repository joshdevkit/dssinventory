<?php

namespace App\Http\Controllers\SuperAdminPanel;

use App\Http\Controllers\Controller;
use App\Models\ComputerEngineering;
use App\Models\Construction;
use App\Models\Equipment;
use App\Models\Fluid;
use App\Models\OfficeRequest;
use App\Models\Requisition;
use App\Models\Supplies;
use App\Models\Surveying;
use App\Models\Testing;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function index()
    {
        $totals = [
            'computer' => ComputerEngineering::count('equipment'),
            'construction' => Construction::count('equipment'),
            'fluid' => Fluid::count('equipment'),
            'surveying' => Surveying::count('equipment'),
            'testing' => Testing::count('equipment'),
            'supplies' => Supplies::count(),
            'equipments' => Equipment::count(),
            'office_transaction' => Requisition::count(),
            'laboratory_transaction' => OfficeRequest::count(),
        ];
        return view('superadmin.dashboard', compact('totals'));
    }
}
