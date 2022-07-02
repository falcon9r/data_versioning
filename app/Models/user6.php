<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user6 extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname' , 
        'token',
        'dept_id',
        'position_id',
        'date_start',
        'date_end',
        'current'
    ];
}
