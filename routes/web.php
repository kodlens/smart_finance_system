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
Route::get('/sample',[App\Http\Controllers\SampleController::class,'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//for open request
//ADDRESS
Route::get('/load-provinces', [App\Http\Controllers\AddressController::class, 'loadProvinces']);
Route::get('/load-cities', [App\Http\Controllers\AddressController::class, 'loadCities']);
Route::get('/load-barangays', [App\Http\Controllers\AddressController::class, 'loadBarangays']);

Route::get('/load-acadyears', [App\Http\Controllers\OpenController::class, 'loadAcadYears']);
Route::get('/load-offices', [App\Http\Controllers\OpenController::class, 'loadOffices']);

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

    Route::resource('/courses', App\Http\Controllers\Administrator\CourseController::class);
    Route::get('/get-courses', [App\Http\Controllers\Administrator\CourseController::class, 'getData']);

    Route::resource('/schedules', App\Http\Controllers\Administrator\ScheduleController::class);
    Route::get('/get-schedules', [App\Http\Controllers\Administrator\ScheduleController::class, 'getData']);

    Route::resource('/faculty', App\Http\Controllers\Administrator\FacultyController::class);
    Route::get('/get-faculty', [App\Http\Controllers\Administrator\FacultyController::class, 'getData']);


    Route::get('/faculty-loads/{id}', [App\Http\Controllers\Administrator\FacultyLoadController::class, 'index']);
    Route::get('/get-faculty-loads', [App\Http\Controllers\Administrator\FacultyLoadController::class, 'getData']);
    Route::get('/get-individual-loads/{id}/{acadyearId}', [App\Http\Controllers\Administrator\FacultyLoadController::class, 'getIndividualLoads']);
    Route::get('/get-modal-schedules', [App\Http\Controllers\Administrator\FacultyLoadController::class, 'getModalSchedules']);
    Route::post('/faculty-load-store', [App\Http\Controllers\Administrator\FacultyLoadController::class, 'store']);
    Route::delete('faculty-load-delete/{id}', [App\Http\Controllers\Administrator\FacultyLoadController::class, 'destroy']);
    
    Route::resource('/users', App\Http\Controllers\Administrator\UserController::class);
    Route::get('/get-users', [App\Http\Controllers\Administrator\UserController::class, 'getUsers']);
    
    Route::resource('/users', App\Http\Controllers\Administrator\UserController::class);
    Route::get('/get-users', [App\Http\Controllers\Administrator\UserController::class, 'getUsers']);
    

});




Route::middleware(['auth', 'faculty'])->group(function() {

    Route::get('/faculty-dashboard', [App\Http\Controllers\Faculty\FacultyDashboardController::class, 'index']);
    Route::resource('/faculty-profile', App\Http\Controllers\Faculty\FacultyProfileController::class);
    Route::get('/faculty-profile-info', [App\Http\Controllers\Faculty\FacultyProfileController::class, 'facultyProfileInfo']);

    Route::resource('/faculty-faculty-load', App\Http\Controllers\Faculty\FacultyFacultyLoadController::class);
    Route::get('/get-faculty-faculty-loads', [App\Http\Controllers\Faculty\FacultyFacultyLoadController::class, 'getFacultyLoads']);

    Route::get('/faculty-student-list', [App\Http\Controllers\Faculty\FacultyStudentListController::class, 'index']);
    Route::get('/get-student-lists', [App\Http\Controllers\Faculty\FacultyStudentListController::class, 'getStudentLists']);
    
    Route::post('/faculty-student-list-store', [App\Http\Controllers\Faculty\FacultyStudentListController::class, 'addStudent']);
    Route::delete('/faculty-student-list/{listId}', [App\Http\Controllers\Faculty\FacultyStudentListController::class, 'delete']);
    Route::post('/grade-entry', [App\Http\Controllers\Faculty\FacultyStudentGradeController::class, 'store']);

    
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