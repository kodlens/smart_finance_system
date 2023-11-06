<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Accounting;

class AccountingController extends Controller
{
    //

    public function index(){
        return view('administrator.accounting.accounting-index');
    }


    public function getData(Request $req){

        $sort = explode('.', $req->sort_by);

        $data = Accounting::where('particulars', 'like', $req->key . '%')
            ->orWhere('transcation_no', 'like', $req->key . '%')
            ->orWhere('training_control_no', 'like', $req->key . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function create(){
        return view('administrator.accounting.accounting-create-edit');
    }

    public function store(Request $req){
        return $req;
        $req->validate([
            'date_time' => ['required'],
            'transaction_no' => ['required'],
            'training_control_no' => ['required'],
            'transaction_type_id' => ['required'],

        ]);

        Accounting::create([
            'date_time' => $req->date_time,
            'transaction_no' => $req->transaction_no,
            'training_control_no' => $req->training_control_no,
            'transaction_type_id' => $req->transaction_type_id,
            'payee_id' => $req->payee_id,
            'particulars' => $req->particulars,
            'total_amount' => $req->total_amount,

            //naa pai attachment

        ]);


//        return response()->json([
//            'status' => 'saved'
//        ], 200);
    }

}
