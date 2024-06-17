<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movies extends Model
{
    use HasFactory;
    protected $table = 'movies';

    protected $fillable = [
        'title',
        'summary',
        'release_date',
        'video',
        'director',
        'category_id',
        'main_photo'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
