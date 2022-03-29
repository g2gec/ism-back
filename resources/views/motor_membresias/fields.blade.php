<!-- Membresia Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('membresia_id', 'Membresia Id:') !!}
    {!! Form::number('membresia_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Motor Membresia Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('motor_membresia_id', 'Motor Membresia Id:') !!}
    {!! Form::number('motor_membresia_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Descuento Motor Membresia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descuento_motor_membresia', 'Descuento Motor Membresia:') !!}
    {!! Form::text('descuento_motor_membresia', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('motorMembresias.index') }}" class="btn btn-secondary">Cancel</a>
</div>
