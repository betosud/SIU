@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Nuevo Sacramental</h4>

                    </div>
                </div>


                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <script>
                            Materialize.toast('{!! $error !!}', 3000, 'rounded');
                        </script>
                    @endforeach
                @endif


                <div class="container-fluid">
                    {!! Form::open(array('url' => 'guardarsacramental', 'method' => 'post','class'=>'form-horizontal')) !!}
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
                            @include('sacramentales.anuncios')
                        </div>
                        <div id="inicio" class="col s12">
                            {{--@include('sit.sitcomprobantes')--}}
                        </div>
                        <div id="asuntos" class="col s12">
                            {{--@include('sit.sitcomprobantes')--}}
                        </div>
                        <div id="discursantes" class="col s12">
                            {{--@include('sit.sitcomprobantes')--}}
                        </div>
                        <div id="final" class="col s12">
                            {{--@include('sit.sitcomprobantes')--}}
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
{{--    {!! Html::script('js/himnossacramentales.js') !!}--}}
{{--    {!! Html::script('js/oradoressacramentales.js') !!}--}}
@endsection