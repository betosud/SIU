<table class="bordered responsive-table highlight striped">
    <thead>
    <tr>
        <th data-field="referencia">Referencia</th>
        <th data-field="fecha">Fecha</th>
        <th data-field="pagable">Pagable</th>
        <th data-field="dsc">Descripcion</th>
        <th data-field="cantidad">Cantidad</th>
        <th data-field="org">Organizacion</th>
        <th data-field="org">Status</th>
        <th data-field="acciones">Acciones</th>
    </tr>
    </thead>

    <tbody>

    @foreach($sits as $sit)
        <tr data-id={!! $sit->id !!}>
            <td class="blue-text"><u>{!!$sit->idsit !!}</u></td>
            <td >{!!$sit->fechadma !!}</td>
            <td>{!!$sit->pagable !!}</td>
            <td>{!!$sit->descripcion !!}</td>
            <td>{!!$sit->cantidad !!}</td>
            <td>
                {!!  $sit->organizacionnombre !!}
            </td>
            <td>
                {!!  Form::select('estado', $combos['statussit'],$sit->status,['class'=>'estado browser-default input-field','id'=>'estado'.$sit->id]) !!}
            </td>
            <td>
                <a href="{!! route('pdfsit',[$sit->id,'completo','descargar',$sit->token]) !!}" class="waves-effect waves-light btn-floating green tooltipped" data-position="top" data-tooltip="Imprimir"><i class="material-icons right">print</i></a>
                @permission('edit.sit')
                <a href="{!! route('editarsit',$sit->id) !!}" class="btn btn-floating waves-effect waves-light blue tooltipped " data-position="top" data-tooltip="Editar Solicitud"><i class="material-icons ">edit</i></a>
                @endpermission
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pagination">

    {!! $sits->render() !!}

</div>
{!! Html::script('js/actualizastatussit.js') !!}
{!! Html::script('js/utiles.js') !!}
