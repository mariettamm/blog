<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest; //el archivo de creación/guardado de entradas
use App\Http\Requests\PostUpdateRequest;//el archivo de actualización de entradas

use App\Http\Controllers\Controller;

//llamamos a la clase de almacenado para poder subir imágenes
use Illuminate\Support\Facades\Storage; 

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')
        // Comentado porque no me dejaba guardar entradas:
            ->where('user_id', auth()->user()->id)
            //"traeme todos los articulos, SIEMPRE Y CUANDO el id de usuario
            // sea el id delusuario autentificado en esa sesión
            //aquí le estamos indicando que me traiga SOLO mis articulos
            ->paginate();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')
                    //ordename las categorias por los nombes de forma
                    //ascendente
        ->pluck('name', 'id');
        //solo necesito el nombre y el id porque vamos a pasar todoe sto
        //a un select así que se lo pido al método pluck
        $tags       = Tag::orderBy('name', 'ASC')->get();
        //vamos a implementar los tags en un checkbox los traemos
        //utilizando get
        //(en la vista lo organizaremos a través de un @foreach)
        return view('admin.posts.create',
                 compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $post = Post::create($request->all()); //Creamos un post
        // $this->authorize('pass', $post);

        //Si tenemos una IMAGEN, 
        if($request->file('file')){ //si la request trae una imagen...
            $path = Storage::disk('public') //la vamos a subir a la ruta de public especificada
                    ->put('image',  //vamos a ponerla en una carpeta que se va a llamar image
                    $request->file('file'));
                    //y de allí vamos a registrar la imagen en el campo file
            $post->fill(['file' => asset($path)])->save();
            //y aquí abajo vamos a actualizar el post
            //el helper asset ayuda a recuperar la ruta completa no la relativa
        }

        //TAGS
        $post->tags()->attach($request->get('tags'));
        //sincroniza perfectamente la relación entre post y etiquetas
        //al guardar usamos attach para crear la relación

        return redirect()->route('posts.edit', $post->id)->with('info', 'Entrada creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        // $this->authorize('pass', $post);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //se tiene que dar de alto la 
        //politica de seguridad en un service provider ante nada
        $post       = Post::find($id);
        $this->authorize('pass', $post);  //'pass' es solo el nombre del método, no el password lol
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags       = Tag::orderBy('name', 'ASC')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id); //buscamos el post
        $this->authorize('pass', $post);

        $post->fill($request->all())->save(); //actualizamos el post

        //Si tenemos una IMAGEN...
        if($request->file('file')){
            //salvamos la imagen
            $path = Storage::disk('public')
                    ->put('image',  $request->file('file'));
            //y actualizamos ese registro
            $post->fill(['file' => asset($path)])->save();
        }

        //Luego hacemos las relaciones con las ETIQUETAS
        $post->tags()->sync($request->get('tags'));
        //y al actualizar, sync porque hace las dos funciones tanto como de attach como dettach
        return redirect()->route('posts.edit', $post->id)
                ->with('info', 'Entrada actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id); //busca el post
        $this->authorize('pass', $post); //verifica si es mío
        $post->delete(); //y si lo es, elimina.
        //mmm...  no sabía que las variables se podían dividir así...
        //y ni hace falta un if!



        return back()->with('info', 'Eliminado correctamente');
    }
}
