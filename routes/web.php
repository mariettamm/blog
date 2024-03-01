<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Redirección:
Route::redirect('/', 'blog');
// ^ yo quiero que al momento de acceder a la ruta raíz,
//haya una redirección hacia blog

// Route::get('/', function () {
//     return redirect()->route('blog');
// });

Auth::routes();

//WEB (rutas que tienen que ver con la parte web (del cliente))
    //Esta es la ruta de la vista de la LISTA de posts
    Route::get('/blog', 'Web\PageController@blog')->name('blog');
            //el controlador está en web\pagecontroller
            //señalan al método blog
            //para que el redirect funcione se necesita un controlador
            //y un método
            //y tiene como nombre "blog"
            //los controlladores están en http dentro de la carpeta app

    //Esta es la ruta de la vista de UN post individual
    Route::get('blog/{slug}', 'Web\PageController@post')->name('post');
            //^ blog es un parámetro fijo
            //pero slug es un parámetro dinámico
            //(depende del post) así que va entre
            //llaves

//backend?
    Route::get('/category/{slug}', 'Web\PageController@category')->name('category');
    Route::get('/tag/{slug}', 'Web\PageController@tag')->name('tag');

//admin (rutas que tienen que ver con la parte administrativa))
    //rutas que se muestran tras loggearse
    Route::resource('tags', 		'Admin\TagController');
    Route::resource('categories', 	'Admin\CategoryController');
    Route::resource('posts', 		'Admin\PostController');

//NOTA: podemos cambiar los terminos post, category y tag en los get de las rutas
//por entrada categoría y etiqueta para que funcoine mejor el seo si nuestro publico
//es de habla hispana
//(esto se puede cambiar pq no es nada interno)
//los metodos no se pueden traducir porque son internos y rompería el código