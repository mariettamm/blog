{{-- este archivo se usa para mirar en detalle un registro (?) --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ver etiqueta
                </div>

                <div class="panel-body">
                    <p><strong>Nombre</strong> {{ $tag->name }}</p>
                                            {{-- Entre llaves se encuentra el
                                                valor dinámico, que es la propiedad
                                                del objeto tag--}}
                    <p><strong>Slug</strong> {{ $tag->slug }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
