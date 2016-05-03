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
                    <h3 class="panel-title text-center">Discursos</h3>
                </div>

                <div class="panel-body">
                    @permission('add.discurso')
                    <div class="btn-group">
                        <a class="btn btn-success glyphicon glyphicon-plus" href="{!! route('nuevodiscurso') !!}" role="button" data-toggle="tooltip" data-placement="rigth" title="Agregar Nuevo Discurso"></a>
                    </div>
                    @endpermission
                    <div class="table-responsive">
                        <div class="discursos">
                            <table class="table table-bordered table-hover table-condensed clearfix">

                                {{--<tr class="">--}}
                                    <th data-field="id">Nombre</th>
                                    <th data-field="real">Fecha</th>
                                    <th data-field="potencial">Tema</th>
                                    <th data-field="meta">Realizado</th>
                                    <th data-field="meta">Acciones</th>
                                {{--</tr>--}}
                                @foreach($discursos as $discurso)
                                    <tr data-id={!! $discurso->id !!} >
                                        <td>{!!$discurso->nombre !!}</td>
                                        <td>{!!$discurso->fechadma !!}</td>
                                        <td>{!!$discurso->tema !!}</td>
                                        <td>
                                            {!!  Form::select('status', ['0'=>'No','1'=>'Si'],$discurso->realizado,['class'=>'status form-control','id'=>'status'.$discurso->id]) !!}
                                        </td>

                                        <td>
                                            <a href="{!! route('pdfdiscurso',[$discurso->id,'descargar']) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Descargar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a>
                                            @permission('add.discurso')
                                                <a href="{!! route('editardiscurso',$discurso->id) !!}" class="btn btn-primary" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            @endpermission
                                            @permission('send.discurso')
                                                <span data-toggle="tooltip" data-placement="top" title="Enviar">
                                                    <a OnClick='mostrar(this)' id="{!! $discurso->id !!}" class="btn btn-info" aria-label="Left Align" role="button"  data-toggle="modal" data-target="#enviar"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
                                                </span>
                                            @endpermission
                                        </td>

                                    </tr>
                                @endforeach

                            </table>

                            <div class="pagination">
                                {!! $discursos->render() !!}
                            </div>
                            @include('layouts.enviar')
                            {!! Html::script('js/enviardiscurso.js') !!}
                            {!! Html::script('js/actualizastatusdiscurso.js') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::open(['route'=>['actualizardiscursostatus',':ID'],'method'=>'PUT','id'=>'form-update','class'=>'hide']) !!}
    {!! Form::text('realizado',':VALOR' ,['class'=>'realizado ']) !!}
    {!! Form::close() !!}
    @include('layouts.loading')


@endsection

@section('scripts')
    {!! Html::script('js/paginacion.js') !!}
    {!! Html::script('js/quitaralerta.js') !!}

@endsection