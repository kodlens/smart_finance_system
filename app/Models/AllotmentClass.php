<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotmentClass extends Model
{
    use HasFactory;

    protected $primaryKey = 'allotment_class_id';
    protected $table = 'allotment_classes';

    protected $fillable = [
        'financial_year_id',
        'allotment_class',
        'allotment_class_amount'
    ];

    public function financial_year(){
        return $this->hasOne(FinancialYear::class, 'financial_year_id', 'financial_year_id');
    }

}
