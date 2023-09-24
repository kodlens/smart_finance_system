<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AllotmentClassAccount;

class AllotmentClassAccountController extends Controller
{
    //

    public function index(){
        return view('administrator.allotment.allotment-class-account');
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        return AllotmentClassAccount::with(['allotment_class'])
            ->where('allotment_class_account_code', 'like', '%' . $req->code . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }
}
