@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Editar Sacramental</h4>

                    </div>
                </div>


                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <script>
                            Materialize.toast('{!! $error !!}', 5000, 'rounded');
                        </script>
                    @endforeach
                @endif


                <div class="container-fluid">
                    {!! Form::model($sacramental,['route' => ['actualizasacramental',$sacramental->id], 'method' => 'PUT','class'=>'form-horizontal']) !!}


                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s6"><a class="black-text" href="#anuncios">Anuncios</a></li>
                                <li class="tab col s6"><a class="black-text" href="#inicio">Inicio</a></li>
                                <li class="tab col s6"><a class="black-text" href="#asuntos">Asuntos Barrio</a></li>
                                <li class="tab col s6"><a class="black-text" href="#discursantes">Discursantes</a></li>
                                <li class="tab col s6"><a class="black-text" href="#final">Final</a></li>
                            </ul>
                        </div>
                        <div id="anuncios" class="col s12">
                            @include('sacramentales.editar.anuncios')
                        </div>
                        <div id="inicio" class="col s12">
                            @include('sacramentales.editar.inicio')
                        </div>
                        <div id="asuntos" class="col s12">
                            @include('sacramentales.editar.asuntos')
                        </div>
                        <div id="discursantes" class="col s12">
                            @include('sacramentales.editar.discursantes')
                        </div>
                        <div id="final" class="col s12">
                            @include('sacramentales.editar.final')
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4 m6 left">
                            <button type="submit" class="btn waves-effect waves-light col s12 grey darken-1 tooltipped" data-position="top" data-tooltip="Guardar Registro"> <i class="material-icons">save</i>Guardar</button>
                        </div>
                        {{--</div>--}}
                        {{--<div class="row">--}}
                        <div class="input-field col s4 m6 left">
                            <a href="#salir"  class="btn waves-effect waves-light col s12 red lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>


            </div>
        </div>
    </div>



    <!-- Modal Structure -->
    <div id="salir" class="modal">
        <div class="modal-content">

            <h5>Si Sale del Modulo no se Guardara los Cambios</h5>
        </div>
        <div class="modal-footer">
            <a href="{!! route('sacramentales') !!}" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable red lighten-2">Cancelar</a>
        </div>
    </div>
    {!! Form::open(['route' => ['himnos', ':VAL'], 'method' => 'GET', 'id' => 'form-getHimnos']) !!}
    {!! Form::close() !!}
@endsection
@section('scripts')

    {!! Html::script('js/himnossacramental.js') !!}
    {!! Html::script('js/utilessacramental.js') !!}
@endsection