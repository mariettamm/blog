<?php

use Faker\Generator as Faker;
     //tenemos que definir el modelo
$factory->define(App\Category::class, function (Faker $faker) {
        //damos de alta la variable:
        $title = $faker->sentence(4); 
        //faker creará un texto de 4 palabras
    
    return [
        //los mismos campos que en la tabla 
        //categorias (para rellenarla obvio)
        'name' => $title, //usamos una variable porque luego será usada para el slug
        'slug' => str_slug($title), //convertimos la string de title a slug
        'body' => $faker->text(500), //faker crea por nosotros un texto de 500 caracteres

    ];
});
