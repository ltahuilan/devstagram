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
     * Relationship posts->user
     * un post PERTENECE A un usuario
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship post->comentario
     * un post TIENE MUCHOS comentariosa
     */
    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }

    /**
     * Relationship post->likes
     * un post TIENE MUCHOS likes
     */
    public function likes() {
        return $this->hasMany(Like::class);
    }

    /**
     * verifica si la tabla de likes contiene el user_id del usuario con la sesión activa
     * la cual esta asociada al post
     */
    public function checkLikes(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }
}
