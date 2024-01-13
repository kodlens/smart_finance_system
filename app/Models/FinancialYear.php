<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialYear extends Model
{
    use HasFactory;

    protected $table = 'financial_years';
    protected $primaryKey = 'financial_year_id';


    protected $fillable = [
        'financial_year_code', 
        'financial_year_desc',
        'financial_budget',
        'active'
    ];


}
