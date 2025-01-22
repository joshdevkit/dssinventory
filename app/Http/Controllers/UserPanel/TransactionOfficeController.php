<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\BorrowedEquipment;
use Illuminate\Http\Request;
use App\Models\TransactionOffice;
use App\Models\Equipment;
use App\Models\EquipmentItems;
use App\Models\OfficeRequest;
use App\Models\Supplies;
use App\Models\User;
use App\Notifications\BorrowerNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransactionStatusNotification;
use App\Notifications\UserNotifications;
use Illuminate\Support\Facades\DB;

class TransactionOfficeController extends Controller
{
    public function selectCategory(Request $request)
    {
        $category = $request->input('category');

        if ($category === 'equipments') {
            $items = Equipment::with('items')->get()->map(function ($equipment) {
                $nonQueuedItems = $equipment->items->filter(function ($item) {
                    return $item->status !== 'Queue';
                });
                return [
                    'id' => $equipment->id,
                    'item' => $equipment->item,
                    'count' => $nonQueuedItems->count(),
                ];
            })->toArray();
        } elseif ($category === 'supplies') {
            $items = Supplies::with('items')->get()->map(function ($equipment) {
                return [
                    'id' => $equipment->id,
                    'item' => $equipment->item,
                    'count' => $equipment->quantity,
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
        $supplies = Supplies::with('items')->get();
        $user = Auth::user();
        $equipments = Equipment::with('items')->get();
        return view('profile.office_user.create', compact('supplies', 'equipments', 'user'));
    }





    public function store(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.item_id' => 'required',
            'purpose' => 'required|string',
            'category' => 'required|string',
        ]);

        if ($data['category'] === 'Supplies') {
            foreach ($request->input('items') as $item) {
                OfficeRequest::create([
                    'item_id' => $item['item_id'],
                    'item_type' => $request->input('category'),
                    'quantity_requested' => $item['quantity'],
                    'requested_by' => Auth::id(),
                    'purpose' => $request->input('purpose'),
                ]);
            }
        }

        if ($data['category'] === 'Equipments') {

            $officeRequest = OfficeRequest::create([
                'item_type' => $request->input('category'),
                'quantity_requested' =>  count($request->input('items')),
                'requested_by' => Auth::id(),
                'purpose' => $request->input('purpose'),
            ]);

            foreach ($request->input('items') as $index => $item) {
                $item_id = $item['item_id'];

                $serialsKey = 'serial-' . $index;
                $serials = $request->input($serialsKey);

                if ($serials && is_array($serials)) {
                    foreach ($serials as $serial) {

                        $itemsSerialData = EquipmentItems::where('id', $serial)->first();
                        $itemsSerialData->status = 'Queue';
                        $itemsSerialData->save();

                        BorrowedEquipment::create([
                            'office_requests_id' => $officeRequest->id,
                            'item_id' => $item_id,
                            'equipment_serial_id' => $serial,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('office_user.create')->with('success', 'Request submitted successfully!');
    }

    public function index()
    {
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
            ->orderBy('created_at', 'DESC')
            ->get();


        /**
         * @var App\Models\User;
         */
        // dd($requests);
        $user = Auth::user();
        if ($user->hasRole('site secretary')) {
            return view('office.transactions.index', compact('requests'));
        } else if ($user->hasRole('superadmin')) {
            return view('superadmin.site-transactions', compact('requests'));
        } else {
            return view('dean.site-transactions', compact('requests'));
        }
    }

    public function details($id)
    {
        $request = DB::table('office_requests')
            ->where('id', $id)
            ->select('item_type')
            ->first();

        if ($request && $request->item_type === 'Equipments') {
            $requestDetails = DB::table('office_requests')
                ->leftJoin('borrowed_equipment', 'office_requests.id', '=', 'borrowed_equipment.office_requests_id')
                ->leftJoin('equipment_items', 'borrowed_equipment.equipment_serial_id', '=', 'equipment_items.id')
                ->leftJoin('equipment', 'borrowed_equipment.item_id', '=', 'equipment.id')
                ->where('office_requests.id', $id)
                ->select(
                    'office_requests.*',
                    'equipment.item as equipment_item',
                    'borrowed_equipment.item_id',
                    'borrowed_equipment.equipment_serial_id',
                    'equipment_items.serial_no as equipment_serial',
                    'equipment_items.status as equipment_status',
                    'equipment_items.note as equipment_notes'
                )
                ->get();

            return response()->json($requestDetails);
            // dd($requestDetails);
        }
        // return view('office.transactions.details', compact('requestDetails'));
    }

    public function view_details($id)
    {
        $request = DB::table('office_requests')
            ->where('id', $id)
            ->select('item_type')
            ->first();

        if ($request && $request->item_type === 'Equipments') {
            $requestDetails = DB::table('office_requests')
                ->leftJoin('borrowed_equipment', 'office_requests.id', '=', 'borrowed_equipment.office_requests_id')
                ->leftJoin('equipment_items', 'borrowed_equipment.equipment_serial_id', '=', 'equipment_items.id')
                ->leftJoin('equipment', 'borrowed_equipment.item_id', '=', 'equipment.id')
                ->where('office_requests.id', $id)
                ->select(
                    'office_requests.*',
                    'equipment.item as equipment_item',
                    'borrowed_equipment.item_id',
                    'borrowed_equipment.equipment_serial_id',
                    'equipment_items.serial_no as equipment_serial',
                    'equipment_items.note as equipment_notes'

                )
                ->get();

            // dd($requestDetails);
        }
        return view('office.transactions.details', compact('requestDetails'));
    }

    public function decisions(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:office_requests,id',
            'status' => 'required|string|in:Approved,Declined,Received,Returned,Not Returned,Damaged,Repaired,XXX',
        ]);

        $requestItem = OfficeRequest::findOrFail($request->id);
        if ($requestItem->item_type === "Equipments") {
            $borrowedEquipment = BorrowedEquipment::with('items')->where('office_requests_id', $request->id)->get();
            $initialItems = [];
            $intialItemname = "";
            $itemType = $requestItem->item_type;

            foreach ($borrowedEquipment as $item) {
                $initialItems[] = $item->equipment_serial_id;
                $intialItemname = $item->item;
            }
            if ($requestItem->status === "Pending") {
                $requestItem->status = $request->status;
                $requestItem->save();

                if (in_array($request->status, ['Approved', 'Declined', 'Received', 'Returned', 'Not Returned', 'Damaged', 'Repaired', 'XXX'])) {
                    $usersWithRole = User::role('user')->where('id', $requestItem->requested_by)->get();
                    $message = "The {$itemType}\n'{$intialItemname}' has been {$requestItem->status}.";
                    Notification::send($usersWithRole, new UserNotifications($message, $initialItems, $itemType));
                }
            }

            if ($requestItem->status === "Approved") {
                $requestItem->status = $request->status;
                $requestItem->save();
            }

            if ($requestItem->status === "Received") {
                $requestItem->status = $request->status;
                $requestItem->save();
            }


            return response()->json(['message' => 'Status updated successfully!'], 200);
        } else if ($requestItem->item_type === "Supplies") {
            $requestItem = OfficeRequest::findOrFail($request->id);
            $itemType = $requestItem->item_type;
            $itemId = $requestItem->item_id;
            $quantityRequested = $requestItem->quantity_requested;

            $item = Supplies::findOrFail($itemId);
            $itemName = $item->item;
            if ($request->status === 'Approved') {
                $requestItem->status = $request->status;
                $requestItem->save();
            } else if ($request->status === 'Received') {
                $requestItem->status = "Received";
                $item->quantity -= $quantityRequested;
                $item->save();
                $requestItem->save();
            }

            if (in_array($request->status, ['Approved', 'Declined', 'Received', 'Returned', 'Not Returned', 'Damaged', 'Repaired', 'XXX'])) {
                $usersWithRole = User::role('user')->where('id', $requestItem->requested_by)->get();
                $message = "The {$itemType}\n'{$itemName}' has been {$requestItem->status}.";
                Notification::send($usersWithRole, new UserNotifications($message, $itemId, $itemType));
            }

            return response()->json(['message' => 'Status updated successfully!'], 200);
        }


        // try {
        //     $requestItem = OfficeRequest::findOrFail($request->id);
        //     $itemType = $requestItem->item_type;
        //     $itemId = $requestItem->item_id;
        //     $quantityRequested = $requestItem->quantity_requested;
        //     $requestItemStataus = $requestItem->status;
        //     if ($requestItem->status === 'Approved' && $request->status === 'Received') {
        //         $requestItem->status = 'Received';
        //     } elseif (in_array($request->status, ['Approved', 'Declined', 'Returned', 'Not Returned', 'Damaged', 'Repaired', 'XXX'])) {
        //         $requestItem->status = $request->status;
        //     } else {
        //         return response()->json(['error' => 'Invalid status transition'], 400);
        //     }

        //     $item = null;
        //     $itemName = '';

        //     switch ($itemType) {
        //         case 'Supplies':
        //             $item = Supplies::findOrFail($itemId);
        //             $itemName = $item->item;
        //             if ($request->status === 'Approved') {
        //                 $requestItemStataus = 'Approved';
        //                 $item->save();
        //             } else if ($request->status  === 'Received') {
        //                 $item->quantity -= $quantityRequested;
        //             }
        //             $item->save();
        //             break;

        //         case 'Equipments':
        //             $item = Equipment::findOrFail($itemId);
        //             $itemName = $item->item;
        //             if ($request->status === 'Returned') {
        //                 $item->quantity += $quantityRequested;
        //             } else if ($request->status === 'Received') {
        //                 $item->quantity -= $quantityRequested;
        //             } elseif ($request->status === 'Damaged') {
        //                 $item->save();
        //             } elseif ($request->status === 'Repaired') {
        //                 $item->quantity += $quantityRequested;
        //             } elseif ($request->status === 'XXX') {
        //                 $item->save();
        //             } elseif ($request->status === 'Approved') {
        //                 $item->save();
        //             } else {
        //                 $item->save();
        //             }
        //             $item->save();
        //             break;

        //         default:
        //             return response()->json(['error' => 'Invalid item type'], 400);
        //     }

        //     $requestItem->save();

        //     if (in_array($request->status, ['Approved', 'Declined', 'Received', 'Returned', 'Not Returned', 'Damaged', 'Repaired', 'XXX'])) {
        //         $usersWithRole = User::role('user')->where('id', $requestItem->requested_by)->get();
        //         $message = "The {$itemType}\n'{$itemName}' has been {$requestItem->status}.";
        //         Notification::send($usersWithRole, new UserNotifications($message, $itemId, $itemType));
        //     }

        //     return response()->json(['message' => 'Status updated successfully!'], 200);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'Unable to update status', 'message' => $e->getMessage()], 500);
        // }
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
        $transaction = TransactionOffice::find($id);
        $transaction->status = 'disapproved';
        $transaction->save();

        // Remove the corresponding notification from the session
        $this->removeNotificationByTransactionId($id);

        return back()->with('success', 'Request disapproved successfully!');
    }

    public function returned($id)
    {
        $transaction = TransactionOffice::find($id);

        if ($transaction->status == 'returned') {
            return back()->with('error', 'This item has already been marked as returned.');
        }

        $transaction->status = 'returned';
        $transaction->datetime_returned = Carbon::now();
        $transaction->days_not_returned = Carbon::now()->diffInDays($transaction->datetime_borrowed);
        $transaction->save();

        // Fetch the item from the supplies or equipment table
        $supply = Supplies::where('item', $transaction->item)->first();
        $equipment = Equipment::where('item', $transaction->item)->first();

        if ($supply) {
            // Update the supply quantity
            $supply->quantity += $transaction->quantity;
            $supply->save();
        } elseif ($equipment) {
            // Update the equipment quantity
            $equipment->quantity += $transaction->quantity;
            $equipment->save();
        }

        return back()->with('success', 'Item marked as returned successfully!');
    }

    public function damaged($id)
    {
        $transaction = TransactionOffice::find($id);

        if ($transaction->status == 'damaged') {
            return back()->with('error', 'This item has already been marked as damaged.');
        }

        $transaction->status = 'damaged';
        $transaction->datetime_returned = Carbon::now();
        $transaction->days_not_returned = Carbon::now()->diffInDays($transaction->datetime_borrowed);
        $transaction->save();

        // Create a notification
        $notification = [
            'type' => 'damaged',
            'transaction_id' => $transaction->id,
            'user_name' => $transaction->user_name,
            'item' => $transaction->item,
            'quantity' => $transaction->quantity,
            'unit' => $transaction->unit, // Ensure 'unit' is a valid field or replace it with the correct field
            'date_returned' => Carbon::parse($transaction->datetime_returned)
        ];

        session()->push('notifications', $notification);

        return back()->with('success', 'Item marked as damaged successfully!');
    }


    public function notifyBorrower(Request $request)
    {
        $request->validate([
            'request_ids' => 'required|array',
            'request_ids.*' => 'integer|exists:office_requests,id',
        ]);

        foreach ($request->request_ids as $requestId) {
            $requestRecord = \App\Models\OfficeRequest::with('equipment')->findOrFail($requestId);

            if ($requestRecord->is_notified == 1 || $requestRecord->item_type !== 'Equipments') {
                continue;
            }

            $equipmentItem = $requestRecord->equipment->item;

            $borrower = \App\Models\User::findOrFail($requestRecord->requested_by);
            $message = "Your borrowed equipment '{$equipmentItem}' has exceeded the allowed return period. Please return it immediately.";
            $borrower->notify(new \App\Notifications\BorrowerNotification($message));

            $requestRecord->update(['is_notified' => 1]);
        }

        return response()->json(['message' => 'Borrowers notified successfully.']);
    }


    public function selectedItems($id)
    {
        $equipmentItems = EquipmentItems::where('equipment_id', $id)
            ->where('status', '!=', 'Queue')
            ->get();
        return response()->json($equipmentItems);
    }


    public function submitAddedNotes(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer|exists:equipment_items,id',
            'notes' => 'required|string',
        ]);

        $itemToBeMarkAsDamaged = EquipmentItems::find($validated['item_id']);
        $itemToBeMarkAsDamaged->note = $validated['notes'];
        $itemToBeMarkAsDamaged->save();

        return response()->json(['message' => 'Item marked as damaged successfully!', "sucess" => true]);
    }


    public function submitGoodCondition(Request $request)
    {
        $validated = $request->validate([
            'selected_items' => 'required|array',
            'selected_items.*' => 'exists:equipment_items,id',
        ]);

        foreach ($validated['selected_items'] as $itemId) {
            $equipmentItem = EquipmentItems::find($itemId);
            $equipmentItem->status = 'Good';
            $equipmentItem->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Items marked as good condition successfully.']);
    }
}
