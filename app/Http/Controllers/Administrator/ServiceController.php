<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    //

    public function index(){
        return view('administrator.service.service-index');
    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        return Service::with(['financial_year'])
            ->whereHas('financial_year', function($q)use($req){
                $q->where('financial_year_id', $req->financial);
            })
            ->where('service', 'like', '%'. $req->service . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }


}
