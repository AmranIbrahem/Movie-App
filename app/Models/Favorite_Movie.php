<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite_Movie extends Model
{
    use HasFactory;
    protected $table = 'favorite__movies';
    protected $fillable = [
        'movie_id',
        'user_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
