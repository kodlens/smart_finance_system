<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->middleware('guest');


Auth::routes([
    'login' => false,
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);



Route::get('/get-user', function(){
    if(Auth::check()){
        return Auth::user();
    }

    return [];
});



Route::post('/custom-login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//for open request
//ADDRESS
Route::get('/load-provinces', [App\Http\Controllers\AddressController::class, 'loadProvinces']);
Route::get('/load-cities', [App\Http\Controllers\AddressController::class, 'loadCities']);
Route::get('/load-barangays', [App\Http\Controllers\AddressController::class, 'loadBarangays']);

Route::get('/load-acadyears', [App\Http\Controllers\OpenController::class, 'loadAcadYears']);
Route::get('/load-offices', [App\Http\Controllers\OpenController::class, 'loadOffices']);
Route::get('/load-allotment-classes', [App\Http\Controllers\OpenController::class, 'loadAllotmentClasses']);
Route::get('/load-transaction-types', [App\Http\Controllers\OpenController::class, 'loadTransactionTypes']);
Route::get('/load-documentary-attachments', [App\Http\Controllers\OpenController::class, 'loadDocumentaryAttachments']);
Route::get('/load-allotment-classes', [App\Http\Controllers\OpenController::class, 'loadAllotmentClasses']);


Route::get('/get-modal-offices', [App\Http\Controllers\OpenModalResourcesController::class, 'getModalOffices']);




/*     ADMINSITRATOR          */

//authenticate
Route::middleware(['auth'])->group(function() {

    Route::resource('/dashboard', App\Http\Controllers\Administrator\DashboardController::class);
    Route::get('/get-offices-for-routes', [App\Http\Controllers\Administrator\OfficeController::class, 'getOfficesForRoutes']);
});


Route::middleware(['auth', 'admin'])->group(function() {

    Route::resource('/academic-years', App\Http\Controllers\Administrator\AcademicYearController::class);
    Route::get('/get-academic-years', [App\Http\Controllers\Administrator\AcademicYearController::class, 'getData']);


    Route::resource('/users', App\Http\Controllers\Administrator\UserController::class);
    Route::get('/get-users', [App\Http\Controllers\Administrator\UserController::class, 'getUsers']);


    Route::resource('/allotment-classes', App\Http\Controllers\Administrator\AllotmentClassController::class);
    Route::get('/get-allotment-classes', [App\Http\Controllers\Administrator\AllotmentClassController::class, 'getData']);

    Route::resource('/allotment-class-accounts', App\Http\Controllers\Administrator\AllotmentClassAccountController::class);
    Route::get('/get-allotment-class-accounts', [App\Http\Controllers\Administrator\AllotmentClassAccountController::class, 'getData']);
    Route::get('/get-modal-allotment-class-accounts', [App\Http\Controllers\Administrator\AllotmentClassAccountController::class, 'getModalAllotmentClassAccounts']);


    Route::resource('/priority-programs', App\Http\Controllers\Administrator\PriorityProgramController::class);
    Route::get('/get-priority-programs', [App\Http\Controllers\Administrator\PriorityProgramController::class, 'getData']);
    Route::get('/get-modal-priority-programs', [App\Http\Controllers\Administrator\PriorityProgramController::class, 'getModalPriorityPrograms']);



    Route::resource('/accounting', App\Http\Controllers\Administrator\AccountingController::class);
    Route::post('/accounting-update/{id}', [App\Http\Controllers\Administrator\AccountingController::class, 'updateAccounting']);
    Route::get('/get-accounting-records', [App\Http\Controllers\Administrator\AccountingController::class, 'getData']);


    Route::resource('/budgeting', App\Http\Controllers\Administrator\BudgetingController::class);
    Route::post('/budgeting-update/{id}', [App\Http\Controllers\Administrator\BudgetingController::class, 'updateProcurement']);
    Route::get('/get-budgeting-records', [App\Http\Controllers\Administrator\BudgetingController::class, 'getData']);


    Route::resource('/procurements', App\Http\Controllers\Administrator\ProcurementController::class);
    Route::get('/get-procurements-records', [App\Http\Controllers\Administrator\ProcurementController::class, 'getData']);



    Route::resource('/supplier-payee', App\Http\Controllers\Administrator\PayeeController::class);
    Route::get('/get-supplier-payee', [App\Http\Controllers\Administrator\PayeeController::class, 'getData']);
    Route::get('/get-modal-payee', [App\Http\Controllers\Administrator\PayeeController::class, 'getModalPayee']);


    Route::resource('/transaction-types', App\Http\Controllers\Administrator\TransactionTypeController::class);
    Route::get('/get-transaction-types', [App\Http\Controllers\Administrator\TransactionTypeController::class, 'getData']);

    Route::resource('/documentary-attachments', App\Http\Controllers\Administrator\DocumentaryAttachmentController::class);
    Route::get('/get-documentary-attachments', [App\Http\Controllers\Administrator\DocumentaryAttachmentController::class, 'getData']);

    Route::resource('/offices', App\Http\Controllers\Administrator\OfficeController::class);
    Route::get('/get-offices', [App\Http\Controllers\Administrator\OfficeController::class, 'getOffices']);


});















Route::get('/session', function(){
    return Session::all();
});


Route::get('/applogout', function(Request $req){
    \Auth::logout();
    $req->session()->invalidate();
    $req->session()->regenerateToken();
});

//hello kigwa//
//Testingtesting
//okay
Route::get('/test', function(){
    return 'hi i am test';
});
Route::get('/student-profile', function(){
    return  view('student.student-profile');
});
