<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budgeting;
use App\Models\BudgetingDocumentaryAttachment;

class BudgetingController extends Controller
{
    //


    public function index(){
        return view('administrator.budgeting.budgeting-index');
    }


    public function show($id){
        return Budgeting::with(['payee', 'allotment_class', 'allotment_class_account', 'priority_program', 'office'])
            ->find($id);
    }

    
    public function getData(Request $req){

        $sort = explode('.', $req->sort_by);

        $data = Budgeting::with(['payee', 'budgeting_documentary_attachments.documentary_attachment',
            'budgeting_allotment_classes'])
            ->where('particulars', 'like', $req->key . '%')
            ->orWhere('transaction_no', 'like', $req->key . '%')
            ->orWhere('training_control_no', 'like', $req->key . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function create(){
        return view('administrator.budgeting.budgeting-create-edit')
            ->with('id', 0);
    }


    public function edit($id){
        return view('administrator.budgeting.budgeting-create-edit')
            ->with('id', $id);
    }




    public function store(Request $req){
        //return $req->allotment_classes;
         //return $req;
 
         $req->validate([
             'financial_year_id' => ['required'],
             'fund_source' => ['required'],
             'date_time' => ['required'],
             'transaction_no' => ['required'],
             'training_control_no' => ['required'],
             'transaction_type_id' => ['required'],
             'payee_id' => ['required'],
             'particulars' => ['required'],
             'total_amount' => ['required'],
             'priority_program_id' => ['required'],
         ],[
             'financial_year_id.required' => 'Please select financial year.',
             'transaction_type_id.required' => 'Please select transaction.',
             'payee_id.required' => 'Please select bank account/payee.',
             'allotment_class_id.required' => 'Please allotment class.',
             'allotment_class_account_id.required' => 'Please allotment class account.',
             'priority_program_id.required' => 'Please select priority program.'
         ]);
 
         $data = Budgeting::create([
             'financial_year_id' => $req->financial_year_id,
             'fund_source' => $req->fund_source,
             'date_time' => $req->date_time,
             'transaction_no' => $req->transaction_no,
             'training_control_no' => $req->training_control_no,
             'transaction_type_id' => $req->transaction_type_id,
             'payee_id' => $req->payee_id,
             'particulars' => $req->particulars,
             'total_amount' => $req->total_amount,
             //naa pai attachment
             'priority_program_id' => $req->priority_program_id,
             'others' => $req->others
         ]);
 
 
         if($req->has('documentary_attachments')){
             foreach ($req->documentary_attachments as $item) {
                 $n = [];
                 if($item['file_upload']){
                     $pathFile = $item['file_upload']->store('public/budgeting_doc_attachments'); //get path of the file
                     $n = explode('/', $pathFile); //split into array using /
                 }
 
                 //insert into database after upload 1 image
                 BudgetingDocumentaryAttachment::create([
                     'budgeting_id' => $data->budgeting_id,
                     'documentary_attachment_id' => $item['documentary_attachment_id'],
                     'doc_attachment' => $n[2]
                 ]);
             }
         }
 
         if($req->has('allotment_classes')){
             $allotmentClasses = [];
             foreach ($req->allotment_classes as $item) {
                 $allotmentClasses[] = [
                     'budgeting_id' => $data->budgeting_id,
                     'allotment_class_id' => $item['allotment_class_id'],
                     'allotment_class_account_id' => $item['allotment_class_account_id'],
                     'amount' => $item['amount'],
                 ];
             }
             BudgetingAllotmentClass::insert($allotmentClasses);
         }
 
         return response()->json([
             'status' => 'saved'
         ], 200);
 
     }


    public function update(Request $req, $id){
    
        $req->validate([
            'format_date_time' => ['required'],
            'training_control_no' => ['required'],
            
            'particulars' => ['required'],

            'format_activity_date' => ['required'],
            'total_amount' => ['required'],
            'payee_id' => ['required'],
           
            'allotment_class_id' => ['required'],
            'allotment_class_account_id' => ['required'],

            'amount' => ['required'],

            'priority_program_id' => ['required'],

            'supplemental_budget' => ['required'],
            'capital_outlay' => ['required'],
            'account_payable' => ['required'],
            'tes_trust_fund' => ['required'],
            'office_id' => ['required'],
        ],[
            'payee_id.required' => 'Please select bank account/payee.',
            'allotment_class_id.required' => 'Please allotment class.',
            'allotment_class_account_id.required' => 'Please allotment class account.',
            'priority_program_id.required' => 'Please select priority program.',
            'office_id.required' => 'Please select office.'
        ]);

        
        Budgeting::where('budgeting_id', $id)
            ->update([
                'date_time' => $req->format_date_time,
            
                'training_control_no' => $req->training_control_no,
                'particulars' => $req->particulars,

                'total_amount' => $req->total_amount,
                'activity_date' => $req->format_activity_date,

                'payee_id' => $req->payee_id,

                'allotment_class_id' => $req->allotment_class_id,
                'allotment_class_account_id' => $req->allotment_class_id,

                'amount' => $req->amount,
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



    
}
