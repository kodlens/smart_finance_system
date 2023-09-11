<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentList;
use Auth;

class MyStudentCourseController extends Controller
{
    //

    public function index(){
        return view('student.my-courses');
    }

    public function getMyCourses(Request $req){
        $acadYearId = $req->acadyearid;

        $user = Auth::user();

        $loads = StudentList::with(['schedule.course', 
            'schedule.room', 'academicYear', 'faculty', 'grade'])
            ->where('student_id', $user->user_id)
            ->where('academic_year_id', $acadYearId)
            ->get();

        return $loads;
    }


    public function myCoursePrint(){
        return view('student.print-my-courses');

    }
}
