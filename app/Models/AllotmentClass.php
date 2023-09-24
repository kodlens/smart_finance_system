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
        'allotment_class'
    ];

   

}
