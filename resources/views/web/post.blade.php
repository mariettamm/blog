@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        {{-- En el h1 colocamos el nombre del post   --}}
        	<h1>{{ $post->name }}</h1>
            {{-- Estamos linkeando el campo "name" de la variable post --}}
            
            {{-- @foreach($posts as $post)
            Ya no es necesario un foreach porque estamos visualizando 1 único artículo --}}
            <div class="panel panel-default">
                <div class="panel-heading">
            {{-- En el encabezado, vamos a mostrar la categoría: --}}
                    Catergoría 
                    {{-- Traemos el nombre y la ruta de la categoría dependiendo siempre del post que está siendo visualizado --}}
                {{-- <a href="#"> --}}
                    <a href="{{ route('category', $post->category->slug) }}">
                        {{-- El nombre de la categoría (será la categoría del post que esta vista esté visualizando) --}}
                        {{ $post->category->name }}
                        {{-- Entendemos por "category" aquí como el nombre del método que hemos creado en la entidad Post.php --}}
                        {{-- Se traduce como: "imprime el NOMBRE de la CATEGORÍA que esté asociada al post que se esté visualizando" --}}
                    </a>
                </div>
                {{-- si tenemos una imagen, aparece: --}}
                <div class="panel-body">
                    @if($post->file)
                        <img src="{{ $post->file }}" class="img-responsive">
                    @endif
                {{-- enlace de leer más ya no es necesario por supuesto --}}
                {{-- <a href="{{ route('post', $post->slug) }}" class="pull-right">Leer más</a> --}}
                {{-- el extracto --}}
                {{ $post->excerpt }}
                    <hr>
            {{-- BODY --}}
                    {!! $post->body !!}
                    {{-- lo colocamos entre los !! para mantener el código html del body funcionante --}}
                    <hr>
            {{-- los TAGS --}}
                    Etiquetas
                    {{-- aquí sí usamos un foreach porque 
                    vamos a recorrer todas las etiquetas 
                    con las que el post visualizado tenga relacion: --}}
                    @foreach($post->tags as $tag)
                            {{-- llamamos al método de etiquetas de la entidad post --}}
                    {{-- <a href="#">       --}}
                    <a href="{{ route('tag', $tag->slug) }}">
                        {{-- enlace a la ruta y a su slug --}}
                        {{ $tag->name }}
                        {{-- y finalmente imprimimos el nombre de la etiqueta --}}
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
