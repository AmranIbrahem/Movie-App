<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    protected $table = 'actor';
    protected $fillable = [
        'name',
        'country',
        'photo',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
