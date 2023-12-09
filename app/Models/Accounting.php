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
        'fund_source',
        'date_time',
        'transaction_no',
        'training_control_no',
        'transaction_type_id',
        'payee_id',
        'particulars',
        'total_amount',

        'priority_program_id',
        'priority_program',
        'priority_program_code',
        'pp_account_code',

        'others'
    ];


    public function financial_year(){
        return $this->hasMany(FinancialYear::class, 'financial_year_id', 'financial_year_id');
    }

    public function documentary_attachments(){
        return $this->hasMany(DocumentaryAttachment::class, 'accounting_id', 'accounting_id');
    }


    public function acctg_documentary_attachments(){
        return $this->hasMany(AccountingDocumentaryAttachment::class, 'accounting_id', 'accounting_id');
    }

    public function accounting_allotment_classes(){
        return $this->hasMany(AccountingAllotmentClasses::class, 'accounting_id', 'accounting_id');
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




}
