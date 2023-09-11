<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class FacultyController extends Controller
{
    //
    public function index(){
        return view('administrator.faculty.faculty-page');
    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = User::where('lname', 'like', $req->lname . '%')
            ->where('role', 'FACULTY')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }
}
