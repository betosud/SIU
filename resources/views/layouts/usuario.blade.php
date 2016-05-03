<table class="table table-bordered table-hover table-condensed clearfix">
    <th data-field="id">Nombre</th>
    <th data-field="id">Barrio</th>
    <th data-field="id">Perfil</th>
    <th data-field="id">Status</th>
    <th data-field="id">Acciones</th>
    @foreach($usuarios as $usuario)
        <tr data-id={!! $usuario->id !!}>
            <td>{!!$usuario->name !!}</td>
            <td>{!!$usuario->barrionombre !!}</td>
            <td>{!!$usuario->rol !!}</td>
            <td>{!!$usuario->status !!}</td>
            <td>
                <a href="{!! route('editarusuario',$usuario->id) !!}" class="btn btn-warning" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <a href="{!! route('permisos',$usuario->id) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Permisos"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></a>
            </td>
        </tr>
    @endforeach
</table>


<div class="pagination">
    {!! $usuarios->render() !!}
</div>