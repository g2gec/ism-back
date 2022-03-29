<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $chatMessage->type }}</p>
</div>

<!-- Unreadcount Field -->
<div class="form-group">
    {!! Form::label('unreadCount', 'Unreadcount:') !!}
    <p>{{ $chatMessage->unreadCount }}</p>
</div>

