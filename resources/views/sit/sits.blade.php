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
                    <div class="input-field col s12 m12 center">
                        <h4 class="center login-form-text">Gastos de la Unidad</h4>
                    </div>
                </div>

                    <div class="container">
                        <div class="row">
                            <form class="col s12">
                                <div class="row">
                                    {!! Form::text('token',csrf_token(),['class'=>'hide','id'=>'token']) !!}
                                    <div class="input-field col  m6 s12">
                                        {!!  Form::select('year', $years,$year,['id'=>'year', 'placeholder'=>'Selecciona Año','class'=>'form-control']) !!}
                                        <label for="year" data-error="dato no valido" data-success="Correcto" class="left-align">Selecciona Año</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        {{--<i class="material-icons prefix">search</i>--}}
                                        <label for="icon_prefix">Buscar</label>
                                        <input id="datosbuscar" type="text" class="validate buscar" placeholder="Buscar por Nombre (vacio muestra todos)">

                                    </div>
                                    <div class="input-field col  m6 s12">
                                        <a OnClick='buscarproductos()' class="btn-flat btn-small waves-effect waves-light blue lighten-2 btn-primary"><i class="material-icons">search</i>Buscar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('layouts.loading')
                <div id="sits" class="sits">

                </div>


            </div>
        </div>

    {{--</div>--}}
    {!! Form::open(['route'=>['actualizastatussit',':ID'],'method'=>'PUT','id'=>'form-update','class'=>'hide']) !!}
    {!! Form::text('status',':VALOR' ,['class'=>'status ']) !!}
    {!! Form::close() !!}


@endsection
@section('scripts')
    {!! Html::script('js/sits.js') !!}
@endsection