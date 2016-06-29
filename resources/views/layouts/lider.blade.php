<table class="bordered responsive-table highlight">
    <thead>
    <tr>
        <th data-field="nombre">Nombre</th>
        <th data-field="llamamiento">Llamamiento</th>
        <th data-field="organizacion">Organizacion</th>
        <th data-field="acciones">acciones</th>
    </tr>
    </thead>

    <tbody>

    @foreach($lideres as $lider)
        <tr data-id={!! $lider->id !!}>
            <td>{!!$lider->nombre !!}</td>
            <td>{!!$lider->llamamientonombre !!}</td>
            <td>{!!$lider->organizacionnombre !!}</td>

            <td>

                @permission('edit.asignacion')
                <a href="{!! route('editarlider',$lider->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
                @endpermission
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pagination">

    {!! $lideres->render() !!}

</div>
{!! Html::script('js/utiles.js') !!}