<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
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
     * Relación uno a uno...
     * Un post pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username', 'imagen']);
    }

    /**
     * Eloquent
     * Define a one-to-many relationship
     * Relacion uno a muchos...
     * Un post puede teber muchos comentarios
     */
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    /**
     * Eloquent
     * Define a one-to-many relationship
     * Relación uno a muchos...
     * Un pos puede tener muchos likes
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Verifica si un usuario ya dió like
     */
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
