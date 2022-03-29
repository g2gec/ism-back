<!-- Chat Messages Id Field -->
<div class="form-group">
    {!! Form::label('chat_messages_id', 'Chat Messages Id:') !!}
    <p>{{ $message->chat_messages_id }}</p>
</div>

<!-- Attachments Field -->
<div class="form-group">
    {!! Form::label('attachments', 'Attachments:') !!}
    <p>{{ $message->attachments }}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    <p>{{ $message->body }}</p>
</div>

<!-- Contenttype Field -->
<div class="form-group">
    {!! Form::label('contentType', 'Contenttype:') !!}
    <p>{{ $message->contentType }}</p>
</div>

<!-- Createdat Field -->
<div class="form-group">
    {!! Form::label('createdAt', 'Createdat:') !!}
    <p>{{ $message->createdAt }}</p>
</div>

<!-- Senderid Field -->
<div class="form-group">
    {!! Form::label('senderId', 'Senderid:') !!}
    <p>{{ $message->senderId }}</p>
</div>

