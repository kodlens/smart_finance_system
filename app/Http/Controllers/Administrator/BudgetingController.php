<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\BudgetingAllotmentClass;
use Illuminate\Http\Request;
use App\Models\Budgeting;
use App\Models\BudgetingDocumentaryAttachment;
use Illuminate\Support\Facades\Storage;

class BudgetingController extends Controller
{
    //


    public function index(){
        return view('administrator.budgeting.budgeting-index');
    }


    public function show($id){
        $data = Budgeting::with(['payee', 'budgeting_documentary_attachments.documentary_attachment',
            'budgeting_allotment_classes.allotment_class', 'budgeting_allotment_classes.allotment_class_account',
            'priority_program', 'office'
        ])
            ->find($id);

        return $data;
    }


    public function getData(Request $req){

        $sort = explode('.', $req->sort_by);

        $data = Budgeting::with(['fund_source', 'payee', 'budgeting_documentary_attachments.documentary_attachment',
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
            'fund_source_id' => ['required'],
            'date_time' => ['required'],
            'transaction_no' => ['required'],
            'training_control_no' => ['required'],
            'transaction_type_id' => ['required'],
            'payee_id' => ['required'],
            'particulars' => ['required'],
            'total_amount' => ['required'],
            'office_id' => ['required']

        ],[
            'financial_year_id.required' => 'Please select financial year.',
            'transaction_type_id.required' => 'Please select transaction.',
            'payee_id.required' => 'Please select bank account/payee.',
            'allotment_class_id.required' => 'Please allotment class.',
            'allotment_class_account_id.required' => 'Please allotment class account.',
            'office.required' => 'Please select office.',

        ]);

         $data = Budgeting::create([
             'financial_year_id' => $req->financial_year_id,
             'fund_source_id' => $req->fund_source_id,
             'date_time' => $req->date_time,
             'transaction_no' => $req->transaction_no,
             'training_control_no' => $req->training_control_no,
             'transaction_type_id' => $req->transaction_type_id,
             'payee_id' => $req->payee_id,
             'particulars' => $req->particulars,
             'total_amount' => $req->total_amount,
             //naa pai attachment
             'priority_program_id' => $req->priority_program_id,
             'others' => $req->others,
             'office_id' => $req->office_id

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


    public function updateBudgeting(Request $req, $id){

        $req->validate([
            'financial_year_id' => ['required'],
            'fund_source_id' => ['required'],
            'date_time' => ['required'],
            'transaction_no' => ['required'],
            'training_control_no' => ['required'],
            'transaction_type_id' => ['required'],
            'payee_id' => ['required'],
            'particulars' => ['required'],
            'total_amount' => ['required'],
            'office_id' => ['required']
        ],[
            'financial_year_id.required' => 'Please select financial year.',
            'fund_source_id.required' => 'Please select financial year.',
            'transaction_type_id.required' => 'Please select transaction.',
            'payee_id.required' => 'Please select bank account/payee.',
            'office_id.required' => 'Please select office.'
        ]);

        $data = Budgeting::find($id);

        $data->financial_year_id = $req->financial_year_id;
        $data->fund_source_id =  $req->fund_source_id;
        $data->date_time =  $req->date_time;
        $data->transaction_no =  $req->transaction_no;
        $data->training_control_no =  $req->training_control_no;
        $data->transaction_type_id =  $req->transaction_type_id;
        $data->payee_id =  $req->payee_id;
        $data->particulars =  $req->particulars;
        $data->total_amount =  $req->total_amount;
        $data->priority_program_id =  $req->priority_program_id ? $req->priority_program_id : null;
        $data->office_id =  $req->office_id;
        $data->others =  $req->others;
        $data->save();

        if($req->has('documentary_attachments')){
            foreach ($req->documentary_attachments as $item) {

                $path = null;
                if($item['file_upload'] && is_file($item['file_upload'])){

                    $pathFile = $item['file_upload']->store('public/budgeting_doc_attachments'); //get path of the file
                    $n = explode('/', $pathFile); //split into array using /
                    $path = $n[2];
                    BudgetingDocumentaryAttachment::create(
                        [
                            'budgeting_id' => $data->budgeting_id,
                            'documentary_attachment_id' => $item['documentary_attachment_id'],
                            'doc_attachment' => is_file($item['file_upload']) ? $path : $data->doc_attachment
                        ]);
                }
                //insert into database after upload 1 image
            }
        }


        if($req->has('allotment_classes')){
            foreach ($req->allotment_classes as $item) {
                BudgetingAllotmentClass::updateOrCreate([
                    'budgeting_allotment_class_id' => $item['budgeting_allotment_class_id']
                ],[
                    'budgeting_id' => $id,
                    'allotment_class_id' => $item['allotment_class_id'],
                    'allotment_class_account_id' => $item['allotment_class_account_id'],
                    'amount' => $item['amount'],
                ]);
            }
        }

       return response()->json([
           'status' => 'updated'
       ], 200);

    }



    public function deleteDocAttachment($id){

        $data = BudgetingDocumentaryAttachment::find($id);

        // $attchments = AccountingDocumentaryAttachment::where('accounting_id', $data->accounting_id)
        //         ->get();
        if(Storage::exists('public/budgeting_doc_attachments/' . $data->doc_attachment)) {
            Storage::delete('public/budgeting_doc_attachments/' . $data->doc_attachment);
        }

        BudgetingDocumentaryAttachment::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);

    }




}
