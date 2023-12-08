<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialYear;

class FinancialYearController extends Controller
{
    //
    public function index(){
        return view('administrator.financial_year.financial-year');
    }

    public function show($id){
        return FinancialYear::find($id);
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);
        return FinancialYear::where('financial_year_desc', 'like', $req->academic_year . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function store(Request $req){
        $req->validate([
            'financial_year_code' => ['required', 'unique:academic_years'],
            'financial_year_desc' => ['required']
        ]);

        FinancialYear::create([
            'financial_year_code' => strtoupper($req->financial_year_code),
            'financial_year_desc' => strtoupper($req->financial_year_desc),
            'active' => $req->active,
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }

    public function update(Request $req, $id){
        $req->validate([
            'financial_year_code' => ['required', 'unique:financial_years,financial_year_code,'.$id.',financial_year_id'],
            'financial_year_desc' => ['required']
        ]);

        $data = FinancialYear::find($id);
        $data->financial_year_code = strtoupper($req->financial_year_code);
        $data->financial_year_desc = strtoupper($req->financial_year_desc);
        $data->active = $req->active;
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function setACtive($ayId){

        DB::table('financial_years')
            ->where('active', 1)
            ->update([
                'active' => 0
            ]);

        DB::table('financial_years')
            ->where('acadyear_id', $ayId)
            ->update([
                'active' => 1
            ]);

        return response()->json([
            'status' => 'active'
        ], 200);
    }

    public function destroy($id){
        FinancialYear::destroy($id);
        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
    
}
