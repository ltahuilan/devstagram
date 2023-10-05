<?php

namespace App\Models;

use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    /**
     * Eloquent
     * Define an inverse one-to-one or many relationship
     */
    public function user()
    {
        //un post pertence a un usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    /**
     * Eloquent
     * Define a one-to-many relationship
     */
    public function comentarios()
    {
        //un post puede tener multiples comentarios
        return $this->hasMany(Comentario::class);
    }
}
