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
                    <h3 class="panel-title text-center">Entrevistas</h3>
                </div>

                <div class="panel-body">
                    @permission('add.entrevista')
                    <div class="btn-group">
                        <a class="btn btn-success glyphicon glyphicon-plus" href="{!! route('nuevaentrevista') !!}" role="button" data-toggle="tooltip" data-placement="rigth" title="Agregar Nueva Entrevista"></a>
                    </div>
                    @endpermission
                    <div class="table-responsive">
                        <div class="entrevistas">
                            <table class="table table-bordered table-hover table-condensed clearfix">

                                {{--<tr class="">--}}
                                <th data-field="id">Nombre</th>
                                <th data-field="real">Fecha</th>
                                <th data-field="real">Hora</th>
                                <th data-field="meta">Realizado</th>

                                <th data-field="meta">Acciones</th>

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
                                            <a href="{!! route('pdfentrevista',[$entrevista->id,'descargar']) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Descargar"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span></a>
                                            @permission('edit.entrevista')
                                            <a href="{!! route('editarentrevista',$entrevista->id) !!}" class="btn btn-primary" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            @endpermission
                                            @permission('send.entrevista')
                                            <span data-toggle="tooltip" data-placement="top" title="Enviar">
                                                <a OnClick='mostrar(this)' id="{!! $entrevista->id !!}" class="btn btn-info" aria-label="Left Align" role="button"  data-toggle="modal" data-target="#enviar"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
                                            </span>
                                            @endpermission
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::open(['route'=>['actualizarentrevistastatus',':ID'],'method'=>'PUT','id'=>'form-update','class'=>'hide']) !!}
    {!! Form::text('realizado',':VALOR' ,['class'=>'realizado ']) !!}
    {!! Form::close() !!}
    @include('layouts.loading')
@endsection
@section('scripts')
    {!! Html::script('js/paginacion.js') !!}
    {!! Html::script('js/quitaralerta.js') !!}
@endsection