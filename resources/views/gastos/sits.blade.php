@extends('layouts.app')

@section('contenido')


    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Sit's</h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="sits">
                            <table class="table table-bordered table-hover table-condensed clearfix">
                                <th data-field="id">Referencia</th>
                                <th data-field="fecha">Fecha</th>
                                <th data-field="pagable">Pagable</th>
                                <th data-field="organizacion">Organizacion</th>
                                <th data-field="monto">Monto</th>
                                <th data-field="status">Stauts</th>
                                <th data-field="Comprobantes">Comprobantes</th>
                                <th data-field="Comprobantes">Acciones</th>



                                @foreach($sits as $sit)
                                    <tr>
                                        <td>{!!$sit->datossit->id !!}</td>
                                        <td>{!!$sit->datossit->fechadma !!}</td>
                                        <td>{!!$sit->pagable !!}</td>
                                        <td>{!!$sit->organizacionnombre !!}</td>
                                        <td>{!!$sit->cantidad !!}</td>
                                        <td>{!!$sit->datossit->statusdsc !!}</td>
                                        <td>
{{--                                            {!!  Form::select('status', ['0'=>'No','1'=>'Si'],$discurso->realizado,['class'=>'status form-control','id'=>'status'.$discurso->id]) !!}--}}
                                        </td>

                                        <td>
                                            {{--<a href="{!! route('pdfdiscurso',[$discurso->id,'descargar']) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Descargar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a>--}}
                                            @permission('edit.sit')
                                            <a href="{!! route('editarsit',$sit->id) !!}" class="btn btn-primary" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            @endpermission
                                            @permission('send.sit')
                                            <a OnClick='mostrar(this)' id="{!! $sit->id !!}" class="btn btn-success glyphicon glyphicon-envelope" role="button" data-toggle="modal" data-target="#enviar"></a>

                                            @endpermission
                                            @permission('print.sit')
                                            <a tabindex="0" type="button" class="btn btn-info glyphicon glyphicon-print" data-toggle="popover" title="Opciones de Impresion" data-trigger="focus" data-placement="top"
                                               data-content="<a href='/pdfsit/{!! $sit->id !!}/solicitud/descargar'>Solicitud</a><br> <a href='/pdfsit/{!! $sit->id !!}/sit/descargar'>Sit</a> <br><a href='/pdfsit/{!! $sit->id !!}/completo/descargar'>Completo</a>"></a>
                                            @endpermission
                                            {{--@permission('send.discurso')--}}
                                            {{--<span data-toggle="tooltip" data-placement="top" title="Enviar">--}}
                                                    {{--<a OnClick='mostrar(this)' id="{!! $discurso->id !!}" class="btn btn-info" aria-label="Left Align" role="button"  data-toggle="modal" data-target="#enviar"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>--}}
                                                {{--</span>--}}
                                            {{--@endpermission--}}
                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                            <div class="pagination">
                                {!! $sits->render() !!}
                            </div>
                            @include('layouts.enviar')
                            {!! Html::script('js/enviarsit.js') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.loading')


@endsection

@section('scripts')
    {!! Html::script('js/paginacion.js') !!}
    {!! Html::script('js/quitaralerta.js') !!}

@endsection