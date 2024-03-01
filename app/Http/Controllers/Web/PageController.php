<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Llamamos a entidad de los posts
use App\Post; 
use App\Category; //llamamos a la entidad de las categorías tb

//Este controlador es el que recoge toda la informacion de las tablas de la BBDD
//y se las devuelve a las vistas para que puedan visualizarlas en la página web
class PageController extends Controller
{
    //creamos el método blog, para que la ruta pueda cargar los elementos de la lista de posts desde la BBDD
    public function blog(){ 
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
                //esta variable es = a la entidad post
                //ordenadas con el id descendente, (el mas reciente es el 1º q sale), 
                //SIEMPRE Y CUANDO (->where) el status = publicado ('status','published')
                //y estos posts se tienen que paginar de 3 en 3 (paginate(3))
        
        return view('web.posts', compact('posts'));
        //^ estamos retornando la vista de posts.blade.php , pero pasamos $posts
        // (AAAH YA ENTIENDO, WEB.POSTS FUNCIONA PORQUE SE SOBRE ENTIENDE
        // CON BLADE.PHP QUE ES UNA VISTA, POR LO QUE NO SE NECESITA ESPECIFICAR
        // TODA LA RUTA WEB/POSTS.BLADE.PHP)
        //SIN EMBARGO, hay que editar esa vista posts.blade.php
        //en la carpeta views, ya que esto por sí solo no va a mostrar nada

            }
        
        //método category, para que la ruta que enlaza las categorias pueda mostrar
        //todos los posts bajo una misma categoría
    public function category($slug){
                //Cómo funciona este métodoDB:
                // necesitamos primero contesguir la CATEGORÍA
                // para conseguir que todos los posts que se llamen a continuación
                // tengan relación con esa categoría:
        
        $category = Category::where('slug', $slug)->pluck('id')->first();
                // ^ por el category::where se tiene que dar de alta la clase arriba (para que se pueda utilizar)
            //usamos pluck en lugar de first porque first devuelve la tabla completa y solo queremos el id
            //sin embargo tb utilizamos first. "First dice que utilicemos el registro pero pluck dice que simplemente obtengamos el id
        $posts = Post::where('category_id', $category)
                // post SIEMPRE Y CUANDO el valor 'category_id' sea igual a la categoría
                ->orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
                // post SIEMPRE Y CUANDO el valor 'category_id' sea igual a la categoría
        // $posts = de los que tengan relación con esta categoría (category_id), 
        // lístame todos esos
        return view('web.posts', compact('posts'));
        //y retornamos todos los posts a la misma vista que
        //en el método blog nos retornó una lista de TODOS los posts
        //en el método category solo nos devuelve una lista de todos los posts bajo la misma categoría

    }

    public function tag($slug){ 
        //aunque en el metodo tag también esperamos un slug, la relación es diferente
        //porque se traga de un método de muchos a muchos
        $posts = Post::whereHas('tags', function($query) use ($slug) {
            // ^ aquí tb necesito que me consiga todos los posts pero la consulta es diferente (muchos a muchos)
            // $posts = consigueme el Post:: dondeTenga ('etiquetas' $query=que usen un slug)...
            $query->where('slug', $slug);
            //... $query->donde ese slug sea EL slug que estoy pasando
        })
        
        ->orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        // ^ esto sigue siendo igual que siempre es solo como queremos que sea publicado

        return view('web.posts', compact('posts'));
    }

    //método post para que la ruta pueda recoger toda la info para la pagina de 1 post
    public function post($slug){ //recibimos como parámetro la variable $slug que especificamos en la ruta del post
        $post = Post::where('slug', $slug)->first(); //usamos el método first pq estamos hablando de 1 unico post
                //obtén el post EN BASE del parámetro que hemos mandado

        return view('web.post', compact('post'));
        //retornamos la vista post que está en la carpeta web
    }
    
        
}
