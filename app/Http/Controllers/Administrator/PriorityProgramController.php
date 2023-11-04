<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriorityProgram;

class PriorityProgramController extends Controller
{
    //

    public function index(){
        return view('administrator.priorityprogram.priority-program');
    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        return PriorityProgram::where('priority_program', 'like', '%' . $req->pp . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function getModalPriorityPrograms(Request $req){
        $sort = explode('.', $req->sort_by);

        return PriorityProgram::where('priority_program', 'like', '%' . $req->pp . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function show($id){
        return PriorityProgram::find($id);
    }


    public function store(Request $req){

        $req->validate([
            'priority_program' => ['required'],
            'priority_program_code' => ['required']
        ]);

        PriorityProgram::create([
            'priority_program' => strtoupper($req->priority_program),
            'priority_program_code' =>strtoupper($req->priority_program_code),
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function update(Request $req, $id){

        $req->validate([
            'priority_program' => ['required'],
            'priority_program_code' => ['required']
        ]);


        $data = PriorityProgram::find($id);
        $data->priority_program = strtoupper($req->priority_program);
        $data->priority_program_code = strtoupper($req->priority_program_code);

        $data->save();


        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function destroy($id){

        PriorityProgram::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }



}
