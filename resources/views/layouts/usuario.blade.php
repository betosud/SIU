<table class="bordered responsive-table highlight">
    <thead>
    <tr>
        <th data-field="id">Nombre</th>
        <th data-field="name">Barrio</th>
        <th data-field="price">Perfil</th>
        <th data-field="price">Status</th>
        <th data-field="price">Acciones</th>
    </tr>
    </thead>

    <tbody>

    @foreach($usuarios as $usuario)
        <tr data-id={!! $usuario->id !!}>
            <td>{!!$usuario->name !!}</td>
            <td>{!!$usuario->barrionombre !!}</td>
            <td>{!!$usuario->rolname!!}</td>
            <td>{!!$usuario->status !!}</td>
            <td>
                <a href="{!! route('editarusuario',$usuario->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="left" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pagination">

    {!! $usuarios->render() !!}

</div>