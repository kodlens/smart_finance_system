<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $table = 'procurements';
    protected $primaryKey = 'procurement_id';


    protected $fillable = [
        'date_time', 
        'training_control_no',
        'pr_number',
        'particulars',
        'pr_amount',
        'payee_id',
        'pr_status',
        'remarks',
        'allotment_class_id',
        'allotment_class_account_id',
        'priority_program_id',
        'supplemental_budget',
        'capital_outlay',
        'account_payable',
        'tes_trust_fund',
        'others',
        'office_id',
    ];



    public function allotment_class(){
        return $this->hasOne(AllotmentClass::class, 'allotment_class_id', 'allotment_class_id');
    }

    public function allotment_class_account(){
        return $this->hasOne(AllotmentClassAccount::class, 'allotment_class_account_id', 'allotment_class_account_id');
    }


    public function payee(){
        return $this->hasOne(Payee::class, 'payee_id', 'payee_id');
    }

    public function office(){
        return $this->hasOne(Office::class, 'office_id', 'office_id');
    }



}
