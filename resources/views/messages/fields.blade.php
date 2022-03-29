<!-- Chat Messages Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('chat_messages_id', 'Chat Messages Id:') !!}
    {!! Form::number('chat_messages_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Attachments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('attachments', 'Attachments:') !!}
    {!! Form::textarea('attachments', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Contenttype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contentType', 'Contenttype:') !!}
    {!! Form::text('contentType', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Createdat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('createdAt', 'Createdat:') !!}
    {!! Form::text('createdAt', null, ['class' => 'form-control','id'=>'createdAt']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#createdAt').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- Senderid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('senderId', 'Senderid:') !!}
    {!! Form::number('senderId', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('messages.index') }}" class="btn btn-secondary">Cancel</a>
</div>
