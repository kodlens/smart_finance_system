<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budgeting extends Model
{
    use HasFactory;




    protected $table = 'budgetings';
    protected $primaryKey = 'budgeting_id';


    protected $fillable = [
        'financial_year_id',
        'fund_source',
        'date_time',
        'transaction_no',
        'training_control_no',
        'transaction_type_id',
        'payee_id',
        'particulars',
        'total_amount',
        'priority_program_id',
        'office_id',
        'others'
    ];


    public function financial_year(){
        return $this->hasMany(FinancialYear::class, 'financial_year_id', 'financial_year_id');
    }


    public function fund_source(){
        return $this->hasMany(Fund::class, 'fund_source_id', 'fund_source_id');
    }



    public function budgeting_documentary_attachments(){
        return $this->hasMany(BudgetingDocumentaryAttachment::class, 'budgeting_id', 'budgeting_id');
    }


    public function budgeting_allotment_classes(){
        return $this->hasMany(BudgetingAllotmentClass::class, 'budgeting_id', 'budgeting_id')
            ->with(['allotment_class', 'allotment_class_account']);
    }


    public function payee(){
        return $this->hasOne(Payee::class, 'payee_id', 'payee_id');
    }

    public function priority_program(){
        return $this->hasOne(PriorityProgram::class, 'priority_program_id', 'priority_program_id');
    }


    public function allotment_class(){
        return $this->hasOne(AllotmentClass::class, 'allotment_class_id', 'allotment_class_id');
    }

    public function allotment_class_account(){
        return $this->hasOne(AllotmentClassAccount::class, 'allotment_class_account_id', 'allotment_class_account_id');
    }

    public function office(){
        return $this->hasOne(Office::class, 'office_id', 'office_id');
    }

}
