<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'category';

    protected $fillable = [
        'description',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function getMovie(){
        return $this->hasMany(
            'App\Models\movies',
            'category_id',
            'id'
        );
    }
    public function getSeries(){
        return $this->hasMany(
            'App\Models\series',
            'category_id',
            'id'
        );
    }

}
