<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\AccountingAllotmentClasses;
use Illuminate\Http\Request;

use App\Models\Accounting;
use App\Models\AccountingDocumentaryAttachment;

use Illuminate\Support\Facades\Storage;



class AccountingController extends Controller
{
    //

    public function index(){
        return view('administrator.accounting.accounting-index');
    }


    public function getData(Request $req){

        $sort = explode('.', $req->sort_by);

        $data = Accounting::with(['payee', 'acctg_documentary_attachments.documentary_attachment',
            'accounting_allotment_classes'])
            ->where('particulars', 'like', $req->key . '%')
            ->orWhere('transaction_no', 'like', $req->key . '%')
            ->orWhere('training_control_no', 'like', $req->key . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

    public function show($id){
        $data = Accounting::with(['payee', 'acctg_documentary_attachments.documentary_attachment',
            'accounting_allotment_classes.allotment_class', 'accounting_allotment_classes.allotment_class_account',
            'priority_program', 'office'
        ])
            ->find($id);

        return $data;
    }


    public function create(){
        return view('administrator.accounting.accounting-create-edit')
            ->with('id', 0);
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

        $data = Accounting::create([
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
                    $pathFile = $item['file_upload']->store('public/doc_attachments'); //get path of the file
                    $n = explode('/', $pathFile); //split into array using /
                }

                //insert into database after upload 1 image
                AccountingDocumentaryAttachment::create([
                    'accounting_id' => $data->accounting_id,
                    'documentary_attachment_id' => $item['documentary_attachment_id'],
                    'doc_attachment' => $n[2]
                ]);
            }
        }

        if($req->has('allotment_classes')){
            $allotmentClasses = [];
            foreach ($req->allotment_classes as $item) {
                $allotmentClasses[] = [
                    'accounting_id' => $data->accounting_id,
                    'allotment_class_id' => $item['allotment_class_id'],
                    'allotment_class_account_id' => $item['allotment_class_account_id'],
                    'amount' => $item['amount'],
                ];
            }
            AccountingAllotmentClasses::insert($allotmentClasses);
        }

        return response()->json([
            'status' => 'saved'
        ], 200);

    }



    public function edit($id){
        return view('administrator.accounting.accounting-create-edit')
            ->with('id', $id);
    }

    public function updateAccounting(Request $req, $id){

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

        $data = Accounting::where('accounting_id', $id)
            ->update([
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


        if($req->has('allotment_classes')){
            foreach ($req->allotment_classes as $item) {
                if($item['accounting_allotment_class_id'] > 0){
                    AccountingAllotmentClasses::where('accounting_allotment_class_id', $item['accounting_allotment_class_id'])
                        ->update(
                            [
                                'allotment_class_id' => $item['allotment_class_id'],
                                'allotment_class_account_id' => $item['allotment_class_account_id'],
                                'amount' => $item['amount'],
                            ]
                        );
                }else{
                    AccountingAllotmentClasses::create([
                        [
                            'accounting_id' => $req->accounting_id,
                            'allotment_class_id' => $item['allotment_class_id'],
                            'allotment_class_account_id' => $item['allotment_class_account_id'],
                            'amount' => $item['amount'],
                        ]
                    ]);
                }
            }
        }
        return $req;
        return response()->json([
            'status' => 'updated'
        ], 200);

    }







    //delete attachment and image from storage
    public function destroy($id){

        $data = AccountingDocumentaryAttachment::find($id);

        if(Storage::exists('public/doc_attachments/' .$data->doc_attachment)) {
            Storage::delete('public/doc_attachments/' . $data->doc_attachment);
        }

        AccountingDocumentaryAttachment::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);

    }




}
