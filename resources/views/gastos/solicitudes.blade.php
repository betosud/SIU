@extends('layouts.app')

@section('contenido')


    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="col-md-12 col-lg-offset-0">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Solicitudes de Gasto</h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="solicitudes">
                            <table class="table table-bordered table-hover table-condensed clearfix">


                                <th data-field="id">id</th>
                                <th data-field="fecha">Fecha</th>
                                <th data-field="pagable">Pagable</th>
                                <th data-field="cantidad">Cantidad</th>
                                <th data-field="organizacion">Organizacion</th>
                                <th data-field="status">Status</th>
                                <th data-field="acciones">Acciones</th>

                                @foreach($solicitudes as $solicitud)
                                    @if($solicitud->status==64)
                                        <tr data-id="{!! $solicitud->id !!}" class="alert-danger">
                                    @elseif($solicitud->status==63)
                                        <tr data-id="{!! $solicitud->id !!}" class="alert-info">
                                    @elseif($solicitud->status==65)
                                        <tr data-id="{!! $solicitud->id !!}" class="alert-warning">
                                    @else
                                        <tr data-id="{!! $solicitud->id !!}" class="alert-success">
                                    @endif
                                        <td>{!!$solicitud->id !!}</td>
                                        <td>{!!$solicitud->fechamda !!}</td>
                                        <td>{!!$solicitud->pagable !!}</td>
                                        <td>{!!$solicitud->cantidad !!}</td>
                                        <td>{!!$solicitud->organizacionnombre !!}</td>
                                        <td>{!! $solicitud->statusnombre !!}</td>

                                        <td>
                                            {{--<a href="{!! route('pdfdiscurso',[$discurso->id,'descargar']) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Descargar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a>--}}
                                            @permission('edit.solicitudes')
                                                <a href="{!! route('editarsolicitud',$solicitud->id) !!}" class="btn btn-danger" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            @endpermission
                                            @permission('add.sit')

                                                <a href="{!! route('nuevosit',$solicitud->id) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Nuevo Sit"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span></a>
                                                </span>
                                            @endpermission
                                        </td>

                                    </tr>
                                @endforeach

                            </table>

                            <div class="pagination">
                                {!! $solicitudes->render() !!}
                            </div>
                            {{--@include('layouts.enviar')--}}
{{--                            {!! Html::script('js/enviardiscurso.js') !!}--}}
{{--                            {!! Html::script('js/actualizastatusdiscurso.js') !!}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    {!! Html::script('js/paginacion.js') !!}
    {!! Html::script('js/quitaralerta.js') !!}

@endsection