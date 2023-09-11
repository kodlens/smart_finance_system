<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    //

    public function index(){
        return view('administrator.course.course');
    }

    public function show($id){
        return Course::find($id);
    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);
        return Course::where('course_code', 'like', '%' . $req->course . '%')
            ->orWhere('course_desc', 'like', '%'. $req->cousrse . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function store(Request $req){
        
        //return $req;

        $req->validate([
            'course_code' => ['required'],
            'course_desc' =>  ['required'],
            'course_unit' => ['required'],
            'course_type' => ['required'],
        ]);

        Course::create([
            'course_code' => strtoupper($req->course_code),
            'course_desc' => strtoupper($req->course_desc),
            'course_unit' => $req->course_unit,
            'course_type' => strtoupper($req->course_type),
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);

    }


    public function update(Request $req, $id){
        //return $req;

        $req->validate([
            'course_code' => ['required'],
            'course_desc' =>  ['required'],
            'course_unit' => ['required'],
            'course_type' => ['required'],
        ]);

        $data = Course::find($id);

        $data->course_code = strtoupper($req->course_code);
        $data->course_desc = strtoupper($req->course_desc);
        $data->course_type = strtoupper($req->course_type);
        $data->course_unit = strtoupper($req->course_unit);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function destroy($id){
        Course::find($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
    
}
