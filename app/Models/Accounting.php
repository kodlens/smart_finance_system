<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    use HasFactory;


    protected $table = 'accountings';
    protected $primaryKey = 'accounting_id';


    protected $fillable = [
        'financial_year_id',
        'fund_source_id',
        'date_time',
        'transaction_no',
        'training_control_no',
        'transaction_type_id',
        'payee_id',
        'particulars',
        'total_amount',
        'priority_program_id',
        'office_id',
        'others',
        'processor_id',

        'processor_datetime_received',

        'bids_award_datetime_forwarded',
        'bids_award_datetime_retrieved',
        'bids_award_status',
        'bids_award_remarks',

        'city_budget_datetime_forwarded',
        'city_budget_datetime_retrieved',
        'city_budget_status',
        'city_budget_remarks',

        'city_accounting_datetime_forwarded',
        'city_accounting_datetime_retrieved',
        'city_accounting_status',
        'city_accounting_remarks',

        'city_treasurer_datetime_forwarded',
        'city_treasurer_datetime_retrieved',
        'city_treasurer_status',
        'city_treasurer_remarks',

        'college_accounting_datetime_updated',
        'final_status',
        'final_remarks'

    ];


    public function financial_year(){
        return $this->hasMany(FinancialYear::class, 'financial_year_id', 'financial_year_id');
    }

    public function fund_source(){
        return $this->hasOne(FundSource::class, 'fund_source_id', 'fund_source_id');
    }


    public function documentary_attachments(){
        return $this->hasMany(DocumentaryAttachment::class, 'accounting_id', 'accounting_id');
    }


    public function acctg_documentary_attachments(){
        return $this->hasMany(AccountingDocumentaryAttachment::class, 'accounting_id', 'accounting_id');
    }

    public function accounting_allotment_classes(){
        return $this->hasMany(AccountingAllotmentClasses::class, 'accounting_id', 'accounting_id')
            ->with(['allotment_class', 'allotment_class_account']);
    }




    public function payee(){
        return $this->hasOne(Payee::class, 'payee_id', 'payee_id');
    }


    public function priority_program(){
        return $this->hasOne(PriorityProgram::class, 'priority_program_id', 'priority_program_id');
    }

    public function office(){
        return $this->hasOne(Office::class, 'office_id', 'office_id');
    }


    public function processor(){
        return $this->hasOne(User::class, 'user_id', 'processor_id');
    }



}
