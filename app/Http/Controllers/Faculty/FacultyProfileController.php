<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class FacultyProfileController extends Controller
{
    //

    public function index(){
        //$user = Auth::user()->load('office');
        //return $user;

        return view('faculty.faculty-profile-n');
    }

    public function facultyProfileInfo(){
        $user = Auth::user()->load(['office', 'province', 'city', 'barangay']);
        return $user;
    }

    public function update(Request $req, $id){
        //return $id;

        $data = User::find($id);
        $data->lname = strtoupper($req->lname);
        $data->fname = strtoupper($req->fname);
        $data->mname = strtoupper($req->mname);
        $data->suffix = strtoupper($req->suffix);
        $data->sex = strtoupper($req->sex);
        $data->civil_status = strtoupper($req->civil_status);
        $data->office_id = $req->office_id;
        $data->contact_no = $req->contact_no;

        $data->province = $req->province;
        $data->city = $req->city;
        $data->barangay = $req->barangay;
        $data->street = strtoupper($req->street);

        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }
}