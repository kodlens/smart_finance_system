<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotmentClassAccount extends Model
{
    use HasFactory;

    
    protected $table = 'allotment_class_accounts';
    protected $primaryKey = 'allotment_class_account_id';


    protected $fillable = [
        'allotment_class_id', 
        'allotment_class_account_code', 
        'allotment_class_account'
    ];


    public function allotment_class(){
        return $this->hasOne(AllotmentClass::class, 'allotment_class_id', 'allotment_class_id');
    }

    
}
