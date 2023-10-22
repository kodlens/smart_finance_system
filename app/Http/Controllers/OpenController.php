<?php

namespace App\Http\Controllers;

use App\Models\DocumentaryAttachment;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use App\Models\AcademicYear;
use App\Models\AllotmentClass;
use App\Models\Office;

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

    public function loadAllotmentClasses(Request $req){
        return AllotmentClass::orderBy('allotment_class', 'asc')
            ->get();
    }

    public function loadTransactionTypes(Request $req){
        return TransactionType::orderBy('transaction_type', 'asc')
            ->get();
    }

    public function loadDocumentaryAttachments(Request $req){
        return DocumentaryAttachment::orderBy('documentary_attachment', 'asc')
            ->get();
    }




}
