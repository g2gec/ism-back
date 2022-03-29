<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Unreadcount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unreadCount', 'Unreadcount:') !!}
    {!! Form::number('unreadCount', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('chatMessages.index') }}" class="btn btn-secondary">Cancel</a>
</div>
