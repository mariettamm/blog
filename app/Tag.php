<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//damos de alta las relaciones entre la aplicación tag y
//el resto de aplicaciones:
class Tag extends Model
{ //Métodos
    //sólo name y slug son rellenables:
    protected $fillable = [
        'name', 'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
        //$esto(tag) -> perteneceAmuchos(Posts)
    }
}

