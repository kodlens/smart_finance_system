<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriorityProgram extends Model
{
    use HasFactory;

    protected $table = 'priority_programs';
    protected $primaryKey = 'priority_program_id';


    protected $fillable = [
        'financial_year_id',
        'priority_program', 
        'priority_program_code',
        'priority_program_budget'

    ];



}
