@extends('layouts.app')
@section('contenido')

    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Asignaciones</h3>
                </div>

                <div class="panel-body">
                    @permission('add.asignacion')
                    <div class="btn-group">
                        <a class="btn btn-success glyphicon glyphicon-plus" href="{!! route('nuevaasignacion') !!}" role="button" data-toggle="tooltip" data-placement="rigth" title="Agregar Nueva Aignacion"></a>
                    </div>
                    @endpermission
                    <div class="table-responsive">
                        <div class="asignaciones">
                            <table class="table table-bordered table-hover table-condensed clearfix">
                                <th data-field="id">Nombre</th>
                                <th data-field="real">Fecha</th>
                                <th data-field="real">Hora</th>
                                <th data-field="meta">Realizado</th>

                                <th data-field="meta">Acciones</th>

                                {{--</tr>--}}
                                @foreach($asignaciones as $asignacion)
                                    <tr data-id={!! $asignacion->id !!} >
                                        <td>{!!$asignacion->nombre !!}</td>
                                        <td>{!!$asignacion->fechadma !!}</td>
                                        <td>{!!$asignacion->horahm !!}</td>
                                        <td>
                                            {!!  Form::select('status', ['0'=>'No','1'=>'Si'],$asignacion->realizado,['class'=>'status form-control','id'=>'status'.$asignacion->id]) !!}
                                        </td>
                                        {{--@permission('edit.lider')--}}
                                        <td>
                                            <a href="{!! route('pdfasignacion',[$asignacion->id,'descargar']) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Descargar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a>
                                            @permission('edit.asignacion')
                                            <a href="{!! route('editarasignacion',$asignacion->id) !!}" class="btn btn-primary" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            @endpermission
                                            @permission('send.asignacion')
                                            <span data-toggle="tooltip" data-placement="top" title="Enviar">
                                                <a OnClick='mostrar(this)' id="{!! $asignacion->id !!}" class="btn btn-info" aria-label="Left Align" role="button"  data-toggle="modal" data-target="#enviar"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
                                            </span>
                                            @endpermission
                                        </td>
                                        {{--@endpermission--}}
                                    </tr>
                                @endforeach

                            </table>

                            <div class="pagination">
                                {!! $asignaciones->render() !!}
                            </div>
                            @include('layouts.enviar')
                            {!! Html::script('js/enviarasignacion.js') !!}
                            {!! Html::script('js/actualizastatusasignacion.js') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::open(['route'=>['actualizarasignacionstatus',':ID'],'method'=>'PUT','id'=>'form-update','class'=>'hide']) !!}
    {!! Form::text('realizado',':VALOR' ,['class'=>'realizado ']) !!}
    {!! Form::close() !!}
    @include('layouts.loading')
@endsection
@section('scripts')
    {!! Html::script('js/paginacion.js') !!}
    {!! Html::script('js/quitaralerta.js') !!}
@endsection