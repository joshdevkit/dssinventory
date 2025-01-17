<?php

namespace App\Http\Controllers\DeanPanel;

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

class DeanController extends Controller
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
            'transactions' => Requisition::count(),
            'office_transac' => OfficeRequest::count(),
        ];
        return view('dean.dashboard', compact('totals'));
    }
}
