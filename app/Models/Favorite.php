<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    protected $fillable = [
        'series_id',
        'user_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
