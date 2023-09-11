<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\AcademicYear;

class OpenController extends Controller
{
    //

    public function loadOffices(Request $req){
        return Office::orderBy('office', 'asc')
            ->get();
    }


    public function loadAcadYears(Request $req){
        return AcademicYear::orderBy('academic_year_code', 'desc')
            ->get();
    }

}
