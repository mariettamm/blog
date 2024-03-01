<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//archivos de validacion
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;

use App\Http\Controllers\Controller;

//la primera configuración es decirle 
// que use la entidad tag

use App\Tag;

class TagController extends Controller
{   
    //vamos a programar un contructor
    //para que no se pueda acceder a urls del administrador o de usuario
    //sin estar loggeado
    public function __construct()
    {
        $this->middleware('auth');
    }
    //antes del método index se ejecuta el método constructor
    //EL ORDEN IMPORTA
    //Así el controlador no deja acceder a las páginas de autentificación (su index) sin estar loggeado
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//aquí mostramos la lista entera de etiquetas
    public function index()
    {
        //necesito que el index retorne todas las etiquetas
        $tags = Tag::orderby ('id', 'DESC')->paginate();
        //es igual a la entidad tag ordenada por id en orden descendente y el resultado se ha de paginar
        
        // dd($tags); //esto es un helper que te permite ver q tiene cada variable y los datos de esta consulta a la BBDD

        return view ('admin.tags.index', compact('tags'));
        //retornamos la vista de la página tags en admin
        //el método compact basicament es una función que 
        //permite crear un array con la llave tags y el 
        //valor tags que es nombre de la variable
        //['tags' => $tags] también funcionaría en su lugar


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

//este  método lo que hace es que cuando presionamos "crear" (etiqueta),
//nos muestra el formulario de creación de etiquetas
    public function create()
    {   
        //aquí solo necesitamos retornar el formulario
        return view('admin.tags.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
//este método cuando rellenemos los datos y presionemos guardar
//se crea la etiqueta y nos vamos a la vista de edicion
     public function store(TagStoreRequest $request) //cambiamos el método request por el método que creamos para validar
    {   //AQUÍ debemos validar lo que se está guardando...
        //Si la validación es correcta, entonces se envia
        //---
        //hemos cambiado el método request, donde se hará la validación, así que ya no es necesario usar código aquí

        //guardamos esa etiqueta que se está guardando en la BBDD
        //en la variable tag
        $tag = Tag::create($request->all()); //quiero que se salven todos los datos usando request->all. 
        //Hemos configurado en la entidad tag que solo queremos guardar el nombre y el slug
        //si no especificamos que queremos guardar TODOS los datos de una vez, tendriamos que especificar de campo a campo detalladamente...
        return redirect()->route('tags.edit', $tag->id)
        //redirecciona a tags.edit y le pasamos la etiqueta q hemos creado en este momento con $tag->id 
            ->with('info','Etiqueta creada con éxito');
            //retornamos un mensaje con ->with, funciona como:
            //->with('variable','Mensaje')


        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

//este método es para ver en detalle una etiqueta
    public function show($id)
    {
        $tag = Tag::find($id);
        //esta variable busca una etiqueta a partir del id que le demos
        return view('admin.tags.show', compact('tag'));
        //retornamos la vista correspondiente con los datos encontrados
    }
//editar una etiqueta
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //funciona EXACTAMENTE IGUAL al método show
        //solo que mostramos la vista edit en lugar de la vista show
        $tag = Tag::find($id);

        return view('admin.tags.edit', compact('tag'));
    }

//si edit muestra la vista de edicion
//el método update actualiza realmente los datos de la BBDD
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $id)
    {  //AQUÍ TAMBIEN SE VALIDA ANTES DE ENVIAR
        //--
        //la validación funciona igual que en store, se hace en el método request

        $tag = Tag::find($id);
        //encontramos el tag exacto
        $tag->fill($request->all())->save();
        //actualiza ese registro con lo que estamos pasando

        //el return utiliza el mismo que con el método store
        return redirect()->route('tags.edit', $tag->id)->
        //cuando actualice retornamos entonces a la vista de edicion
        with('info', 'Etiqueta actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//eliminamos un registro

    public function destroy($id) //consigue la etiqueta y la elimina:
    {   
        //PERO SI PUEDO COGER LA ID A TRAVÉS DE LA URL CON GET
        //puedo probar tb con el helper where
        $name = Tag::find($id)->pluck('name')->last();
        //name encuentra y contiene el nombre de la etiqueta en question
        $tag = Tag::find($id)->delete();
       

        //buscamos de nuevo a partir de la id, 
        //y concadenamos con el método delete
        return  back()->with('info', 'Eliminada la etiqueta ' .$name.' se ha eliminado correctamente.' );
        //retornamos a la vista anterior con return back()

    }
}
