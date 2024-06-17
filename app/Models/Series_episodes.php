<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series_episodes extends Model
{
    use HasFactory;
    protected $fillable = [
        'number_episodes',
        'video',
        'photo',
        'id_series',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
