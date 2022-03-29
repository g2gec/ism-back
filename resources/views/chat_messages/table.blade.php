<div class="table-responsive-sm">
    <table class="table table-striped" id="chatMessages-table">
        <thead>
            <tr>
                <th>Type</th>
        <th>Unreadcount</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($chatMessages as $chatMessage)
            <tr>
                <td>{{ $chatMessage->type }}</td>
            <td>{{ $chatMessage->unreadCount }}</td>
                <td>
                    {!! Form::open(['route' => ['chatMessages.destroy', $chatMessage->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('chatMessages.show', [$chatMessage->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('chatMessages.edit', [$chatMessage->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>