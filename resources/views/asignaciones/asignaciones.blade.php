@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                @if(Session::has('message'))
                    <script>
                        Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
                    </script>
                @endif
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Asignaciones</h4>
                    </div>
                </div>
                    @permission('add.asignacion')
                <a href="{!! route('nuevaasignacion') !!}" class="btn btn-floating waves-effect waves-light blue lighten-2 tooltipped " data-position="left" data-tooltip="Nueva asignacion"><i class="material-icons ">add</i></a>
                    @endpermission
                <div class="asignaciones">

                    <table class="bordered responsive-table highlight">
                        <thead>
                        <tr>
                            <th data-field="id">Nombre</th>
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
@endsection