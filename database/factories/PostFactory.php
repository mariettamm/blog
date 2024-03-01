<?php

use Faker\Generator as Faker;

    //se tiene que definir el modelo
     // a App\Post 
$factory->define(App\Post::class, function (Faker $faker) {

    $title = $faker->sentence(4); 
        
    return [

        'user_id' 		=> rand(1,30), //un id al usuario de forma aleatoria entre 1 y 30
        'category_id' 	=> rand(1,20), // ^
        'name' => $title, //usamos una variable porque luego será usada para el slug
        'slug' => str_slug($title), //convertimos la string de title a slug
        'excerpt' 		=> $faker->text(200), //el extracto, un texto de 200 characteres
        'body' => $faker->text(500), //faker crea por nosotros un texto de 500 caracteres
        'file' 			=> $faker->imageUrl($width = 1200, $height = 400), //una imagen aleatoria con las dimensiones especificadas
        'status'        => $faker->randomElement(['DRAFT', 'PUBLISHED'])
                        // para hacer el random element para elegir entre draft y publicado, usamos un array
    ];
});

//      //se tiene que definir el modelo
//      // a App\Post 
// $factory->define(App\Post::class, function (Faker $faker) {
//     $title = $faker->sentence(4);
//     $users = App\User::pluck('id')->toArray(); //Aquí cogemos los id que hay en la tabla users
//     $categories = App\Category::pluck('id')->toArray(); // Lo mismo con categoria
//     return [
//         'user_id' => $faker->randomElement($users), //Al ser un faker necesitamos que este número exista en la columna id de la tabla users
//         'category_id' => $faker->randomElement($categories), //Lo mismo con categorias
//         'name' => $title,
//         'slug' => Str_slug($title, '-'),
//         'excerpt' => $faker->text(200), //el extracto, un texto de 200 chr
//         'body' => $faker->text(500),
//         'file' => $faker->imageUrl($width = 1200, $height = 400),
//         'status' => $faker->randomElement(['DRAFT', 'PUBLISHED']),
//                        // ^ para hacer el random element para elegir entre draft y publicado, usamos un array
//     ];
// });


// COMENTADO POR QUE DABA ERROR 


// SQLSTATE[HY000]: General error: 1364 Field 'category_id' doesn't have a defaul
// t value (SQL: insert into `post_tag` (`post_id`, `tag_id`) values (1, 2), (1,
// 6), (1, 18))
