<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
 
	$title = $faker->unique()->word(5);
     //el título en este caso será único (irrepetible),
     //y será una palabra de 5 caracteres
    return [

        'name' => $title, //usamos una variable porque luego será usada para el slug
        'slug' => str_slug($title), //convertimos la string de title a slug 
    
        //Lógica:
    //1- genera la palabra
    //2- esa palabra name la toma para convertirla en el titulo
    //3- y el titulo se convierte en slug
    ];
});