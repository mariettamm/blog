{{-- este archivo lo usamos para crear un nuevo registro --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Crear etiqueta
                </div>

                <div class="panel-body">
                        {!! Form::open(['route' => 'tags.store']) !!}
                        {{-- le decimos que abra el formulario para editar tags  y 
                            le pasamos la ruta del método que programamos en el controlador de tags
                            para guardar etiquetas --}}
                            @include('admin.tags.partials.form')
                                    {{-- ^ los campos del formulario abierto están 
                                    en esta ruta --}}
    
                        {!! Form::close() !!}
                        {{-- formulario sin laravelcollective: --}}
                            {{-- </form> --}}
                            {{-- {!! Form::open(['route' => 'tags.store']) !!}

                                @include('admin.tags.partials.form')

                            {!! Form::close() !!} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
