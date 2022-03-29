<!-- Imagen Membresia Field -->
<div class="form-group">
    {!! Form::label('diseno_tarjeta', 'Imagen Membresia:') !!}
    <p>{{ $membresia->diseno_tarjeta }}</p>
</div>

<!-- Nombre Membresia Field -->
<div class="form-group">
    {!! Form::label('nombre_membresia', 'Nombre Membresia:') !!}
    <p>{{ $membresia->nombre_membresia }}</p>
</div>

<!-- Fecha Fin Membresia Field -->
<div class="form-group">
    {!! Form::label('fecha_fin_membresia', 'Fecha Fin Membresia:') !!}
    <p>{{ $membresia->fecha_fin_membresia }}</p>
</div>

<!-- Precio Membresia Field -->
<div class="form-group">
    {!! Form::label('precio_membresia', 'Precio Membresia:') !!}
    <p>{{ $membresia->precio_membresia }}</p>
</div>

