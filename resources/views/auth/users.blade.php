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
                        <h4 class="center login-form-text">Usuarios del Sistema</h4>
                    </div>
                </div>

                <a href="{!! route('nuevousuario') !!}" class="btn btn-floating waves-effect waves-light blue lighten-2 tooltipped " data-position="left" data-tooltip="Nuevo Usario"><i class="material-icons ">person_add</i></a>
                <div class="usuarios">

                    <table class="bordered responsive-table highlight">
                        <thead>
                        <tr>
                            <th data-field="id">Nombre</th>
                            <th data-field="name">Barrio</th>
                            <th data-field="price">Perfil</th>
                            <th data-field="price">Status</th>
                            <th data-field="price">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>

                            @foreach($usuarios as $usuario)
                            <tr data-id={!! $usuario->id !!}>
                                <td>{!!$usuario->name !!}</td>
                                <td>{!!$usuario->barrionombre !!}</td>
                                <td>{!!$usuario->rolname!!}</td>
                                <td>{!!$usuario->status !!}</td>
                                <td>
                                    <a href="{!! route('editarusuario',$usuario->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="left" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pagination">

                            {!! $usuarios->render() !!}

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