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
        'priority_program', 
        'priority_program_code',
    ];



}
