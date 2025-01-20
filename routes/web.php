<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPanel\UserController;
use App\Http\Controllers\UserPanel\TransactionOfficeController;
use App\Http\Controllers\UserPanel\TransactionOfficeController as AdminSiteOffice;

use App\Http\Controllers\UserPanel\TeacherborrowController;
use App\Http\Controllers\UserPanel\NotificationController;
use App\Http\Controllers\UserPanel\Office_UserController;
use App\Http\Controllers\OfficePanel\OfficeController;
use App\Http\Controllers\OfficePanel\CalendaroController;
use App\Http\Controllers\OfficePanel\SuppliesController;
use App\Http\Controllers\OfficePanel\EquipmentController;
use App\Http\Controllers\DeanPanel\DeanController;
use App\Http\Controllers\LaboratoryPanel\LaboratoryController;
use App\Http\Controllers\LaboratoryPanel\ComputerEngineeringController;
use App\Http\Controllers\LaboratoryPanel\ConstructionController;
use App\Http\Controllers\LaboratoryPanel\FluidController;
use App\Http\Controllers\LaboratoryPanel\SurveyingController;
use App\Http\Controllers\LaboratoryPanel\TestingController;
use App\Http\Controllers\LaboratoryPanel\CalendarController;
use App\Http\Controllers\DeanPanel\DComputerController;
use App\Http\Controllers\DeanPanel\DConstructionController;
use App\Http\Controllers\DeanPanel\DFluidController;
use App\Http\Controllers\DeanPanel\DSurveyingController;
use App\Http\Controllers\DeanPanel\DTestingController;
use App\Http\Controllers\DeanPanel\DEquipmentController;
use App\Http\Controllers\DeanPanel\DSuppliesController;
use App\Http\Controllers\OfficeRequisitionController;
use App\Http\Controllers\SuperAdminPanel\SComputerController;
use App\Http\Controllers\SuperAdminPanel\SConstructionController;
use App\Http\Controllers\SuperAdminPanel\SFluidController;
use App\Http\Controllers\SuperAdminPanel\SSurveyingController;
use App\Http\Controllers\SuperAdminPanel\STestingController;
use App\Http\Controllers\SuperAdminPanel\SEquipmentController;
use App\Http\Controllers\SuperAdminPanel\SSuppliesController;
use App\Http\Controllers\SuperAdminPanel\SuperadminController;
use App\Http\Controllers\SuperAdminPanel\UserManagementController;




Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('change-password', AccountController::class);
});



Route::middleware(['auth', 'role:site secretary'])->group(function () {

    Route::get('office/dashboard', [OfficeController::class, 'index'])->name('office.dashboardo');
    Route::resource('/supplies', SuppliesController::class);
    Route::resource('equipment', EquipmentController::class);
    Route::get('/office/supplies', [SuppliesController::class, 'index'])->name('supplies.index');
    Route::get('/office/equipment', [EquipmentController::class, 'index'])->name('site.equipment.index');
    Route::get('office/calendaro', [CalendaroController::class, 'index'])->name('office.calendaro');
    Route::get('/office/transactions', [TransactionOfficeController::class, 'index'])->name('office-admin.transactions');
    Route::post('site-office/transactions/update', [TransactionOfficeController::class, 'decisions'])->name('office.transaction-update');
    Route::post('/office/transactions/{id}/disapprove', [TransactionOfficeController::class, 'disapprove'])->name('office.transactions.disapprove');
    Route::post('/office/transactions/{id}/returned', [TransactionOfficeController::class, 'returned'])->name('office.transactions.returned');
    Route::post('/office/transactions/{id}/damaged', [TransactionOfficeController::class, 'damaged'])->name('office.transactions.damaged');
    Route::get('/office/supplies', [SuppliesController::class, 'index'])->name('office-supplies');
    Route::post('office/notify-borrower', [TransactionOfficeController::class, 'notifyBorrower'])->name('notify.user');

    //chart
    Route::get('/office/requisitions/chart', [TeacherborrowController::class, 'getChartData'])->name('office.requisitions.chart');
    Route::get('/office/chart', [TeacherborrowController::class, 'offcieChartData'])->name('site-office.chart');

    Route::post('office/low-stock-notification', [SuppliesController::class, 'sendLowStockNotification'])->name('office.low-stock.notification');

    Route::post('office/notifications/{notification}/read', function ($notification) {
        /**
         * @var App\Models\User;
         */
        $user = auth()->user();
        $notification = $user->notifications()->find($notification);
        $notification->markAsRead();
        return response()->json(['message' => 'Notification marked as read']);
    });

    Route::post('office/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['message' => 'All notifications marked as read']);
    });

    Route::get('/office/requisition', [OfficeRequisitionController::class, 'requisitions'])->name('office.requisition');
    Route::get('/office/all-requisition-request', [OfficeRequisitionController::class, 'forUser'])->name('office.requisition.request');
    Route::post('/office/requisition', [OfficeRequisitionController::class, 'getRequisitions'])->name('office.requisition.post');
    Route::get('/office/print-record/{id}', [OfficeRequisitionController::class, 'print'])->name('print-record');
});

