<div class="table-responsive-sm">
    <table class="table table-striped" id="motorMembresias-table">
        <thead>
            <tr>
                <th>Membresia Id</th>
        <th>Motor Membresia Id</th>
        <th>Descuento Motor Membresia</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($motorMembresias as $motorMembresia)
            <tr>
                <td>{{ $motorMembresia->membresia_id }}</td>
            <td>{{ $motorMembresia->motor_membresia_id }}</td>
            <td>{{ $motorMembresia->descuento_motor_membresia }}</td>
                <td>
                    {!! Form::open(['route' => ['motorMembresias.destroy', $motorMembresia->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('motorMembresias.show', [$motorMembresia->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('motorMembresias.edit', [$motorMembresia->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>