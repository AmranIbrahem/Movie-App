<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class series extends Model
{
    use HasFactory;
    protected $table = 'series';

    protected $fillable = [
        'title',
        'summary',
        'release_date',
        'video',
        'director',
        'category_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function get_series_episodes()
    {
        return $this->hasMany(
            'App\Models\Series_episodes',
            'id_series',
            'id'
        );
    }
}
