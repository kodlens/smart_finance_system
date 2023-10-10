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

/*     ADMINSITRATOR          */

//authenticate
Route::middleware(['auth'])->group(function() {

    Route::resource('/dashboard', App\Http\Controllers\Administrator\DashboardController::class);

    Route::resource('/offices', App\Http\Controllers\Administrator\OfficeController::class);
    Route::get('/get-offices', [App\Http\Controllers\Administrator\OfficeController::class, 'getOffices']);
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

    
    Route::resource('/accounting', App\Http\Controllers\Administrator\AccountingController::class);
    Route::get('/get-accounting-records', [App\Http\Controllers\Administrator\AccountingController::class, 'getData']);
    


});





Route::middleware(['auth'])->group(function() {

    //Get student list in modal
    Route::get('/get-modal-student-lists', [App\Http\Controllers\Modal\ModalStudentListController::class, 'getModalStudentList']);

    Route::get('/get-modal-cousres-lists', [App\Http\Controllers\Modal\ModalCoursesController::class, 'getModalCoursesList']);

});




Route::middleware(['auth', 'student'])->group(function() {

    Route::get('/student-dashboard', [App\Http\Controllers\Student\StudentDashboardController::class, 'index']);

    Route::resource('/my-courses', App\Http\Controllers\Student\MyStudentCourseController::class);
    Route::get('/get-my-courses', [App\Http\Controllers\Student\MyStudentCourseController::class, 'getMyCourses']);
    Route::get('/my-courses-print', [App\Http\Controllers\Student\MyStudentCourseController::class, 'myCoursePrint']);

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
