<div class="table-responsive-sm">
    <table class="table table-striped" id="messages-table">
        <thead>
            <tr>
                <th>Chat Messages Id</th>
        <th>Attachments</th>
        <th>Body</th>
        <th>Contenttype</th>
        <th>Createdat</th>
        <th>Senderid</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            <tr>
                <td>{{ $message->chat_messages_id }}</td>
            <td>{{ $message->attachments }}</td>
            <td>{{ $message->body }}</td>
            <td>{{ $message->contentType }}</td>
            <td>{{ $message->createdAt }}</td>
            <td>{{ $message->senderId }}</td>
                <td>
                    {!! Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('messages.show', [$message->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('messages.edit', [$message->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>