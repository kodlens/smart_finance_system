<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementAllotmentClass extends Model
{
    use HasFactory;

    protected $table = 'procurement_allotment_classes';
    protected $primaryKey = 'procurement_allotment_classe_id';


    protected $fillable = [
        'procurement_id',
        'allotment_class_id',
        'allotment_class_account_id',
        'amount',
       
    ];



}
