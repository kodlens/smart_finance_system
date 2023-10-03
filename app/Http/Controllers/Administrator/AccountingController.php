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


    public function getData(){

        $sort = explode('.', $req->sort_by);

        $data = Accounting::where('particulars', 'like', $req->key . '%')
            ->orWhere('transcation_no', 'like', $req->key . '%')
            ->orWhere('training_control_no', 'like', $req->key . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


}
