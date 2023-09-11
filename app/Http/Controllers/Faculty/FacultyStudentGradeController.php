<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGrade;

class FacultyStudentGradeController extends Controller
{
    //


    public function store(Request $req){
        //return $req;

        $req->validate([
            'schedule_id' => ['required'],
            'student_id' => ['required'],
            'grade' => ['required']
        ]);


        StudentGrade::updateOrCreate(
            [
                'student_list_id' => $req->student_list_id,
            ],
            [
                'academic_year_id' => $req->academic_year_id,
                'schedule_id' => $req->schedule_id,
                'faculty_id' => $req->faculty_id,
                'student_id' => $req->student_id,
                'grade' => $req->grade,
            ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }
}
