<!-- Imagen Membresia Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('diseno_tarjeta', 'Imagen Membresia:') !!}
    {!! Form::textarea('diseno_tarjeta', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Membresia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_membresia', 'Nombre Membresia:') !!}
    {!! Form::text('nombre_membresia', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Fecha Fin Membresia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_fin_membresia', 'Fecha Fin Membresia:') !!}
    {!! Form::text('fecha_fin_membresia', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Precio Membresia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_membresia', 'Precio Membresia:') !!}
    {!! Form::text('precio_membresia', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('membresias.index') }}" class="btn btn-secondary">Cancel</a>
</div>
