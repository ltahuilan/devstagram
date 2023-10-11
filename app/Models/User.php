<?php

namespace App\Models;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Eloquent
     * Define a one-to-many relationship
     */
    public function posts()
    {
        //un usuario puede tener muchos posts
        return $this->hasMany(Post::class);
    }

    public function comentario()
    {
        //un usuario puede tener muchos comentarios
        return $this->hasMany(Comentario::class);
    }

    /**
     * Eloquent
     * Define a one-to-many relationship
     * Relación uno a muchos...
     * Un usuario puede tener muchos likes
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

       /**
     * Eloquent
     * Define a many-to-many relationship
     * Relación muchos a muchos...
     * Define cuantos seguidores tiene un usuario
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //define a cuantos sigue un usuario
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    //comprobar si un usuario ya sigue a otro
    public function checkFollowers(User $user)
    {
        
        return $this->followers->contains( $user->id );
    }
}
