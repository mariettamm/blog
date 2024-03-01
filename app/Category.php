<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//lo mismo que en post damos de alta 
// las relaciones entre los otros elementos y la categoría
class Category extends Model
{ // MÉTODOS:
    //solo son rellenables (fillable) los campos name, slug y body:
    protected $fillable = [
        'name', 'slug', 'body'
    ];

    //una categoría puede tener muchos posts
    public function posts()
    {
        return $this->hasMany(Post::class);
        //esto (esta aplicación) -> tieneMuchos (pero no pertenece a como los tags) (Posts)
        //se usa en categoría hasMany en lugar de belongsToMany
        //porque NO es una relación de muchos a muchos
        //es sólo 1 que tiene muchos
    }
}
