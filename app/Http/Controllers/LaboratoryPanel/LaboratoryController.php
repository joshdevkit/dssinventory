<?php

namespace App\Http\Controllers\LaboratoryPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComputerEngineering;
use App\Models\ComputerEngineeringSerial;
use App\Models\Construction;
use App\Models\ConstructionSerials;
use App\Models\Fluid;
use App\Models\FluidSerials;
use App\Models\LaboratoryEquipment;
use App\Models\LaboratoryEquipmentItem;
use App\Models\Requisition;
use App\Models\Surveying;
use App\Models\SurveyingSerials;
use App\Models\Testing;
use App\Models\TestingSerials;
use Illuminate\Support\Facades\DB;

class LaboratoryController extends Controller
{
    public function index()
    {


        $requisitions = Requisition::with(['students', 'category', 'instructor', 'items.serials'])->latest()->get();


        $totals = [
            'computer' => LaboratoryEquipment::with(['category', 'items'])
                ->whereHas('category', function ($query) {
                    $query->where('name', 'Computer Engineering');
                })
                ->count('equipment'),
            'construction' => LaboratoryEquipment::with(['category', 'items'])
                ->whereHas('category', function ($query) {
                    $query->where('name', 'General Construction');
                })
                ->count('equipment'),
            'surveying' => LaboratoryEquipment::with(['category', 'items'])
                ->whereHas('category', function ($query) {
                    $query->where('name', 'Surveying');
                })
                ->count('equipment'),
            'testing' => LaboratoryEquipment::with(['category', 'items'])
                ->whereHas('category', function ($query) {
                    $query->where('name', 'Testing & Mechanics');
                })
                ->count('equipment'),
            'fluid' => LaboratoryEquipment::with(['category', 'items'])
                ->whereHas('category', function ($query) {
                    $query->where('name', 'Hydraulics and Fluids');
                })
                ->count('equipment')
        ];

        return view('laboratory.dashboardo', compact('totals', 'requisitions'));
    }

    public function equipment_items()
    {
        $equipments = LaboratoryEquipmentItem::with('equipment.category')->get();


        return view('laboratory.equipment-items.index', compact('equipments'));
    }
}
