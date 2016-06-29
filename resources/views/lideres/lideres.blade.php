@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="login-page" class="row">
            <div class="col s12 m12 z-depth-1 card-panel">
                @if(Session::has('message'))
                    <script>
                        Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
                    </script>
                @endif
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Lideres de la unidad</h4>
                    </div>
                </div>


                @permission('add.asignacion')
                    <a href="{!! route('nuevolider') !!}" class="btn btn-floating waves-effect waves-light blue lighten-2 tooltipped " data-position="left" data-tooltip="Nuevo Lider"><i class="material-icons ">add</i></a>
                @endpermission
                <div class="lideres">

                    <table class="bordered responsive-table highlight">
                        <thead>
                        <tr>
                            <th data-field="nombre">Nombre</th>
                            <th data-field="llamamiento">Llamamiento</th>
                            <th data-field="organizacion">Organizacion</th>
                            <th data-field="acciones">acciones</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($lideres as $lider)
                            <tr data-id={!! $lider->id !!}>
                                <td>{!!$lider->nombre !!}</td>
                                <td>{!!$lider->llamamientonombre !!}</td>
                                <td>{!!$lider->organizacionnombre !!}</td>

                                <td>

                                    @permission('edit.asignacion')
                                    <a href="{!! route('editarlider',$lider->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="pagination">

                        {!! $lideres->render() !!}

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

