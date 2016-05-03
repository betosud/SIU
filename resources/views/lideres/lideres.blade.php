@extends('layouts.app')

@section('contenido')


    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message') }}</div>

        @endif
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Lideres De la Unidad</h3>
                </div>

                <div class="panel-body">
                    @permission('add.lider')
                    <div class="btn-group">
                    <a class="btn btn-success glyphicon glyphicon-plus" href="{!! route('nuevolider') !!}" role="button" data-toggle="tooltip" data-placement="rigth" title="Agregar Nuevo Lider"></a>
                    </div>
                    @endpermission
                    <div class="table-responsive">
                        <div class="lideres">
                            <table class="table table-bordered table-hover table-striped table-condensed clearfix">

                                <tr class="">
                                    <th data-field="id">Nombre</th>
                                    <th data-field="real">Organizacion</th>
                                    <th data-field="potencial">Llamamiento</th>
                                    <th data-field="meta">Status</th>
                                    @permission('edit.lider')
                                    <th data-field="meta">Acciones</th>
                                    @endpermission
                                </tr>
                                @foreach($lideres as $lider)
                                    <tr id="{!! $lider->id !!}">
                                        <td>{!!$lider->nombre !!}</td>
                                        <td>{!!$lider->organizacionnombre !!}</td>
                                        <td>{!!$lider->llamamientonombre !!}</td>
                                        <td>{!!$lider->visible !!}</td>
                                        @permission('edit.lider')
                                            <td><a href="{!! route('editarlider',$lider->id) !!}" class="btn btn-primary" role="button">Editar</a></td>
                                        @endpermission
                                    </tr>
                                @endforeach

                            </table>

                            <div class="pagination">
                                {!! $lideres->render() !!}
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