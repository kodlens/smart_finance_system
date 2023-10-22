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
        'date_time', 
        'transcation_no',
        'training_control_no',
        'transaction_type',
        'payee',
        'particulars',
        'total_amount',
        'allotment_class',
        'account',
        'account_code',
        'amount',
        'priority_program',
        'pp_account_code',
        'suplemental_budget',
        'capital_outlay',
        'accounts_payable',
        'tes_trust_fund',
        'others'
    ];


    public function documentary_attachments(){
        return $this->hasMany(DocumentaryAttachment::class, 'accounting_id', 'accounting_id');
    }

    
    public function payee(){
        return $this->hasOne(Payee::class, 'payee_id', 'payee_id');
    }





}
