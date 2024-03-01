<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //crearemos 300 posts
            //PERO estos posts van a tener ya una relación con 
            //las etiquetas:                    el parámetro de la función
                                             // es el post que está siendo creado
        factory(App\Post::class, 300)->create()->each(function(App\Post $post) {
            //      creamos 300 posts         y por cada post creado...
            
            $post->tags()->attach([ //adjuntamos los tags a los post mediante attach
                //3 etiquetas de forma aleatoria:
                rand(1,5), 
        		rand(6,14), 
                rand(15,20)
            ]);
        //PERO hay que decirle a laravel de forma explicita
        //que esta relación ahora existe...

        //Y eso se hace yengo a app/post.php y expresando esa relación con las etiquetas ahí
        });
    }
}
