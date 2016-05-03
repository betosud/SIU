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
                    <h3 class="panel-title text-center">Usuarios</h3>
                </div>

                <div class="panel-body">
                    <div class="btn-group">
                        <a class="btn btn-success glyphicon glyphicon-plus" href="{!! route('nuevousuario') !!}" role="button" data-toggle="tooltip" data-placement="rigth" title="Agregar Nuevo Usuario"></a>
                    </div>
                    {{--@endpermission--}}
                    <div class="table-responsive">
                        <div class="usuarios">
                            <table class="table table-bordered table-hover table-condensed clearfix">
                                <th data-field="id">Nombre</th>
                                <th data-field="id">Barrio</th>
                                <th data-field="id">Perfil</th>
                                <th data-field="id">Status</th>
                                <th data-field="id">Acciones</th>
                                @foreach($usuarios as $usuario)
                                    <tr data-id={!! $usuario->id !!}>
                                        <td>{!!$usuario->name !!}</td>
                                        <td>{!!$usuario->barrionombre !!}</td>
                                        <td>{!!$usuario->rolname!!}</td>
                                        <td>{!!$usuario->status !!}</td>
                                        <td>
                                            <a href="{!! route('editarusuario',$usuario->id) !!}" class="btn btn-warning" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            <a href="{!! route('permisos',$usuario->id) !!}" class="btn btn-success" aria-label="Left Align" role="button" data-toggle="tooltip" data-placement="top" title="Permisos"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>


                            <div class="pagination">
                                {!! $usuarios->render() !!}
                            </div>
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