Route::middleware(['auth', 'role:laboratory'])->group(function () {
    Route::get('laboratory/dashboardo', [LaboratoryController::class, 'index'])->name('laboratory.dashboardo');
    Route::resource('laboratory-computer-engineering', ComputerEngineeringController::class);
    Route::resource('constructions', ConstructionController::class);
    Route::resource('fluids', FluidController::class);
    Route::resource('surveyings', SurveyingController::class);
    Route::get('/surveying', [SurveyingController::class, 'index'])->name('surveying.index');
    Route::get('/laboratory/surveying/print-all', [SurveyingController::class, 'printAll'])->name('surveying.printAll');
    Route::resource('testings', TestingController::class);
    Route::get('/computer-engineering/print-all', [ComputerEngineeringController::class, 'printAll'])->name('computer_engineering.printAll');
    Route::get('/laboratory/testing/print-all', [TestingController::class, 'printAll'])->name('testing.printAll');
    Route::get('/laboratory/computer_engineering', [ComputerEngineeringController::class, 'index'])->name('computer_engineering.index');
    Route::get('laboratory/construction', [ConstructionController::class, 'index'])->name('construction.index');
    Route::get('laboratory/fluid', [FluidController::class, 'index'])->name('fluid.index');
    Route::get('laboratory/surveying', [SurveyingController::class, 'index'])->name('surveying.index');

    Route::get('laboratory/testing', [TestingController::class, 'index'])->name('testing.index');
    Route::get('laboratory/calendar', [CalendarController::class, 'index'])->name('laboratory.calendar');
    Route::get('/laboratory/transaction', [TeacherborrowController::class, 'index'])->name('transaction.index');
    Route::get('/laboratory/view-requisition-details/{id}', [TeacherborrowController::class, 'retrieve'])->name('borrows.show');
    Route::put('/laboratory/update-requisition-details/{id}', [TeacherborrowController::class, 'decision'])->name('teachers-borrows.update');

    Route::post('/laboratory/transaction/{id}/approve', [TeacherborrowController::class, 'approve'])->name('laboratory.transaction.approve');
    Route::post('/laboratory/transaction/{id}/disapprove', [TeacherborrowController::class, 'disapprove'])->name('laboratory.transaction.disapprove');
    Route::post('/laboratory/transaction/{id}/returned', [TeacherborrowController::class, 'returned'])->name('laboratory.transaction.returned');
    Route::post('/laboratory/transaction/{id}/damaged', [TeacherborrowController::class, 'damaged'])->name('laboratory.transaction.damaged');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/laboratory/requisitions/print-data/{id}', [TeacherborrowController::class, 'print'])->name('laboratory.print-requisition');
    Route::post('office/transactions/update', [TeacherborrowController::class, 'return_damaged'])->name('lab.transactions.update');

    Route::post('/laboratory/notify-borrower', [TransactionOfficeController::class, 'notifyBorrower'])->name('notify.user');
    Route::get('/laboratory/requisitions/chart', [TeacherborrowController::class, 'getChartData'])->name('laboratory-office.chart');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('superadmin/dashboard', [SuperadminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('superadmin/computer_engineering', [SComputerController::class, 'index'])->name('superadmin.computer_engineering.index');
    Route::get('superadmin/construction', [SConstructionController::class, 'index'])->name('superadmin.construction.index');
    Route::get('superadmin/fluid', [SFLuidController::class, 'index'])->name('superadmin.fluid.index');
    Route::get('superadmin/testing', [STestingController::class, 'index'])->name('superadmin.testing.index');
    Route::get('superadmin/surveying', [SSurveyingController::class, 'index'])->name('superadmin.surveying.index');
    Route::get('superadmin/equipment', [SEquipmentController::class, 'index'])->name('superadmin.equipment.index');
    Route::get('superadmin/supplies', [SSuppliesController::class, 'index'])->name('superadmin.supplies.index');
    Route::resource('users', UserManagementController::class);
    Route::get('superadmin/transaction', [TeacherborrowController::class, 'index'])->name('superadmin.transaction.index');
    Route::get('superadmin/site-transactions', [AdminSiteOffice::class, 'index'])->name('superadmin.site.index');

    Route::get('superadmin/site-office-transaction', [AdminSiteOffice::class, 'index'])->name('superadmin.site-transactions.index');
    Route::get('/superadmin/requisitions/chart', [TeacherborrowController::class, 'getChartData'])->name('requisitions.chart');
    Route::get('/superadmin/office/chart', [TeacherborrowController::class, 'offcieChartData'])->name('office.chart');
});



Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/supplies/select/{id}', [Office_UserController::class, 'select'])->name('supplies.select');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
    Route::get('/office_user/create', [TransactionOfficeController::class, 'create'])->name('office_user.create');
    Route::post('/office_user/selectCategory', [TransactionOfficeController::class, 'selectCategory'])->name('office_user.selectCategory');
    Route::get('/teachersborrow/create', [TeacherBorrowController::class, 'create'])->name('teachersborrow.create');
    Route::post('/teachersborrow/selectCategory', [TeacherBorrowController::class, 'selectCategory'])->name('teachersborrow.selectCategory');

    Route::post('/teachersborrow/store', [TeacherBorrowController::class, 'store'])->name('teachersborrow.store');
    Route::post('/office_user', [TransactionOfficeController::class, 'store'])->name('office_user.store');
    Route::get('profile/notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/notification/markAllAsRead', [NotificationController::class, 'markAllAsRead'])->name('notification.markAllAsRead');
    Route::delete('/notification/remove/{index}', [NotificationController::class, 'removeNotification'])->name('notification.remove');

    Route::get('/items/items-selected', [TeacherBorrowController::class, 'findMatchingItems'])->name('find-items');
});



