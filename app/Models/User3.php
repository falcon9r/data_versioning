<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User3 extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'token',
        'current',
        'old_email',
        'email',
        'id'
    ];
    protected $table = "user3s";
}
