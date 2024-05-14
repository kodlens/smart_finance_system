<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjectExpenditure;

class ObjectExpenditureController extends Controller
{
    //


    public function index(){
        return view('administrator.object-expenditure.object-expenditure');
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        return ObjectExpenditure::where('allotment_class', 'like', '%'. $req->allotment . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function show($id){
        return AllotmentClass::with('financial_year')
            ->find($id);
    }



    public function getModalObjectExpenditures(){
        $data = ObjectExpenditure::where('financial_year_id', $req->financial)
            ->get();

        return $data;
    }


    public function store(Request $req){
        
        $req->validate([
            'financial_year_id' => ['required'],
            'object_expenditure' => ['required'],
            'allotment_class' => ['required'],
            'allotment_class_code' => ['required'],
        ]);

        ObjectExpenditure::create([
            'financial_year_id' => $req->financial_year_id,
            'object_expenditure' => strtoupper($req->object_expenditure),
            'allotment_class' => strtoupper($req->allotment_class),
            'allotment_class_code' => strtoupper($req->allotment_class_code),
            
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);

    }


}
