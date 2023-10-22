<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liason extends Model
{
    use HasFactory;

    protected $table = 'liasons';
    protected $primaryKey = 'liason_id';

    protected $fillable = [
        'lname',
        'fname',
        'mname',
        'sex',
    ];

}
