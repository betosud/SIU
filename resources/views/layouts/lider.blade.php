<table class="table table-bordered table-hover table-striped table-condensed clearfix">

    <tr class="">
        <th data-field="id">Nombre</th>
        <th data-field="real">Organizacion</th>
        <th data-field="potencial">Llamamiento</th>
        <th data-field="meta">Status</th>
        @permission('edit.lider')
        <th data-field="meta">Acciones</th>
        @endpermission
    </tr>
    @foreach($lideres as $lider)
        <tr id="{!! $lider->id !!}">
            <td>{!!$lider->nombre !!}</td>
            <td>{!!$lider->organizacionnombre !!}</td>
            <td>{!!$lider->llamamientonombre !!}</td>
            <td>{!!$lider->visible !!}</td>
            @permission('edit.lider')
            <td><a href="{!! route('editarlider',$lider->id) !!}" class="btn btn-primary" role="button">Editar</a></td>
            @endpermission
        </tr>
    @endforeach

</table>
<div class="pagination">
    {!! $lideres->render() !!}
</div>