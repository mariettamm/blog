{{-- por ser un formulario, las demás vistas van a usar este archivo --}}
<div class="form-group">
    {{ Form::label('name', 'Nombre de la etiqueta') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>
<div class="form-group">
    {{ Form::label('slug', 'URL amigable') }}
    {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
</div>
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>

{{-- Llamamos a la sección que hemos creado de JS personalizable desde app.blade: --}}
@section('scripts') 
{{-- Incluimos el archivo que convierte las string to slugs que hemos descargado: --}}
<script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js') }}"></script>
<script>
    // estamos usando jQuery también puesto que está incorporado:
	$(document).ready(function(){
        $("#name, #slug").stringToSlug({ //cuando hagamos algun cambio 
            //dentro de name o slug, entonces vamos a ejecutar el plugin:
	        callback: function(text){ //creamos una función anonima y colocamos como parámetro el texto que manipulamos
	            $('#slug').val(text); //y dentro de slug es donde vamos a colocar el resultado
	        }
	    });
	});
</script>
@endsection