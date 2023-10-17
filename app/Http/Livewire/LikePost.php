<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    public function mount($post)
    {
        //verificar si el usuario autenticado dio like al post visitado
        $this->isLiked = $post->checkLike( auth()->user());

        //contar los likes del post visitado
        $this->likes = $post->likes()->count();
    }

    public function like()
    {

        //comprobar si el usuario autenticado ya dió like, true: elimina el like, false: guarda el like        
        if ( $this->post->checkLike( auth()->user() )) {
            
            //Elimina el registro donde encuentre la relacion con el usuario autenticado
            $this->post->likes()->where( 'user_id', auth()->user()->id )->delete();

            $this->isLiked = false;
            $this->likes--;
            
        }else {
            $this->post->likes()->create( ['user_id' => auth()->user()->id] );

            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
