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
                    <h3 class="panel-title text-center">{!! $usuario->name !!}</h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="usuarios">
                            <a href="{!! route('usuarios') !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Salir">Salir</a>
                            <table class="table table-bordered table-hover table-condensed clearfix">
                                <th data-field="id">Nombre</th>
                                <th data-field="id">Descripcion</th>
                                <th data-field="id">Status</th>
                                @foreach($permisos as $permiso)
                                    <tr data-id={!! $permiso->id !!}>
                                        <td>{!! $permiso->name !!}</td>
                                        <td>{!! $permiso->description !!}</td>
                                        <td>
                                            <div class="radio">
                                                @if($usuario->can($permiso->slug))
                                                    <input onchange="comprobar(this)" id="{!! $permiso->id !!}" value="{!! $usuario->id !!}" type="checkbox" checked>
                                                @else
                                                    <input onchange="comprobar(this)" id="{!! $permiso->id !!}" value="{!! $usuario->id !!}" type="checkbox">
                                                @endif
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="pagination">
                                {!! $permisos->render() !!}
                            </div>
                        </div>
                     </div>
                    {!! Form::open(['route'=>['permisos',':ID',$usuario->id],'method'=>'PUT','id'=>'form-update','class'=>'hide']) !!}
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                    {{--<input type="hidden" name="id" value="" id="id">--}}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>





@endsection
@section('scripts')
    {!! Html::script('js/permisos.js') !!}
@endsection