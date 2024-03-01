<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Estamos dando de alta las relaciones 
//entre los elementos usando métodos
class Post extends Model
{

// MÉTODOS para programar como los otros
//  elementos del blog se relacionan con los posts del blog:

    //a parte de la función de los tags programamos 
    // el resto de funciones (métodos) necesarios para que 
    // las vistas funciones bien:

    //y aquí estamos dando de alta 
    //la propiedad FILLABLE
    // que permite salvar dados de forma masiva
    protected $fillable = [
        //aquí vamos a dar de alta 
        //todas las columnas que hay en la tabla "Post"
        //y que va permitir guardar todos sus datos de forma massiva:
     
            'user_id', 'category_id', 'name', 'slug', 'excerpt', 'body', 'status', 'file'
        // Lo que estamos haciendo dentro de esta propiedad es crear un ARRAY
        // que permite mandar los datos como formulario (así es como los mandamos masivamente)

        //esto lo hacemos para proteger nuestra aplicación de que 
        //alguien fuerce a que se guarde algo en algun campoq que no esté 
        // forme parte de este array

        //ergo, por eso se llama "fillable", porque estos campos se pueden rellenar.

    ];

    //un post pertenece a una categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // un post pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
                //this (en este contexto estamos en la entidad post, así que post)
                //esto -> perteneceA la (la clase::un Usuario)
    }


    //este método en particular que programa la relación con
    // las etiquetas (tags)
    // relaciona los posts con los tags
    //para que los seeders hagan etiquetas para los posts:
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
                //esto (post) pertenece a/tiene muchos tags
    }
}
