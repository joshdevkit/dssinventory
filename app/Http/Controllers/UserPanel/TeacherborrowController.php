<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\ComputerEngineering;
use App\Models\Construction;
use App\Models\ConstructionSerials;
use App\Models\Fluid;
use App\Models\OfficeRequest;
use App\Models\Requisition;
use App\Models\RequisitionsItems;
use App\Models\RequisitionsItemsStudents;
use App\Models\Surveying;
use App\Models\Testing;
use App\Models\TeacherBorrow;
use App\Models\User;
use App\Notifications\DeanRequisitionDecisionNotification;
use App\Notifications\NewRequisitionNotification;
use App\Notifications\RequisitionDecisionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TeacherBorrowController extends Controller
{

    public function print($id)
    {
        $requisition = DB::table('requisitions')
            ->leftJoin('requisitions_items', 'requisitions.id', '=', 'requisitions_items.requisition_id')
            ->leftJoin('users', 'requisitions.instructor_id', '=', 'users.id')
            ->where('requisitions.id', $id)
            ->select(
                'requisitions.id',
                'requisitions.category',
                'requisitions.date_time_filed',
                'requisitions.date_time_needed',
                'requisitions.instructor_id',
                'requisitions.subject',
                'requisitions.course_year',
                'requisitions.activity',
                'requisitions.status',
                'requisitions.dean_signature',
                'requisitions.labtext_signature',
                'requisitions.received_date',
                'requisitions.returned_date',
                'requisitions.issued_date',
                'requisitions.checked_date',
                'requisitions.created_at',
                'requisitions.updated_at',
                'users.name as instructor_name'
            )
            ->first();

        $items = DB::table('requisitions_items')
            ->where('requisition_id', $id)
            ->select('equipment_id', 'quantity', 'remarks')
            ->get();

        $equipment_ids = $items->pluck('equipment_id');
        $item_details = $this->getItemsByCategory($requisition->category, $equipment_ids);

        $students = DB::table('requisitions_items_students')
            ->where('requisition_id', $id)
            ->get();

        $data = [
            'requisition' => $requisition,
            'items' => $items,
            'item_details' => $item_details,
            'students' => $students,
        ];

        return view('laboratory.print', compact('data'));
    }

    public function selectCategory(Request $request)
    {
        $category = $request->input('category');

        // if ($category === 'equipments') {
        //     $items = Equipment::with('items')->get()->map(function ($equipment) {
        //         return [
        //             'id' => $equipment->id,
        //             'item' => $equipment->item,
        //             'count' => $equipment->items->count(),
        //         ];
        //     })->toArray();
        // } elseif ($category === 'supplies') {
        //     $items = Supplies::with('items')->get()->map(function ($equipment) {
        //         return [
        //             'id' => $equipment->id,
        //             'item' => $equipment->item,
        //             'count' => $equipment->items->count(),
        //         ];
        //     })->toArray();
        // } else {
        //     $items = [];
        // }

        if ($category == 'constructions') {
            $items = Construction::with('items')->get()->map(function ($constructionsSerial) {
                return [
                    'id' => $constructionsSerial->id,
                    'count' => $constructionsSerial->quantity,
                    'brand' => $constructionsSerial->brand,
                    'equipment' => $constructionsSerial->equipment,
                ];
            })->toArray();
        } elseif ($category == 'testings') {
            $items = Testing::with('items')->get()->map(function ($testingsSerials) {
                return [
                    'id' => $testingsSerials->id,
                    'count' => $testingsSerials->quantity,
                    'brand' => $testingsSerials->brand,
                    'equipment' => $testingsSerials->equipment,
                ];
            })->toArray();
        } elseif ($category == 'surveyings') {
            $items = Surveying::with('items')->get()->map(function ($surveyingSerials) {
                return [
                    'id' => $surveyingSerials->id,
                    'count' => $surveyingSerials->quantity,
                    'brand' => $surveyingSerials->brand,
                    'equipment' => $surveyingSerials->equipment,
                ];
            })->toArray();
        } elseif ($category == 'fluids') {
            $items = Fluid::with('items')->get()->map(function ($fluidSerials) {
                return [
                    'id' => $fluidSerials->id,
                    'count' => $fluidSerials->quantity,
                    'brand' => $fluidSerials->brand,
                    'equipment' => $fluidSerials->equipment,
                ];
            })->toArray();
        } elseif ($category == 'computerEngineering') {
            $items = ComputerEngineering::with('items')->get()->map(function ($comengSerials) {
                return [
                    'id' => $comengSerials->id,
                    'count' => $comengSerials->quantity,
                    'brand' => $comengSerials->brand,
                    'equipment' => $comengSerials->equipment,
                ];
            })->toArray();
        } else {
            $items = [];
        }

        return redirect()->back()->with([
            'category' => $category,
            'items' => $items,
        ]);
    }
    public function create()
    {
        $constructions = Construction::with('items')->get();
        $testings = Testing::with('items')->get();
        $surveyings = Surveying::with('items')->get();
        $fluids = Fluid::with('items')->get();
        $computerEngineering = ComputerEngineering::with('items')->get();
        $user = Auth::user();

        return view('profile.teachersborrow.create', compact('testings', 'constructions', 'surveyings', 'fluids', 'computerEngineering', 'user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dateFiled' => 'required',
            'dateNeeded' =>  'required',
            'subject' => 'required',
            'courseYear' => 'required',
            'activityTitle' => 'required',
            'items.*.item_id' => 'required',
            'items.*.quantity' => 'required',
            'items.*.remarks' => 'required|string',
            'students' => 'required|array',
            'students.*' => 'string',
        ]);

        $instructorId = Auth::id();

        $requisition = Requisition::create([
            'category' => $request->input('category'),
            'date_time_filed' => $validated['dateFiled'],
            'date_time_needed' => $validated['dateNeeded'],
            'instructor_id' => $instructorId,
            'subject' => $validated['subject'],
            'course_year' => $validated['courseYear'],
            'activity' => $validated['activityTitle'],
        ]);

        foreach ($validated['items'] as $item) {
            RequisitionsItems::create([
                'requisition_id' => $requisition->id,
                'equipment_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'remarks' => $item['remarks'],
            ]);
        }

        foreach ($validated['students'] as $student) {
            RequisitionsItemsStudents::create([
                'requisition_id' => $requisition->id,
                'student_name' => $student,
            ]);
        }

        $laboratoryUsers = User::role('laboratory')->get();
        foreach ($laboratoryUsers as $user) {
            $user->notify(new NewRequisitionNotification($requisition));
        }

        return redirect()->route('teachersborrow.create')->with('success', 'Requisitions request has been submitted to Laboratory.');
    }



    public function index()
    {
        $teacherborrows = TeacherBorrow::all();
        $notifications = Auth::user()->notifications;

        $requisitions = DB::table('requisitions')
            ->leftJoin('requisitions_items', 'requisitions.id', '=', 'requisitions_items.requisition_id')
            ->leftJoin('construction', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'Constructions'"))
                    ->on('requisitions_items.equipment_id', '=', 'construction.id');
            })
            ->leftJoin('testings', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'Testing'"))
                    ->on('requisitions_items.equipment_id', '=', 'testings.id');
            })
            ->leftJoin('surveyings', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'Surveying'"))
                    ->on('requisitions_items.equipment_id', '=', 'surveyings.id');
            })
            ->leftJoin('fluid', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'Fluid'"))
                    ->on('requisitions_items.equipment_id', '=', 'fluid.id');
            })
            ->leftJoin('computer_engineering', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'ComputerEngineering'"))
                    ->on('requisitions_items.equipment_id', '=', 'computer_engineering.id');
            })
            ->leftJoin('users', 'requisitions.instructor_id', '=', 'users.id')
            ->select(
                'requisitions.id',
                'requisitions.category',
                'requisitions.date_time_filed',
                'requisitions.date_time_needed',
                'requisitions.instructor_id',
                'requisitions.subject',
                'requisitions.course_year',
                'requisitions.activity',
                'requisitions.status',
                'requisitions.dean_signature',
                'requisitions.labtext_signature',
                'requisitions.received_date',
                'requisitions.returned_date',
                'requisitions.issued_date',
                'requisitions.checked_date',
                'requisitions.created_at',
                'requisitions.updated_at',
                'users.name as instructor_name',
                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Constructions" THEN construction.equipment END) as construction_equipment'),
                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Testing" THEN testings.equipment END) as testing_equipment'),
                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Surveying" THEN surveyings.equipment END) as surveying_equipment'),
                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Fluids" THEN fluid.equipment END) as fluid_equipment'),
                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "ComputerEngineering" THEN computer_engineering.equipment END) as computer_engineering_equipment'),
                DB::raw('SUM(CASE WHEN requisitions.category = "Constructions" THEN requisitions_items.quantity ELSE 0 END) as construction_item_quantity'),
                DB::raw('SUM(CASE WHEN requisitions.category = "Testing" THEN requisitions_items.quantity ELSE 0 END) as testing_item_quantity'),
                DB::raw('SUM(CASE WHEN requisitions.category = "Surveying" THEN requisitions_items.quantity ELSE 0 END) as surveying_item_quantity'),
                DB::raw('SUM(CASE WHEN requisitions.category = "Fluids" THEN requisitions_items.quantity ELSE 0 END) as fluid_item_quantity'),
                DB::raw('SUM(CASE WHEN requisitions.category = "ComputerEngineering" THEN requisitions_items.quantity ELSE 0 END) as computer_engineering_item_quantity'),
                'construction.quantity as construction_actual_quantity',
                'testings.quantity as testing_actual_quantity',
                'surveyings.quantity as surveying_actual_quantity',
                'fluid.quantity as fluid_actual_quantity',
                'computer_engineering.quantity as computer_engineering_actual_quantity'
            )
            ->groupBy(
                'requisitions.id',
                'requisitions.category',
                'requisitions.date_time_filed',
                'requisitions.date_time_needed',
                'requisitions.instructor_id',
                'requisitions.subject',
                'requisitions.course_year',
                'requisitions.activity',
                'requisitions.status',
                'requisitions.dean_signature',
                'requisitions.labtext_signature',
                'requisitions.received_date',
                'requisitions.returned_date',
                'requisitions.issued_date',
                'requisitions.checked_date',
                'requisitions.created_at',
                'requisitions.updated_at',
                'users.name',
                'construction.quantity',
                'testings.quantity',
                'surveyings.quantity',
                'fluid.quantity',
                'computer_engineering.quantity'
            )
            ->get();


        /**
         * @var App\Models\User;
         */
        $user = Auth::user();

        // dd($requisitions);
        if ($user->hasRole('laboratory')) {
            return view('laboratory.transaction.index', compact('teacherborrows', 'notifications', 'requisitions'));
        } else {
            return view('superadmin.transactions', compact('teacherborrows', 'notifications', 'requisitions'));
        }
    }

    public function dean_index()
    {
        $teacherborrows = TeacherBorrow::all();
        $notifications = Auth::user()->notifications;

        $requisitions = DB::table('requisitions')
            ->leftJoin('requisitions_items', 'requisitions.id', '=', 'requisitions_items.requisition_id')

            ->leftJoin('construction', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'Constructions'"))
                    ->on('requisitions_items.equipment_id', '=', 'construction.id');
            })
            ->leftJoin('testings', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'Testings'"))
                    ->on('requisitions_items.equipment_id', '=', 'testings.id');
            })
            ->leftJoin('surveyings', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'Surveying'"))
                    ->on('requisitions_items.equipment_id', '=', 'surveyings.id');
            })
            ->leftJoin('fluid', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'Fluids'"))
                    ->on('requisitions_items.equipment_id', '=', 'fluid.id');
            })
            ->leftJoin('computer_engineering', function ($join) {
                $join->on('requisitions.category', '=', DB::raw("'ComputerEngineering'"))
                    ->on('requisitions_items.equipment_id', '=', 'computer_engineering.id');
            })

            ->leftJoin('users', 'requisitions.instructor_id', '=', 'users.id')

            ->select(
                'requisitions.id',
                'requisitions.category',
                'requisitions.date_time_filed',
                'requisitions.date_time_needed',
                'requisitions.instructor_id',
                'requisitions.subject',
                'requisitions.course_year',
                'requisitions.activity',
                'requisitions.status',
                'requisitions.dean_signature',
                'requisitions.labtext_signature',
                'requisitions.received_date',
                'requisitions.returned_date',
                'requisitions.issued_date',
                'requisitions.checked_date',
                'requisitions.created_at',
                'requisitions.updated_at',
                'users.name as instructor_name',

                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Construction" THEN construction.equipment END) as construction_equipment'),
                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Testings" THEN testings.equipment END) as testing_equipment'),
                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Surveying" THEN surveyings.equipment END) as surveying_equipment'),
                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "Fluids" THEN fluid.equipment END) as fluid_equipment'),
                DB::raw('GROUP_CONCAT(DISTINCT CASE WHEN requisitions.category = "ComputerEngineering" THEN computer_engineering.equipment END) as computer_engineering_equipment'),

                DB::raw('SUM(CASE WHEN requisitions.category = "Construction" THEN requisitions_items.quantity ELSE 0 END) as construction_item_quantity'),
                DB::raw('SUM(CASE WHEN requisitions.category = "Testings" THEN requisitions_items.quantity ELSE 0 END) as testing_item_quantity'),
                DB::raw('SUM(CASE WHEN requisitions.category = "Surveying" THEN requisitions_items.quantity ELSE 0 END) as surveying_item_quantity'),
                DB::raw('SUM(CASE WHEN requisitions.category = "Fluids" THEN requisitions_items.quantity ELSE 0 END) as fluid_item_quantity'),
                DB::raw('SUM(CASE WHEN requisitions.category = "ComputerEngineering" THEN requisitions_items.quantity ELSE 0 END) as computer_engineering_item_quantity')
            )
            ->groupBy(
                'requisitions.id',
                'requisitions.category',
                'requisitions.date_time_filed',
                'requisitions.date_time_needed',
                'requisitions.instructor_id',
                'requisitions.subject',
                'requisitions.course_year',
                'requisitions.activity',
                'requisitions.status',
                'requisitions.dean_signature',
                'requisitions.labtext_signature',
                'requisitions.received_date',
                'requisitions.returned_date',
                'requisitions.issued_date',
                'requisitions.checked_date',
                'requisitions.created_at',
                'requisitions.updated_at',
                'users.name'
            )
            ->get();
        return view('dean.transaction.index', compact('teacherborrows', 'notifications', 'requisitions'));
    }

    public function retrieve($id)
    {
        $requisition = DB::table('requisitions')
            ->leftJoin('requisitions_items', 'requisitions.id', '=', 'requisitions_items.requisition_id')
            ->leftJoin('users', 'requisitions.instructor_id', '=', 'users.id')
            ->where('requisitions.id', $id)
            ->select(
                'requisitions.id',
                'requisitions.category',
                'requisitions.date_time_filed',
                'requisitions.date_time_needed',
                'requisitions.instructor_id',
                'requisitions.subject',
                'requisitions.course_year',
                'requisitions.activity',
                'requisitions.status',
                'requisitions.dean_signature',
                'requisitions.labtext_signature',
                'requisitions.received_date',
                'requisitions.returned_date',
                'requisitions.issued_date',
                'requisitions.checked_date',
                'requisitions.created_at',
                'requisitions.updated_at',
                'users.name as instructor_name'
            )
            ->first();

        $items = DB::table('requisitions_items')
            ->where('requisition_id', $id)
            ->select('*')
            ->get();
        $equipment_ids = $items->pluck('equipment_id');
        $item_details = $this->getItemsByCategory($requisition->category, $equipment_ids);

        $students = DB::table('requisitions_items_students')
            ->where('requisition_id', $id)
            ->get();

        $data = [
            'requisition' => $requisition,
            'items' => $items,
            'item_details' => $item_details,
            'students' => $students,
        ];



        return view('laboratory.transaction.details', compact('data'));
    }

    public function show_data($id)
    {
        $requisition = DB::table('requisitions')
            ->leftJoin('requisitions_items', 'requisitions.id', '=', 'requisitions_items.requisition_id')
            ->leftJoin('users', 'requisitions.instructor_id', '=', 'users.id')
            ->where('requisitions.id', $id)
            ->select(
                'requisitions.id',
                'requisitions.category',
                'requisitions.date_time_filed',
                'requisitions.date_time_needed',
                'requisitions.instructor_id',
                'requisitions.subject',
                'requisitions.course_year',
                'requisitions.activity',
                'requisitions.status',
                'requisitions.dean_signature',
                'requisitions.labtext_signature',
                'requisitions.received_date',
                'requisitions.returned_date',
                'requisitions.issued_date',
                'requisitions.checked_date',
                'requisitions.created_at',
                'requisitions.updated_at',
                'users.name as instructor_name'
            )
            ->first();

        $items = DB::table('requisitions_items')
            ->where('requisition_id', $id)
            ->select('equipment_id', 'quantity', 'remarks')
            ->get();

        $equipment_ids = $items->pluck('equipment_id');
        $item_details = $this->getItemsByCategory($requisition->category, $equipment_ids);

        $students = DB::table('requisitions_items_students')
            ->where('requisition_id', $id)
            ->get();

        $data = [
            'requisition' => $requisition,
            'items' => $items,
            'item_details' => $item_details,
            'students' => $students,
        ];

        return view('dean.transaction.details', compact('data'));
    }


    protected function getItemsByCategory($category, $equipment_ids)
    {
        switch ($category) {
            case 'Constructions':
                return DB::table('construction')
                    ->whereIn('id', $equipment_ids)
                    ->get();
            case 'Testings':
                return DB::table('testings')
                    ->whereIn('id', $equipment_ids)
                    ->get();
            case 'Surveying':
                return DB::table('surveyings')
                    ->whereIn('id', $equipment_ids)
                    ->get();
            case 'Fluids':
                return DB::table('fluid')
                    ->whereIn('id', $equipment_ids)
                    ->get();
            case 'ComputerEngineering':
                return DB::table('computer_engineering')
                    ->whereIn('id', $equipment_ids)
                    ->get();
            default:
                return collect();
        }
    }

    protected function getStudentsByRequisitionId($id)
    {
        return DB::table('requisitions_items_students')
            ->join('requisitions', 'requisitions_items_students.requisition_id', '=', 'requisitions.id')
            ->select(
                'requisitions_items_students.student_name',
                'requisitions.course_year',
                'requisitions.status'
            )
            ->where('requisitions_items_students.requisition_id', $id)
            ->get();
    }

    public function decision(Request $request)
    {
        $deanUsers = User::role('dean')->get();
        $validated = $request->validate([
            'requisition_id' => 'required|integer',
            'signature' => 'nullable',
            'feedback' => 'string|nullable'
        ]);


        if (!empty($validated['feedback'])) {
            $data = Requisition::find($request->requisition_id);
            $data->status = 'Declined';
            $data->reason_for_decline = $validated['feedback'];
            $data->save();

            $userFromRequest = User::find($data->instructor_id);
            // dd($userFromRequest);
            $userFromRequest->notify(new RequisitionDecisionNotification($data,  $data->reason_for_decline));
            foreach ($deanUsers as $dean) {
                $dean->notify(new RequisitionDecisionNotification($data, 'Declined by our Dean'));
            }
            return redirect()->back()->with('message', 'Requisition has been declined.');
        }

        $signatureData = $validated['signature'];

        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);

        $signature = base64_decode($signatureData);

        $fileName = 'signature_' . time() . '.png';

        $filePath = public_path('signatures/' . $fileName);

        file_put_contents($filePath, $signature);

        $data = Requisition::find($request->requisition_id);
        $data->labtext_signature = 'signatures/' . $fileName;
        $data->status = 'Approved and Prepared';
        $data->save();
        foreach ($deanUsers as $dean) {
            $dean->notify(new RequisitionDecisionNotification($data, 'Laboratory has Approved and Prepared a requisition request.'));
        }
        return redirect()->back()->with('message', 'Requisition has been approved');
    }


    public function dean_decision(Request $request)
    {
        $validated = $request->validate([
            'requisition_id' => 'required|integer',
            'signature' => 'nullable',
        ]);

        $signatureData = $validated['signature'];

        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);

        $signature = base64_decode($signatureData);

        $fileName = 'signature_' . time() . '.png';

        $filePath = public_path('signatures/' . $fileName);

        file_put_contents($filePath, $signature);

        $data = Requisition::find($request->requisition_id);
        $data->dean_signature = 'signatures/' . $fileName;
        $data->status = 'Accepted by Dean';
        $data->save();


        // $requisitionItems = RequisitionsItems::where('requisition_id', $data->id)->first();
        // switch ($request->input('category')) {
        //     case 'Constructions':
        //         $requisitionItemFound = Construction::find($requisitionItems->equipment_id)->first();
        //         $requisitionItemFound->quantity -= $requisitionItems->quantity;
        //         $requisitionItemFound->save();
        //         break;
        //     case 'Testings':
        //         $requisitionItemFound = Testing::find($requisitionItems->equipment_id)->first();
        //         $requisitionItemFound->quantity -= $requisitionItems->quantity;
        //         $requisitionItemFound->save();
        //         break;
        //     case 'ComputerEngineering':
        //         $requisitionItemFound = ComputerEngineering::find($requisitionItems->equipment_id)->first();
        //         $requisitionItemFound->quantity -= $requisitionItems->quantity;
        //         $requisitionItemFound->save();
        //         break;
        //     case 'Fluids':
        //         $requisitionItemFound = Fluid::find($requisitionItems->equipment_id)->first();
        //         $requisitionItemFound->quantity -= $requisitionItems->quantity;
        //         $requisitionItemFound->save();
        //         break;
        //     case 'Surveyings':
        //         $requisitionItemFound = Surveying::find($requisitionItems->equipment_id)->first();
        //         $requisitionItemFound->quantity -= $requisitionItems->quantity;
        //         $requisitionItemFound->save();
        //         break;

        //     default:
        //         dd("No Model Found for the {$request->input('category')}");
        //         break;
        // }

        $laboratoryUsers = User::role(['laboratory', 'user'])->get();
        foreach ($laboratoryUsers as $user) {
            $user->notify(new DeanRequisitionDecisionNotification($data));
        }

        return redirect()->back()->with('message', 'Requisition has been approved');
    }


    public function return_damaged(Request $request)
    {
        $data = Requisition::find($request->input('id'));
        $requisitionItems = RequisitionsItems::where('requisition_id', $data->id)->first();
        $models = [
            'Constructions' => Construction::class,
            'Testings' => Testing::class,
            'ComputerEngineering' => ComputerEngineering::class,
            'Fluids' => Fluid::class,
            'Surveyings' => Surveying::class,
        ];

        if (!isset($models[$data->category])) {
            return response()->json(['error' => "No model found for {$data->category}"], 400);
        }

        $modelClass = $models[$data->category];
        $requisitionItem = $modelClass::find($requisitionItems->equipment_id);

        if (!$requisitionItem) {
            return response()->json(['error' => "Item not found for {$data->category}"], 404);
        }

        if ($request->input('status') === "Received") {
            $data->status = "Received";
            $requisitionItem->quantity -= $requisitionItems->quantity;
            $requisitionItem->save();
        }

        if ($request->input('status') === "Returned" || $request->input('status') === "Repaired") {
            $data->status = "Returned";
            $requisitionItem->quantity += $requisitionItems->quantity;
            $data->returned_date = now();
            $requisitionItem->save();
        }

        if ($request->input('status') === "Damaged") {
            $data->status = "Damaged";
            $requisitionItem->save();
        }


        if ($request->input('status') === "XXX") {
            $data->status = "XXX";
            $requisitionItem->save();
        }


        $data->save();


        return response()->json(['success' => true]);
    }



    public function approve($id)
    {
        $teacherborrow = TeacherBorrow::find($id);

        $construction = Construction::where('item', $teacherborrow->item)->first();
        $testing = Testing::where('item', $teacherborrow->item)->first();
        $surveying = Surveying::where('item', $teacherborrow->item)->first();
        $fluid = Fluid::where('item', $teacherborrow->item)->first();
        $computer = ComputerEngineering::where('item', $teacherborrow->item)->first();

        if ($construction && $construction->quantity >= $teacherborrow->quantity) {
            $construction->quantity -= $teacherborrow->quantity;
            $construction->save();
        } elseif ($testing && $testing->quantity >= $teacherborrow->quantity) {
            $testing->quantity -= $teacherborrow->quantity;
            $testing->save();
        } elseif ($surveying && $surveying->quantity >= $teacherborrow->quantity) {
            $surveying->quantity -= $teacherborrow->quantity;
            $surveying->save();
        } elseif ($fluid && $fluid->quantity >= $teacherborrow->quantity) {
            // Update the equipment quantity
            $fluid->quantity -= $teacherborrow->quantity;
            $fluid->save();
        } elseif ($computer && $computer->quantity >= $teacherborrow->quantity) {
            // Update the equipment quantity
            $computer->quantity -= $teacherborrow->quantity;
            $computer->save();
        } else {
            // Return an error message if the quantity is insufficient
            return back()->with('error', 'Insufficient quantity available for the requested item.');
        }

        // Approve the transaction
        $teacherborrow->status = 'approved';
        $teacherborrow->save();

        // Remove the corresponding notification from the session
        $this->removeNotificationByTransactionId($id);

        return back()->with('success', 'Request approved successfully!');
    }

    private function removeNotificationByTransactionId($transactionId)
    {
        $notifications = session('notifications', []);

        foreach ($notifications as $index => $notification) {
            if (isset($notification['transaction_id']) && $notification['transaction_id'] == $transactionId) {
                unset($notifications[$index]);
                break;
            }
        }

        session(['notifications' => $notifications]);
    }

    public function disapprove($id)
    {
        $teacherborrow = TeacherBorrow::find($id);
        $teacherborrow->status = 'disapproved';
        $teacherborrow->save();

        // Remove the corresponding notification from the session
        $this->removeNotificationByTransactionId($id);

        return back()->with('success', 'Request disapproved successfully!');
    }

    public function returned($id)
    {
        $teacherborrow = TeacherBorrow::find($id);

        if ($teacherborrow->status == 'returned') {
            return back()->with('error', 'This item has already been marked as returned.');
        }

        $teacherborrow->status = 'returned';
        $teacherborrow->datetime_returned = Carbon::now();
        $teacherborrow->days_not_returned = Carbon::now()->diffInDays($teacherborrow->datetime_borrowed);
        $teacherborrow->save();

        // Fetch the item from the supplies or equipment table
        $construction = Construction::where('item', $teacherborrow->item)->first();
        $testing = Testing::where('item', $teacherborrow->item)->first();
        $surveying = Surveying::where('item', $teacherborrow->item)->first();
        $fluid = Fluid::where('item', $teacherborrow->item)->first();
        $computer = ComputerEngineering::where('item', $teacherborrow->item)->first();

        if ($construction) {
            // Update the supply quantity
            $construction->quantity += $teacherborrow->quantity;
            $construction->save();
        } elseif ($testing) {
            // Update the equipment quantity
            $testing->quantity += $teacherborrow->quantity;
            $testing->save();
        } elseif ($surveying) {
            // Update the equipment quantity
            $surveying->quantity += $teacherborrow->quantity;
            $surveying->save();
        } elseif ($fluid) {
            // Update the equipment quantity
            $fluid->quantity += $teacherborrow->quantity;
            $fluid->save();
        } elseif ($computer) {
            // Update the equipment quantity
            $computer->quantity += $teacherborrow->quantity;
            $computer->save();
        }

        return back()->with('success', 'Item marked as returned successfully!');
    }

    public function damaged($id)
    {
        $teacherborrow = TeacherBorrow::find($id);

        if ($teacherborrow->status == 'damaged') {
            return back()->with('error', 'This item has already been marked as damaged.');
        }

        $teacherborrow->status = 'damaged';
        $teacherborrow->datetime_returned = Carbon::now();
        $teacherborrow->days_not_returned = Carbon::now()->diffInDays($teacherborrow->datetime_borrowed);
        $teacherborrow->save();

        // Create a notification
        $notification = [
            'type' => 'damaged',
            'transaction_id' => $teacherborrow->id,
            'user_name' => $teacherborrow->user_name,
            'item' => $teacherborrow->item,
            'quantity' => $teacherborrow->quantity,
            'unit' => $teacherborrow->unit, // Ensure 'unit' is a valid field or replace it with the correct field
            'date_returned' => Carbon::parse($teacherborrow->datetime_returned)
        ];

        session()->push('notifications', $notification);

        return back()->with('success', 'Item marked as damaged successfully!');
    }


    public function getChartData()
    {
        $categories = Requisition::select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get();

        $data = $categories->pluck('count', 'category');

        return response()->json($data);
    }


    public function offcieChartData()
    {
        $officeRequests = OfficeRequest::select('item_type', DB::raw('count(*) as count'))
            ->groupBy('item_type')
            ->get();

        $data = $officeRequests->pluck('count', 'item_type');

        return response()->json($data);
    }
}
