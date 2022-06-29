<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User4_history extends Model
{
    use HasFactory;
    protected $table = 'user4s_history';
    protected $fillable = [
        'name',
        'surname' , 
        'token',
        'dept_id',
        'date_start',
        'date_end',
        'position_id',
    ];
}
