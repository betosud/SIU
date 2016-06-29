@extends('layouts.app')

@section('content')

    {{--<div class="container">--}}
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                @if(Session::has('message'))
                    <script>
                        Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
                    </script>
                @endif
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Gastos de la Unidad</h4>
                    </div>
                </div>

                <div class="row container">
                    <div class="card-panel">
                        {{--<form method="GET" action="" accept-charset="UTF-8" class="" role="search">--}}
                            {!! Form::open(array('url' => 'sits', 'method' => 'GET','class'=>'form-horizontal','accept-charset'=>'UTF-8','role'=>'search')) !!}
                            <div class="input-field s4">
                                <i class="material-icons prefix">search</i>
                                {!! Form::text('parametros','',['class'=>'validate input-field','id'=>'parametros','placeholder'=>'Ingresa Parametros de Busqueda'])  !!}
                                <button type="submit" class="btn-flat hide btn-primary"> Guardar</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="sits">

                    <table class="bordered responsive-table highlight striped">

                        <thead>
                        <tr>
                            <th data-field="referencia">Referencia</th>
                            <th data-field="fecha">Fecha</th>
                            <th data-field="pagable">Pagable</th>
                            <th data-field="dsc">Descripcion</th>
                            <th data-field="cantidad">Cantidad</th>
                            <th data-field="org">Organizacion</th>
                            <th data-field="org">Status</th>
                            <th data-field="acciones">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($sits as $sit)
                            <tr data-id={!! $sit->id !!}>
                                <td class="blue-text"><u>{!!$sit->idsit !!}</u></td>
                                <td >{!!$sit->fechadma !!}</td>
                                <td>{!!$sit->pagable !!}</td>
                                <td>{!!$sit->descripcion !!}</td>
                                <td>{!!$sit->cantidad !!}</td>
                                <td>
                                    {!!  $sit->organizacionnombre !!}
                                </td>
                                <td>
                                    {!!  Form::select('estado', $combos['statussit'],$sit->status,['class'=>'estado browser-default input-field','id'=>'estado'.$sit->id]) !!}
                                </td>
                                <td>
                                    <a href="{!! route('pdfsit',[$sit->id,'completo','descargar',$sit->token]) !!}" class="waves-effect waves-light btn-floating green tooltipped" data-position="top" data-tooltip="Imprimir"><i class="material-icons right">print</i></a>
                                    {{--<a class="waves-effect waves-light btn-floating blue tooltipped" data-position="top" data-tooltip="Enviar"><i class="material-icons right">mail</i></a>--}}
                                    {{--<a class="waves-effect waves-light btn-floating grey tooltipped" data-position="top" data-tooltip="Editar"><i class="material-icons right">edit</i></a>--}}


                                    {{--@permission('add.sit')--}}
                                    {{--<a href="{!! route('crearsit',$solicitud->id) !!}" class="btn btn-floating waves-effect waves-light blue tooltipped " data-position="top" data-tooltip="Crear Sit"><i class="material-icons ">payment</i></a>--}}
                                    {{--@endpermission--}}
                                    @permission('edit.sit')
                                    <a href="{!! route('editarsit',$sit->id) !!}" class="btn btn-floating waves-effect waves-light blue tooltipped " data-position="top" data-tooltip="Editar Solicitud"><i class="material-icons ">edit</i></a>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="pagination">

                        {!! $sits->render() !!}

                    </div>
                    {!! Html::script('js/actualizastatussit.js') !!}
                    {!! Html::script('js/utiles.js') !!}
                </div>


            </div>
        </div>
    {{--</div>--}}
    {!! Form::open(['route'=>['actualizastatussit',':ID'],'method'=>'PUT','id'=>'form-update','class'=>'hide']) !!}
    {!! Form::text('status',':VALOR' ,['class'=>'status ']) !!}
    {!! Form::close() !!}
    @include('layouts.loading')

@endsection
@section('scripts')

    {!! Html::script('js/paginacion.js') !!}
@endsection