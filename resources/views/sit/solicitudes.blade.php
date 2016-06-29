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
                        <h4 class="center login-form-text">Solicitudes de Gasto</h4>
                    </div>
                </div>
                <div class="solicitudes">

                    <table class="bordered responsive-table highlight">
                        <thead>
                        <tr>
                            <th data-field="pagable">Pagable</th>
                            <th data-field="dsc">Descripcion</th>
                            <th data-field="cantidad">Cantidad</th>
                            <th data-field="org">Organizacion</th>
                            <th data-field="acciones">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($solicitudes as $solicitud)
                            <tr data-id={!! $solicitud->id !!}>
                                <td>{!!$solicitud->pagable !!}</td>
                                <td>{!!$solicitud->descripcion !!}</td>
                                <td>{!!$solicitud->cantidad !!}</td>
                                <td>
                                    {!!  $solicitud->organizacionnombre !!}
                                </td>
                                <td>
                                    @permission('add.sit')
                                    <a href="{!! route('crearsit',$solicitud->id) !!}" class="btn btn-floating waves-effect waves-light blue tooltipped " data-position="top" data-tooltip="Crear Sit"><i class="material-icons ">payment</i></a>
                                    @endpermission
                                    @permission('edit.solicitudes')
                                    <a href="{!! route('editarsolicitud',$solicitud->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar Solicitud"><i class="material-icons ">edit</i></a>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="pagination">

                        {!! $solicitudes->render() !!}

                    </div>

                    {!! Html::script('js/utiles.js') !!}
                </div>


            </div>
        </div>
    </div>

    @include('layouts.loading')

@endsection
@section('scripts')

    {!! Html::script('js/paginacion.js') !!}
@endsection