Route::middleware(['auth', 'role:dean'])->group(function () {
    Route::get('dean/dashboard', [DeanController::class, 'index'])->name('dean.dashboard');
    Route::get('dean/computer_engineering', [DComputerController::class, 'index'])->name('computer_engineering.index');
    Route::get('dean/construction', [DConstructionController::class, 'index'])->name('construction.index');
    Route::get('dean/fluid', [DFLuidController::class, 'index'])->name('fluid.index');
    Route::get('dean/testing', [DTestingController::class, 'index'])->name('testing.index');
    Route::get('dean/surveying', [DSurveyingController::class, 'index'])->name('surveying.index');
    Route::get('dean/equipment', [DEquipmentController::class, 'index'])->name('equipment.index');
    Route::get('dean/supplies', [DSuppliesController::class, 'index'])->name('supplies.index');
    Route::get('dean/transactions', [TeacherBorrowController::class, 'dean_index'])->name('dean.transactions');
    Route::get('dean/transactions/view-details/{id}', [TeacherBorrowController::class, 'show_data'])->name('dean.transactions.show');
    Route::put('dean/laboratory/change-requisition-details/{id}', [TeacherborrowController::class, 'dean_decision'])->name('dean.borrows.update');


    Route::get('/dean/requisitions/chart', [TeacherborrowController::class, 'getChartData'])->name('dean.requisitions.chart');
    Route::get('/dean/office/chart', [TeacherborrowController::class, 'offcieChartData'])->name('dean.office.chart');
    Route::get('/dean/site-transactions', [TransactionOfficeController::class, 'index'])->name('dean.transactions.site');


    Route::get('/dean/site-office-requisition', [OfficeRequisitionController::class, 'index'])->name('site-requisition.index');
    Route::get('/dean/site-office-requisition/{id}', [OfficeRequisitionController::class, 'show'])->name('site-requisition.show');
    Route::post('/dean/site-office-requisition', [OfficeRequisitionController::class, 'approve'])->name('site-requisition.approve');
});


require __DIR__ . '/auth.php';
