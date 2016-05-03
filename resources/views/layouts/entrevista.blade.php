<table class="table table-bordered table-hover table-condensed clearfix">

    {{--<tr class="">--}}
    <th data-field="id">Nombre</th>
    <th data-field="real">Fecha</th>
    <th data-field="real">Hora</th>
    <th data-field="meta">Realizado</th>
    {{--@permission('edit.lider')--}}
    <th data-field="meta">Acciones</th>
    {{--@endpermission--}}
    {{--</tr>--}}
    @foreach($entrevistas as $entrevista)
        <tr data-id={!! $entrevista->id !!} >
            <td>{!!$entrevista->nombre !!}</td>
            <td>{!!$entrevista->fechadma !!}</td>
            <td>{!!$entrevista->horahm !!}</td>
            <td>
                {!!  Form::select('status', ['0'=>'No','1'=>'Si'],$entrevista->realizado,['class'=>'status form-control','id'=>'status'.$entrevista->id]) !!}
            </td>
            {{--@permission('edit.lider')--}}
            <td>
                <a href="{!! route('editarentrevista',$entrevista->id) !!}" class="btn btn-primary" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <a href="{!! route('pdfentrevista',[$entrevista->id,'descargar']) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Descargar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a>
                                            <span data-toggle="tooltip" data-placement="top" title="Enviar">
                                                <a OnClick='mostrar(this)' id="{!! $entrevista->id !!}" class="btn btn-info" aria-label="Left Align" role="button"  data-toggle="modal" data-target="#enviar"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
                                            </span>

            </td>
            {{--@endpermission--}}
        </tr>
    @endforeach

</table>
<div class="pagination">
    {!! $entrevistas->render() !!}
</div>
@include('layouts.enviar')
{!! Html::script('js/enviarentrevista.js') !!}
{!! Html::script('js/actualizastatusentrevista.js') !!}
{!! Html::script('js/utiles.js') !!}