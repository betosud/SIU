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
                        <h4 class="center login-form-text">Discursos</h4>
                    </div>
                </div>
                @permission('add.asignacion')
                <a href="{!! route('nuevodiscurso') !!}" class="btn btn-floating waves-effect waves-light blue lighten-2 tooltipped " data-position="left" data-tooltip="Nuevo Discurso"><i class="material-icons ">add</i></a>
                @endpermission
                    <div class="container">
                    <div class="row">
                        <form class="col s12">
                            <div class="row">
                                {!! Form::text('token',csrf_token(),['class'=>'hide','id'=>'token']) !!}
                                <div class="input-field col s12 m6">
                                    {{--<i class="material-icons prefix">search</i>--}}
                                    <input id="datosbuscar" type="text" class="validate buscar" placeholder="Ingrese Parametros de Busqueda">
                                    <label for="icon_prefix">Buscar</label>
                                </div>
                                <div class="input-field col  m6 s12">
                                    {!!  Form::select('year', $years,$year,['id'=>'year', 'placeholder'=>'Selecciona Año','class'=>'form-control']) !!}
                                    <label for="year" data-error="dato no valido" data-success="Correcto" class="left-align">Selecciona Año</label>
                                </div>
                                <a OnClick='buscarproductos()' class="btn-flat btn-small waves-effect waves-light blue lighten-2 btn-primary"><i class="material-icons">search</i>Buscar</a>
                            </div>
                        </form>
                    </div>
                    </div>
                <div id="discursos" class="discursos">

                    {{--<table class="bordered responsive-table highlight">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th data-field="id">Nombre</th>--}}
                            {{--<th data-field="name">Fecha</th>--}}
                            {{--<th data-field="price">Tema</th>--}}
                            {{--<th data-field="price">Realizado</th>--}}
                            {{--<th data-field="price">Acciones</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}

                        {{--<tbody>--}}

                        {{--@foreach($discursos as $discurso)--}}
                            {{--<tr data-id={!! $discurso->id !!}>--}}
                                {{--<td>{!!$discurso->nombre !!}</td>--}}
                                {{--<td>{!!$discurso->fechadma !!}</td>--}}
                                {{--<td>{!!$discurso->tema !!}</td>--}}
                                {{--<td>--}}
                                    {{--{!!  Form::select('status', ['0'=>'No','1'=>'Si'],$discurso->realizado,['class'=>'status browser-default input-field','id'=>'status'.$discurso->id]) !!}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--<a href="{!! route('pdfdiscurso',[$discurso->id,'descargar',$discurso->token]) !!}" class="btn btn-floating waves-effect waves-light black tooltipped " data-position="top" data-tooltip="Imprimir"><i class="material-icons ">print</i></a>--}}
                                    {{--@permission('edit.asignacion')--}}
                                    {{--<a href="{!! route('editardiscurso',$discurso->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar"><i class="material-icons ">edit</i></a>--}}
                                    {{--@endpermission--}}
                                    {{--@permission('send.asignacion')--}}
                                    {{--<a OnClick='mostrar(this)' id="{!! $discurso->id !!}" href="#enviar" class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Enviar"><i class="material-icons ">mail_outline</i></a>--}}
                                    {{--@endpermission--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    {{--</table>--}}

                    {{--<div class="pagination">--}}

                        {{--{!! $discursos->render() !!}--}}

                    {{--</div>--}}

                    {{--@include('layouts.enviar')--}}
                    {{--{!! Html::script('js/enviardiscurso.js') !!}--}}
                    {{--{!! Html::script('js/actualizastatusdiscurso.js') !!}--}}
                    {{--{!! Html::script('js/utiles.js') !!}--}}
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
    {!! Html::script('js/discursos.js') !!}
{{--    {!! Html::script('js/paginacion.js') !!}--}}
@endsection