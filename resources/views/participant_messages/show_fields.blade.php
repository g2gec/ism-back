<!-- Chat Messages Id Field -->
<div class="form-group">
    {!! Form::label('chat_messages_id', 'Chat Messages Id:') !!}
    <p>{{ $participantMessage->chat_messages_id }}</p>
</div>

<!-- Participants Id Field -->
<div class="form-group">
    {!! Form::label('participants_id', 'Participants Id:') !!}
    <p>{{ $participantMessage->participants_id }}</p>
</div>

<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    <p>{{ $participantMessage->avatar }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $participantMessage->name }}</p>
</div>

<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    <p>{{ $participantMessage->username }}</p>
</div>

