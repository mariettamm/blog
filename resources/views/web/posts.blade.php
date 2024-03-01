@extends('layouts.app') 
{{-- ^ ESTAMOS EXTENDIENDO DE LA PLANTILLA APP QUE 
SE CREÓ AL CREAR LA PÁGINA DE LOGIN 
EN CONCRETO, APP.BLADE.PHP --}}



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1>Lista de posts</h1>
            {{-- este foreach va a iterar de acuerdo a la
            variable post (?) --}}
            @foreach($posts as $post)

            {{-- clases de bootsrap: --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $post->name }}
                </div>
            {{-- configuramos el body --}}
                <div class="panel-body">
                    {{-- SI un post tiene una imagen, entonces
                    que la muestre en esta página --}}
                    @if($post->file)
                        <img src="{{ $post->file }}" class="img-responsive"> 
                                            {{-- hacemos la imagen responsive --}}
                    @endif
                {{-- el extracto: --}}
                    {{ $post->excerpt }}
                {{-- enlace de leer más: --}}
                    <a href="{{ route('post', $post->slug) }}" class="pull-right">Leer más</a>
                {{-- El enlace es una ruta (cuyo nombre es post), y le pasamos el slug --}}
                {{-- Tenemos que crear esta ruta y luego la vista del post para que funcione --}}
                </div>
            </div>
            @endforeach
            {{-- código para que se generen
            los botones de paginación --}}
            {{ $posts->render() }}
        </div>
    </div>
@endsection