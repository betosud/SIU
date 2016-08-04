<table class="bordered responsive-table highlight">
    <thead>
    <tr>
        <th data-field="id">Nobre</th>
        <th data-field="fecha">Fecha</th>
        <th data-field="hora">Hora</th>
        <th data-field="realizado">Realizado</th>
        <th data-field="acciones">Acciones</th>
    </tr>
    </thead>

    <tbody>

    @foreach($entrevistas as $entrevista)
        <tr data-id={!! $entrevista->id !!}>
            <td>{!!$entrevista->nombre !!}</td>
            <td>{!!$entrevista->fechadma !!}</td>
            <td>{!!$entrevista->horahm !!}</td>
            <td>
                {!!  Form::select('status', ['0'=>'No','1'=>'Si'],$entrevista->realizado,['class'=>'status browser-default input-field','id'=>'status'.$entrevista->id]) !!}
            </td>
            <td>
                <a href="{!! route('pdfentrevista',[$entrevista->id,'descargar',$entrevista->token]) !!}" class="btn btn-floating waves-effect waves-light black tooltipped " data-position="top" data-tooltip="Imprimir"><i class="material-icons ">print</i></a>
                @permission('edit.asignacion')
                <a href="{!! route('editarentrevista',$entrevista->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
                @endpermission
                @permission('send.asignacion')
                <a OnClick='mostrar(this)' id="{!! $entrevista->id !!}" href="#enviar" class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Enviar"><i class="material-icons ">mail_outline</i></a>
                @endpermission
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pagination">

    {!! $entrevistas->render() !!}

</div>

@include('layouts.enviar')
{!! Html::script('js/enviarentrevista.js') !!}
{!! Html::script('js/actualizastatusentrevista.js') !!}
{!! Html::script('js/utiles.js') !!}