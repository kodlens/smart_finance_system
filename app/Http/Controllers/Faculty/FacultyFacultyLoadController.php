<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use Auth;
use App\Models\FacultyLoad;

class FacultyFacultyLoadController extends Controller
{
    //

    public function index(){
        $acadYears = AcademicYear::orderBy('academic_year_code', 'desc')->get();

        return view('faculty.faculty-faculty-load')
            ->with('acadYears', $acadYears);
    }

    public function getFacultyLoads(Request $req){
        $acadYearId = $req->acadYearId;

        $user = Auth::user();
        $loads = FacultyLoad::with(['schedule', 'schedule.course', 'schedule.room'])
            ->where('user_id', $user->user_id)
            ->where('academic_year_id', $acadYearId)
            ->get();

        return $loads;
    }
}
