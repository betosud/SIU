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
                        <h4 class="center login-form-text">Listado de Cumpleaños</h4>
                    </div>
                </div>


                @permission('add.cumples')
                {{--<a href="{!! route('nuevocumple') !!}" class="btn btn-floating waves-effect waves-light blue lighten-2 tooltipped " data-position="left" data-tooltip="Nuevo Registro"><i class="material-icons ">add</i></a>--}}
                    <a href="#nuevo" class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Nuevo"><i class="material-icons ">add</i></a>
{{--                    <a href="{!! route('cargamasiva') !!}" class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Carga Masiva"><i class="material-icons">supervisor_account</i></a>--}}
                @endpermission
                <div id="cumples" class="cumples">

                </div>


            </div>
        </div>

    </div>

    @include('layouts.loading')
    @include('cumples.nuevo')
    @include('cumples.editar')
    @if ($errors->has('nombre') || $errors->has('fecha'))
        @foreach ($errors->all() as $error)
            <script>
                {{--Materialize.toast('{!! $error !!}', 5000, 'rounded');--}}
                $('#nuevo').openModal({
                    dismissible: false,
                });
            </script>
        @endforeach
    @endif
@endsection



@section('scripts')

    {!! Html::script('js/paginacion.js') !!}
    {!! Html::script('js/cumples.js') !!}
@endsection