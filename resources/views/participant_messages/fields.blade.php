<!-- Chat Messages Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('chat_messages_id', 'Chat Messages Id:') !!}
    {!! Form::number('chat_messages_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Participants Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('participants_id', 'Participants Id:') !!}
    {!! Form::number('participants_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', 'Avatar:') !!}
    {!! Form::text('avatar', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('participantMessages.index') }}" class="btn btn-secondary">Cancel</a>
</div>
