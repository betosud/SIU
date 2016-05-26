@extends('layouts.app')


@section('contenido')

    <div class="container-fluid">

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Programa Sacramental</h3>
                </div>


                <div class="panel-body">

                    {!! Form::open(array('url' => 'guardarsacramental', 'method' => 'post')) !!}

                    <div class="form-group">
                        {{--<div class="col-sm-offset-2 col-sm-10">--}}
                            <button type="submit" class="btn btn-success">
                                Guardar
                            </button>
                            {{--<a  class="btn btn-danger" role="button" data-toggle="modal" data-target="#salir">Cancelar</a>--}}

                        {{--</div>--}}
                    </div>


                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="active"><a href="#red" data-toggle="tab">Anuncios</a></li>
                        <li><a href="#orange" data-toggle="tab">Inicio</a></li>
                        <li><a href="#yellow" data-toggle="tab">Discursantes</a></li>
                        <li><a href="#green" data-toggle="tab">Final</a></li>
                    </ul>
                        <div id="my-tab-content" class="tab-content">

                                <div class="tab-pane active" id="red">
                                    {{--<h1>Red</h1>--}}
                                    {{--<p>red red red red red red</p>--}}
                                    @include('sacramental.anuncios')
                                </div>
                                <div class="tab-pane" id="orange">
                                    <h1>Orange</h1>
                                    <p>orange orange orange orange orange</p>
                                </div>
                                <div class="tab-pane" id="yellow">
                                    <h1>Yellow</h1>
                                    <p>yellow yellow yellow yellow yellow</p>
                                </div>
                                <div class="tab-pane" id="green">
                                    <h1>Green</h1>
                                    <p>green green green green green</p>
                                </div>

                        </div>

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
    </div>







@endsection

@section('scripts')

    <script>
//        jQuery(document).ready(function ($) {
//            $('#tabs').tab();
//        });


        $(document).ready(function() {
            $('#tabs').tab();


            $(document).on('click', '.agregar_anuncio', function () {
                var anuncios= $('.referencia_anuncio').length, // how many "duplicatable" input fields we currently have
                        newNum  = new Number(anuncios + 1);
                alert("anuncios = "+anuncios+" nuevo = "+newNum);


            });
        });
    </script>


@endsection