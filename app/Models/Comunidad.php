<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comunidad extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    function posts(){
        return $this->hasMany(Post::class);
    }

    function users(){
        return $this->belongsToMany(User::class);
    }
}
