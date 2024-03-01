{{-- este archivo lo usamos para mostrar la lista de etiquetas (por defecto) --}}
@extends('layouts.app')
{{-- primero llamamos a la plantilla --}}

@section('content')
{{-- llamamos a la seccion para colocar todo el contenido --}}
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {{-- esta es la clase que representa las columnas --}}
            {{-- estas en particular son clases de bootstrap3 --}}
            <div class="panel panel-default">
{{-- encabezado --}}
                <div class="panel-heading">
                    Lista de Etiquetas 
                    <a href="{{ route('tags.create') }}" 
                    {{-- le damos otra apariencia al botón: --}}
                    class="
                    {{-- que el botón esté a la derecha --}}
                    pull-right 
                    {{-- boton, botón pequeño: --}}
                    btn btn-sm 
                    btn-primary">
                        Crear
                    </a>
                </div>
{{-- cuerpo --}}
                <div class="panel-body">
                    {{-- en esta tabla colocaremos todos los 
                        elementos consultados en la BBDD--}}
                    <table class="table table-striped table-hover">
                        {{-- título de la tabla --}}
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        {{-- cuerpo de la tabla
                        (donde van los datos) --}}
                        <tbody>
                            {{-- usamos un foreach para 
                                recoger todos los tags --}}
                            @foreach($tags as $tag)
                            <tr>
                                {{-- le pedimos que de los tags
                                nos saque el id y el name --}}
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td width="10px">
                                {{-- especificamos las rutas y el tipo de botón --}}
                                {{-- ver --}}
                                    <a href="{{ route('tags.show', $tag->id) }}" 
                                        class="btn btn-sm btn-default">Ver
                                    </a>
                                </td>
                                {{-- editar --}}
                                <td width="10px">
                                    <a href="{{ route('tags.edit', $tag->id) }}" 
                                        class="btn btn-sm btn-default">Editar
                                    </a>
                                </td>
                                {{-- Eliminar --}}
                                <td width="10px">
                                    {{-- Formulario que no usa laravelcollective: --}}
                                        {{-- <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}
                                               
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                 Eliminar
                                                </button>
                                        </form> --}}

                                    {{-- Formulario con laravelcollective: --}}
                                    {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) !!}
                                                                {{-- ^ el método en el controlador que hicimos para borrar tags --}}
                                        <button class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>                           
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>   
                    </table>     	
{{-- debajo de la tabla,
colocamos los enlaces de paginación --}}
                    {{ $tags->render() }}
                    {{-- aquí basicamente estamos llamando al método index del controlador de tags y
                    le estamos pidiendo que renderice (pagine) --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
