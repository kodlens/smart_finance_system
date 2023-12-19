<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Procurement;

class ProcurementController extends Controller
{
    //



    public function index(){
        return view('administrator.procurement.procurement-index');
    }


    public function show($id){
        return Procurement::with(['payee', 'allotment_class', 'allotment_class_account', 'office'])
            ->find($id);
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Procurement::with(['fund_source', 'payee', 'procurement_documentary_attachments.documentary_attachment',
            'procurement_allotment_classes'])
            ->where('particulars', 'like', $req->key . '%')
            ->orWhere('training_control_no', 'like', $req->key . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function create(){
        return view('administrator.procurement.procurement-create-edit')
            ->with('id', 0);
    }


    public function edit($id){
        return view('administrator.procurement.procurement-create-edit')
            ->with('id', $id);
    }


    public function store(Request $req){

        $req->validate([
            'financial_year_id' => ['required'],
            'fund_source_id' => ['required'],
            'date_time' => ['required'],
            'training_control_no' => ['required'],
            'pr_no' => ['required'],
            'particulars' => ['required'],
            'pr_amount' => ['required'],
            'payee_id' => ['required'],
            'office_id' => ['required'],

        ],[
            'payee_id.required' => 'Please select bank account/payee.',
            'office_id.required' => 'Please select office.'
        ]);

        $data = Procurement::create([
            'financial_year_id' => $req->financial_year_id,
            'fund_source_id' => $req->fund_source_id,
            'date_time' => $req->date_time,
            'training_control_no' => $req->training_control_no,
            'pr_no' => strtoupper($req->pr_no),
            'particulars' => $req->particulars,
            'pr_amount' => $req->pr_amount,
            'payee_id' => $req->payee_id,
            'pr_status' => $req->pr_status,
            'others' => $req->remarks,
            'priority_program_id' => $req->priority_program_id,
            'office_id' => $req->office_id
        ]);


       return response()->json([
           'status' => 'saved'
       ], 200);

    }


    public function update(Request $req, $id){
        //return $req;

        $req->validate([
            'date_time' => ['required'],
            'training_control_no' => ['required'],
            'pr_number' => ['required', 'unique:procurements,pr_number,' . $id . ',procurement_id'],
            'particulars' => ['required'],
            'pr_amount' => ['required'],
            'payee_id' => ['required'],
            'pr_status' => ['required'],
            'allotment_class_id' => ['required'],
            'allotment_class_account_id' => ['required'],
            'priority_program_id' => ['required'],
            // 'supplemental_budget' => ['required'],
            // 'capital_outlay' => ['required'],
            // 'account_payable' => ['required'],
            // 'tes_trust_fund' => ['required'],
            'office_id' => ['required'],

        ],[
            'payee_id.required' => 'Please select bank account/payee.',
            'allotment_class_id.required' => 'Please allotment class.',
            'allotment_class_account_id.required' => 'Please allotment class account.',
            'priority_program_id.required' => 'Please select priority program.',
            'office_id.required' => 'Please select office.'

        ]);


        $data = Procurement::where('procurement_id', $id)
            ->update([
                'date_time' => $req->date_time,
                'training_control_no' => $req->training_control_no,
                'pr_number' => strtoupper($req->pr_number),
                'particulars' => $req->particulars,
                'pr_amount' => $req->pr_amount,
                'payee_id' => $req->payee_id,
                'pr_status' => $req->pr_status,
                'remarks' => $req->remarks,
                'allotment_class_id' => $req->allotment_class_id,
                'allotment_class_account_id' => $req->allotment_class_id,
                'priority_program_id' => $req->priority_program_id,
                'supplemental_budget' => $req->supplemental_budget,
                'capital_outlay' => $req->capital_outlay,
                'account_payable' => $req->account_payable,
                'tes_trust_fund' => $req->tes_trust_fund,
                'others' => $req->others,
                'office_id' => $req->office_id
            ]);



       return response()->json([
           'status' => 'updated'
       ], 200);

    }



    public function destroy($id){

        Procurement::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);

    }


}
