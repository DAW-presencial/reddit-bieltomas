<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'contenido',
        'likes',
        'dislikes'
    ];

    function user(){
        return $this->belongsTo(User::class);
    }

    function comunidad(){
        return $this->belongsTo(Comunidad::class);
    }

    function comentario(){
        return $this->hasMany(Comentario::class);
    }
}
