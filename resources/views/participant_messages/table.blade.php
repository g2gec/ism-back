<div class="table-responsive-sm">
    <table class="table table-striped" id="participantMessages-table">
        <thead>
            <tr>
                <th>Chat Messages Id</th>
        <th>Participants Id</th>
        <th>Avatar</th>
        <th>Name</th>
        <th>Username</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($participantMessages as $participantMessage)
            <tr>
                <td>{{ $participantMessage->chat_messages_id }}</td>
            <td>{{ $participantMessage->participants_id }}</td>
            <td>{{ $participantMessage->avatar }}</td>
            <td>{{ $participantMessage->name }}</td>
            <td>{{ $participantMessage->username }}</td>
                <td>
                    {!! Form::open(['route' => ['participantMessages.destroy', $participantMessage->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('participantMessages.show', [$participantMessage->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('participantMessages.edit', [$participantMessage->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>