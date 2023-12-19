<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundSource extends Model
{
    use HasFactory;


    
    protected $table = 'fund_sources';
    protected $primaryKey = 'fund_source_id';


    protected $fillable = ['fund_source'];

    
}
