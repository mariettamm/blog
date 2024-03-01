<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function pass(User $user, Post $post) 
                        //le pasamos los diferentes argumentos:
                        //entidad usuario $variable user,
                        //entidad Post $variable post
    {   //Y esto es simplemente una comparación que 
        //retornará verdadero o falso
        return $user->id == $post->user_id;
        //el id del usuario TIENE que ser 
        //exactamente igual al id de usuario del post
    }
    //la protección se hace realmente método a método
}