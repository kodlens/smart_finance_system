<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\User;
use App\Models\Schedule;
use App\Models\FacultyLoad;

class FacultyLoadController extends Controller
{
    //
    public function index($id){
        $user = user::where('user_id', $id)->first();
        $acadYears = AcademicYear::orderBy('academic_year_code', 'desc')->get();

        return view('administrator.faculty.faculty-load')
            ->with('user', $user)
            ->with('acadYears', $acadYears);

    }


    public function getData(Request $req){
        $ay = AcademicYear::where('active', 1)->first();

        $sort = explode('.', $req->sort_by);

        $data = User::with(['faculty_loads'])
            ->where('lname', 'like', $req->lname . '%')
            ->where('role', 'FACULTY')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function getModalSchedules(Request $req){
        
        $ayid = $req->ayid;
        $sort = explode('.', $req->sort_by);

        $sched = Schedule::with(['course', 'program', 'room'])
            ->where('academic_year_id', $ayid)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $sched;
    }

    public function getIndividualLoads($id, $ayid){

        return FacultyLoad::with(['schedule', 'schedule.room', 'schedule.course'])->where('user_id', $id)
            ->where('academic_year_id', $ayid)
            ->get();
    }

    public function store(Request $req){
        //return $req;

        $req->validate([
            'user_id' => ['required'],
        ]);

        $data = [];
        foreach($req->loads as $load){

            FacultyLoad::updateOrCreate(
                [
                    'faculty_load_id' => $load['faculty_load_id']
                ],
                [
                    'academic_year_id' => $load['academic_year_id'],
                    'user_id' => $req->user_id,
                    'schedule_id' => $load['schedule_id']
                ]
                 
            );
            // array_push($data, [
            //     'academic_year_id' => $load['academic_year_id'],
            //     'user_id' => $req->user_id,
            //     'schedule_id' => $load['schedule_id']
            // ]);
        }
        //FacultyLoad::insert($data);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function destroy($id){
        FacultyLoad::destroy($id);
        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
}
