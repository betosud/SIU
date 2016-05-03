<table class="table table-bordered table-hover table-condensed clearfix">

    {{--<tr class="">--}}
    <th data-field="id">Nombre</th>
    <th data-field="real">Fecha</th>
    <th data-field="potencial">Tema</th>
    <th data-field="meta">Realizado</th>
    {{--@permission('edit.lider')--}}
    <th data-field="meta">Acciones</th>
    {{--@endpermission--}}
    {{--</tr>--}}
    @foreach($discursos as $discurso)
        <tr data-id={!! $discurso->id !!} >
            <td>{!!$discurso->nombre !!}</td>
            <td>{!!$discurso->fechadma !!}</td>
            <td>{!!$discurso->tema !!}</td>
            <td>
                {!!  Form::select('status', ['0'=>'No','1'=>'Si'],$discurso->realizado,['class'=>'status form-control','id'=>'status'.$discurso->id]) !!}
            </td>
            {{--@permission('edit.lider')--}}
            <td>
                <a href="{!! route('editardiscurso',$discurso->id) !!}" class="btn btn-primary" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <a href="{!! route('pdfdiscurso',[$discurso->id,'descargar']) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Descargar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a>
                                            <span data-toggle="tooltip" data-placement="top" title="Enviar">
                                                <a OnClick='mostrar(this)' id="{!! $discurso->id !!}" class="btn btn-info" aria-label="Left Align" role="button"  data-toggle="modal" data-target="#enviar"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
                                            </span>

            </td>
            {{--@endpermission--}}
        </tr>
    @endforeach

</table>
<div class="pagination">
    {!! $discursos->render() !!}
</div>
@include('layouts.enviar')
{!! Html::script('js/enviardiscurso.js') !!}
{!! Html::script('js/actualizastatusdiscurso.js') !!}
{!! Html::script('js/utiles.js') !!}
