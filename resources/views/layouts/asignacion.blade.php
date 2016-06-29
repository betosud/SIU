<table class="bordered responsive-table highlight">
    <thead>
    <tr>
        <th data-field="id">Nobre</th>
        <th data-field="name">Fecha</th>
        <th data-field="price">Hora</th>
        <th data-field="price">Realizado</th>
        <th data-field="price">Acciones</th>
    </tr>
    </thead>

    <tbody>

    @foreach($asignaciones as $asignacion)
        <tr data-id={!! $asignacion->id !!}>
            <td>{!!$asignacion->nombre !!}</td>
            <td>{!!$asignacion->fechadma !!}</td>
            <td>{!!$asignacion->horahm !!}</td>
            <td>
                {!!  Form::select('status', ['0'=>'No','1'=>'Si'],$asignacion->realizado,['class'=>'status browser-default input-field','id'=>'status'.$asignacion->id]) !!}
            </td>
            <td>
                <a href="{!! route('pdfasignacion',[$asignacion->id,'descargar',$asignacion->token]) !!}" class="btn btn-floating waves-effect waves-light black tooltipped " data-position="top" data-tooltip="Imprimir"><i class="material-icons ">print</i></a>
                @permission('edit.asignacion')
                <a href="{!! route('editarasignacion',$asignacion->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
                @endpermission
                @permission('send.asignacion')
                <a OnClick='mostrar(this)' id="{!! $asignacion->id !!}" href="#enviar" class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Enviar"><i class="material-icons ">mail_outline</i></a>
                @endpermission
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pagination">

    {!! $asignaciones->render() !!}

</div>

@include('layouts.enviar')
{!! Html::script('js/enviarasignacion.js') !!}
{!! Html::script('js/actualizastatusasignacion.js') !!}
{!! Html::script('js/utiles.js') !!}