<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AllotmentClass;

class AllotmentClassController extends Controller
{
    //

    public function index(){
        return view('administrator.allotment.allotment-class');
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        return AllotmentClass::where('allotment_class', 'like', '%' . $req->allotment . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }



}
