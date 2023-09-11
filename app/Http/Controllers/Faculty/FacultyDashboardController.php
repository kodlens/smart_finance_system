<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacultyDashboardController extends Controller
{
    //

    public function index(){
        return view('faculty.faculty-dashboard-n');
    }
}
