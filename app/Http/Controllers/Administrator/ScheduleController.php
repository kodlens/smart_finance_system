<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Room;
use App\Models\AcademicYear;
use App\Models\Program;

use App\Rules\DetectConflictRule;


class ScheduleController extends Controller
{
    //

    public function index(){
        return view('administrator.schedule.schedule-page');
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);
        $ayId = $req->acadyearid;

        $data = Schedule::with(['course', 'faculty.user', 'room'])
            ->where('academic_year_id', $ayId)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function create(){

        $acadYears = AcademicYear::orderBy('academic_year_code', 'desc')->get();
        $programs = Program::orderBy('program_code', 'asc')->get();
        $rooms = Room::orderBy('room', 'asc')->get();

        return view('administrator.schedule.schedule-create-update')
            ->with('acadYears', $acadYears)
            ->with('programs', $programs)
            ->with('rooms', $rooms);
    }


    public function store(Request $req){
        //return $req;

        $forceSave = $req->forcesave;

        $ayid = $req->academic_year_id;

        $mon = $req->mon == true ? 1 : 0;
        $tue = $req->tue == true ? 1 : 0;
        $wed = $req->wed == true ? 1 : 0;
        $thu = $req->thu == true ? 1 : 0;
        $fri = $req->fri == true ? 1 : 0;
        $sat = $req->sat == true ? 1 : 0;
        $sun = $req->sun == true ? 1 : 0;


        $startTime = date("H:i:s", strtotime($req->start_time)); //convert to date format UNIX
        $endTime = date("H:i:s", strtotime($req->end_time)); //convert to date format UNIX

        if($forceSave == 'Yes'){
            $req->validate([
                'academic_year_id' => ['required'],
                //'institute_id' => ['required'],
                //'program_id' => ['required'],
                'course_id' => ['required'],
                'room_id' => ['required'],
                'start_time' => ['required'],
                'end_time' => ['required'],
            ], $message = [
                'academic_year_id.required' => 'Academic year is required.',
                'course_id.required' => 'Course is required.',
                'room_id.required' => 'Room is required.',
            ]);

        }else{

            $req->validate([
                'academic_year_id' => ['required'],
                //'institute_id' => ['required'],
                //'program_id' => ['required'],
                'course_id' => ['required'],
                'room_id' => ['required'],
                'start_time' => ['required'],
                'end_time' => ['required'],
                'schedule' => [new DetectConflictRule($ayid, $startTime, $endTime, $mon, $tue, $wed, $thu, $fri, $sat, $sun, $req->room_id,0)]
            ], $message = [
                'academic_year_id.required' => 'Academic year is required.',
                'program_id.required' => 'Program is required.',
                'course_id.required' => 'Course is required.',
                'room_id.required' => 'Room is required.',
            ]);
        }


        Schedule::create([
            'academic_year_id' => $ayid,
            //'institute_id' => $req->institute_id,
            'program_id' => $req->program_id,
            'course_id' => $req->course_id,
            'room_id' => $req->room_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'mon' => $mon,
            'tue' => $tue,
            'wed' => $wed,
            'thu' => $thu,
            'fri' => $fri,
            'sat' => $sat,
            'sun' => $sun,
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);

    }

    public function edit($id){

        $acadYears = AcademicYear::orderBy('academic_year_code', 'desc')->get();
        $programs = Program::orderBy('program_code', 'asc')->get();
        $rooms = Room::orderBy('room', 'asc')->get();
        $data = Schedule::with('acadyear', 'program', 'course')
                    ->where('schedule_id', $id)
                    ->first();

        return view('administrator.schedule.schedule-create-update')
            ->with('acadYears', $acadYears)
            ->with('programs', $programs)
            ->with('rooms', $rooms)
            ->with('data', $data);
    }


    public function update(Request $req, $id){
        //return $req;

        $ayid = $req->academic_year_id;

        $startTime = date("H:i:s", strtotime($req->start_time)); //convert to date format UNIX
        $endTime = date("H:i:s", strtotime($req->end_time)); //convert to date format UNIX

        $mon = $req->mon == true ? 1 : 0;
        $tue = $req->tue == true ? 1 : 0;
        $wed = $req->wed == true ? 1 : 0;
        $thu = $req->thu == true ? 1 : 0;
        $fri = $req->fri == true ? 1 : 0;
        $sat = $req->sat == true ? 1 : 0;
        $sun = $req->sun == true ? 1 : 0;

        if($req->forcesave == 'Yes'){
            $req->validate([
                'academic_year_id' => ['required'],
                'course_id' => ['required'],
                'start_time' => ['required'],
                'end_time' => ['required'],
                'room_id' => ['required'],
            ], $message = [
                'acadyear_id.required' => 'Academic year is required.',
                'course_id.required' => 'Course is required.',
                'room_id.required' => 'Room is required.',
    
            ]);
        }else{
            $req->validate([
                'academic_year_id' => ['required'],
                'course_id' => ['required'],
                'start_time' => ['required'],
                'end_time' => ['required'],
                'room_id' => ['required'],
                'schedule' => [new DetectConflictRule($ayid, $startTime, $endTime, $mon, $tue, $wed, $thu, $fri, $sat, $sun, $req->room_id, $id)]
            ], $message = [
                'acadyear_id.required' => 'Academic year is required.',
                'course_id.required' => 'Course is required.',
                'room_id.required' => 'Room is required.',
    
            ]);
        }

        $data = Schedule::find($id);
        $data->academic_year_id = $ayid;
        $data->program_id = $req->program_id;
        $data->course_id = $req->course_id;
        $data->room_id = $req->room_id;
        $data->start_time = $startTime;
        $data->end_time = $endTime;
        $data->mon = $req->mon;
        $data->tue = $req->tue;
        $data->wed = $req->wed;
        $data->thu = $req->thu;
        $data->fri = $req->fri;
        $data->sat = $req->sat;
        $data->sun = $req->sun;
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }
}
