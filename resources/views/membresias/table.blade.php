<div class="table-responsive-sm">
    <table class="table table-striped" id="membresias-table">
        <thead>
            <tr>
                <th>Imagen Membresia</th>
        <th>Nombre Membresia</th>
        <th>Fecha Fin Membresia</th>
        <th>Precio Membresia</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($membresias as $membresia)
            <tr>
                <td>{{ $membresia->diseno_tarjeta }}</td>
            <td>{{ $membresia->nombre_membresia }}</td>
            <td>{{ $membresia->fecha_fin_membresia }}</td>
            <td>{{ $membresia->precio_membresia }}</td>
                <td>
                    {!! Form::open(['route' => ['membresias.destroy', $membresia->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('membresias.show', [$membresia->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('membresias.edit', [$membresia->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>