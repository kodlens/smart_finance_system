<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AllotmentClass;

class AllotmentClassController extends Controller
{
    //

    public function index(){
        return view('administrator.allotment.allotment-class');
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        return AllotmentClass::with(['financial_year'])
            ->where('allotment_class', 'like', '%'. $req->allotment . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function show($id){
        return AllotmentClass::find($id);
    }


    public function store(Request $req){

        $req->validate([
            'financial_year_id' => ['required'],
            'allotment_class' => ['required', 'unique:allotment_classes'],
            'allotment_class_amount' => ['required']
        ]);

        AllotmentClass::create([
            'financial_year_id' => $req->financial_year_id,
            'allotment_class' => strtoupper($req->allotment_class),
            'allotment_class_amount' => $req->allotment_class_amount
        ]);


        return response()->json([
            'status' => 'saved'
        ], 200);
    }

    public function update(Request $req, $id){

        $req->validate([
            'financial_year_id' => ['required'],
            'allotment_class' => ['required', 'unique:allotment_classes,allotment_class,' .$id. ',allotment_class_id'],
            'allotment_class_amount' => ['required']
        ]);

        $data = AllotmentClass::find($id);
        $data->financial_year_id = $req->financial_year_id;
        $data->allotment_class = strtoupper($req->allotment_class);
        $data->allotment_class_amount = $req->allotment_class_amount;
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }



    public function destroy($id){
        AllotmentClass::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }

}
