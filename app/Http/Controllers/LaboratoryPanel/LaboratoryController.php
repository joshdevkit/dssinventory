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
        // $requisitions = DB::table('requisitions')
        //     ->leftJoin('requisitions_items', 'requisitions.id', '=', 'requisitions_items.requisition_id')

        //     ->leftJoin('construction', function ($join) {
        //         $join->on('requisitions.category', '=', DB::raw("'Constructions'"))
        //             ->on('requisitions_items.equipment_id', '=', 'construction.id');
        //     })
        //     ->leftJoin('testings', function ($join) {
        //         $join->on('requisitions.category', '=', DB::raw("'Testing'"))
        //             ->on('requisitions_items.equipment_id', '=', 'testings.id');
        //     })
        //     ->leftJoin('surveyings', function ($join) {
        //         $join->on('requisitions.category', '=', DB::raw("'Surveying'"))
        //             ->on('requisitions_items.equipment_id', '=', 'surveyings.id');
        //     })
        //     ->leftJoin('fluid', function ($join) {
        //         $join->on('requisitions.category', '=', DB::raw("'Fluid'"))
        //             ->on('requisitions_items.equipment_id', '=', 'fluid.id');
        //     })
        //     ->leftJoin('computer_engineering', function ($join) {
        //         $join->on('requisitions.category', '=', DB::raw("'ComputerEngineering'"))
        //             ->on('requisitions_items.equipment_id', '=', 'computer_engineering.id');
        //     })

        //     ->leftJoin('users', 'requisitions.instructor_id', '=', 'users.id')

        //     ->select(
        //         'requisitions.id',
        //         'requisitions.category',
        //         'requisitions.date_time_filed',
        //         'requisitions.date_time_needed',
        //         'requisitions.instructor_id',
        //         'requisitions.subject',
        //         'requisitions.course_year',
        //         'requisitions.activity',
        //         'requisitions.status',
        //         'requisitions.dean_signature',
        //         'requisitions.labtext_signature',
        //         'requisitions.received_date',
        //         'requisitions.returned_date',
        //         'requisitions.issued_date',
        //         'requisitions.checked_date',
        //         'requisitions.created_at',
        //         'requisitions.updated_at',
        //         'users.name as instructor_name',

        //         DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Constructions" THEN construction.equipment END) as construction_equipment'),
        //         DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Testings" THEN testings.equipment END) as testing_equipment'),
        //         DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Surveying" THEN surveyings.equipment END) as surveying_equipment'),
        //         DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Fluids" THEN fluid.equipment END) as fluid_equipment'),
        //         DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "ComputerEngineering" THEN computer_engineering.equipment END) as computer_engineering_equipment'),

        //         DB::raw('SUM(CASE WHEN requisitions.category = "Constructions" THEN requisitions_items.quantity ELSE 0 END) as construction_item_quantity'),
        //         DB::raw('SUM(CASE WHEN requisitions.category = "Testings" THEN requisitions_items.quantity ELSE 0 END) as testing_item_quantity'),
        //         DB::raw('SUM(CASE WHEN requisitions.category = "Surveying" THEN requisitions_items.quantity ELSE 0 END) as surveying_item_quantity'),
        //         DB::raw('SUM(CASE WHEN requisitions.category = "Fluids" THEN requisitions_items.quantity ELSE 0 END) as fluid_item_quantity'),
        //         DB::raw('SUM(CASE WHEN requisitions.category = "ComputerEngineering" THEN requisitions_items.quantity ELSE 0 END) as computer_engineering_item_quantity')
        //     )
        //     ->groupBy(
        //         'requisitions.id',
        //         'requisitions.category',
        //         'requisitions.date_time_filed',
        //         'requisitions.date_time_needed',
        //         'requisitions.instructor_id',
        //         'requisitions.subject',
        //         'requisitions.course_year',
        //         'requisitions.activity',
        //         'requisitions.status',
        //         'requisitions.dean_signature',
        //         'requisitions.labtext_signature',
        //         'requisitions.received_date',
        //         'requisitions.returned_date',
        //         'requisitions.issued_date',
        //         'requisitions.checked_date',
        //         'requisitions.created_at',
        //         'requisitions.updated_at',
        //         'users.name'
        //     )
        //     ->latest('requisitions.created_at')
        //     ->take(10)
        //     ->get();

        $requisitions = Requisition::with(['students', 'category', 'instructor', 'items.serials'])->get();
        // dd($requisitions);


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
