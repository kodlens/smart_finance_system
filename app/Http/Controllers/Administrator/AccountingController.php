<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Accounting;
use App\Models\AccountingDocumentaryAttachment;

class AccountingController extends Controller
{
    //

    public function index(){
        return view('administrator.accounting.accounting-index');
    }


    public function getData(Request $req){

        $sort = explode('.', $req->sort_by);

        $data = Accounting::with(['payee', 'acctg_documentary_attachments.documentary_attachment'])
            ->where('particulars', 'like', $req->key . '%')
            ->orWhere('transaction_no', 'like', $req->key . '%')
            ->orWhere('training_control_no', 'like', $req->key . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function create(){
        return view('administrator.accounting.accounting-create-edit');
    }

    public function store(Request $req){
        
        $req->validate([
            'date_time' => ['required'],
            'transaction_no' => ['required'],
            'training_control_no' => ['required'],
            'transaction_type_id' => ['required'],
            'payee_id' => ['required'],
            'particulars' => ['required'],
            'total_amount' => ['required'],
            'allotment_class_id' => ['required'],
            'allotment_class_account_id' => ['required'],
            'amount' => ['required'],
            'priority_program_id' => ['required'],
            'supplemental_budget' => ['required'],
            'capital_outlay' => ['required'],
            'account_payable' => ['required'],
            'tes_trust_fund' => ['required'],
        ],[
            'transaction_type_id.required' => 'Please select transaction.',
            'payee_id.required' => 'Please select bank account/payee.',
            'allotment_class_id.required' => 'Please allotment class.',
            'allotment_class_account_id.required' => 'Please allotment class account.',
            'priority_program_id.required' => 'Please select priority program.'

        ]);

        
        $data = Accounting::create([
            'date_time' => $req->date_time,
            'transaction_no' => $req->transaction_no,
            'training_control_no' => $req->training_control_no,
            'transaction_type_id' => $req->transaction_type_id,
            'payee_id' => $req->payee_id,
            'particulars' => $req->particulars,
            'total_amount' => $req->total_amount,

            //naa pai attachment

            'allotment_class_id' => $req->allotment_class_id,

            'allotment_class_account_id' => $req->allotment_class_id,
            'allotment_class_account' => $req->allotment_class_account,
            'allotment_class_account_code' => $req->allotment_class_account_code,

            'amount' => $req->amount,
            'priority_program_id' => $req->priority_program_id,
            'priority_program' => $req->priority_program,
            'priority_program_code' => $req->priority_program_code,
            'supplemental_budget' => $req->supplemental_budget,
            'capital_outlay' => $req->capital_outlay,
            'account_payable' => $req->account_payable,
            'tes_trust_fund' => $req->tes_trust_fund,
            'others' => $req->others
        ]);


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

       return response()->json([
           'status' => 'saved'
       ], 200);

    }

}
