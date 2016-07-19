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
                            @include('sacramentales.nuevo.anuncios')
                        </div>
                        <div id="inicio" class="col s12">
                            @include('sacramentales.nuevo.inicio')
                        </div>
                        <div id="asuntos" class="col s12">
                            @include('sacramentales.nuevo.asuntos')
                        </div>
                        <div id="discursantes" class="col s12">
                            @include('sacramentales.nuevo.discursantes')
                        </div>
                        <div id="final" class="col s12">
                            @include('sacramentales.nuevo.final')
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


    <script>
        $(document).on('click', '.agregar_anuncio', function () {
            var anuncio= $('.ref_anuncio').length, // how many "duplicatable" input fields we currently have
                    newNum  = new Number(anuncio + 1);
            newElem = $('#anunciosacramental'+anuncio).clone().attr('id', 'anunciosacramental'+newNum).fadeIn('slow');
            newElem.find('.tbxanuncio').attr('id', 'tbxanuncio'+newNum).attr('name', 'tbxanuncio'+newNum).val('');
            newElem.find('.lblanuncio').attr('id', 'lblanuncio'+newNum).attr('name', 'lblanuncio'+newNum).html('Anuncio '+newNum);
            $('#anunciosacramental'+anuncio).after(newElem);

        });
        $('#eliminar_anuncio').click(function () {
            // confirmation
            var anuncio = $('.ref_anuncio').length;
            if (anuncio > 1) {
//                    // how many "duplicatable" input fields we currently have
                $('#anunciosacramental' + anuncio).slideUp('slow', function () {
                    $(this).remove();
//                        // if only one element remains, disable the "remove" button
                });

                return false;
            }
            else{
                Materialize.toast('Debe haber al menos un Anuncio', 4000,'rounded')
            }
        });
//        asuntos barrio
        $(document).on('click', '.agregar_asunto', function () {
            var anuncio= $('.ref_asunto').length, // how many "duplicatable" input fields we currently have
                    newNum  = new Number(anuncio + 1);
            newElem = $('#asuntosacramental'+anuncio).clone().attr('id', 'asuntosacramental'+newNum).fadeIn('slow');
            newElem.find('.tbxasunto').attr('id', 'tbxasunto'+newNum).attr('name', 'tbxasunto'+newNum).val('');
            newElem.find('.lblasunto').attr('id', 'lblasunto'+newNum).attr('name', 'lblasunto'+newNum).html('Asunto '+newNum);
            $('#asuntosacramental'+anuncio).after(newElem);

        });
        $('#eliminar_asunto').click(function () {
            // confirmation
            var anuncio = $('.ref_asunto').length;
            if (anuncio > 1) {
                $('#asuntosacramental' + anuncio).slideUp('slow', function () {
                    $(this).remove();
                });

                return false;
            }
            else{
                Materialize.toast('Debe haber al menos un Asunto', 4000,'rounded')
            }
        });


//        discursantes


        $(document).on('click', '.agregar_discursantegrupo1', function () {
            var discursante= $('.ref_discursantegrupo1').length, // how many "duplicatable" input fields we currently have
                    newNum  = new Number(discursante + 1);


            newElem = $('#discursantegrupo1num'+discursante).clone().attr('id', 'discursantegrupo1num'+newNum).fadeIn('slow');
            newElem.find('.tbxdiscursante').attr('id', 'tbxdiscursantegrupo1num'+newNum).attr('name', 'tbxdiscursantegrupo1num'+newNum).val('');
            newElem.find('.lbldiscursante').attr('id', 'lbldiscursantegrupo1num'+newNum).attr('name', 'lbldiscursantegrupo1num'+newNum).html('Nombre Discursante ');
            //            label
            newElem.find('.tbxdiscursantetema').attr('id', 'tbxdiscursantetemagrupo1num'+newNum).attr('name', 'tbxdiscursantetemagrupo1num'+newNum).val('');
            newElem.find('.lbldiscursantetema').attr('id', 'lbldiscursantetemagrupo1num'+newNum).attr('name', 'lbldiscursantetemagrupo1num'+newNum).html('Tema Discursante');


            $('#discursantegrupo1num'+discursante).after(newElem);

        });
        $('#eliminar_discursantegrupo1').click(function () {

            // confirmation
            var discursante = $('.ref_discursantegrupo1').length;
            if (discursante > 1) {
                $('#discursantegrupo1num' + discursante).slideUp('slow', function () {
                    $(this).remove();
                });

                return false;
            }
            else{
                Materialize.toast('Debe haber al menos un Discursante', 4000,'rounded')
            }
        });



        //grupo 2 discursantes

        $(document).on('click', '.agregar_discursantegrupo2', function () {
            var discursante= $('.ref_discursantegrupo2').length, // how many "duplicatable" input fields we currently have
                    newNum  = new Number(discursante + 1);


            newElem = $('#discursantegrupo2num'+discursante).clone().attr('id', 'discursantegrupo2num'+newNum).fadeIn('slow');
            newElem.find('.tbxdiscursante').attr('id', 'tbxdiscursantegrupo2num'+newNum).attr('name', 'tbxdiscursantegrupo2num'+newNum).val('');
            newElem.find('.lbldiscursante').attr('id', 'lbldiscursantegrupo2num'+newNum).attr('name', 'lbldiscursantegrupo2num'+newNum).html('Nombre Discursante ');
            //            label
            newElem.find('.tbxdiscursantetema').attr('id', 'tbxdiscursantetemagrupo2num'+newNum).attr('name', 'tbxdiscursantetemagrupo2num'+newNum).val('');
            newElem.find('.lbldiscursantetema').attr('id', 'lbldiscursantetemagrupo2num'+newNum).attr('name', 'lbldiscursantetemagrupo2num'+newNum).html('Tema Discursante');


            $('#discursantegrupo2num'+discursante).after(newElem);

        });
        $('#eliminar_discursantegrupo2').click(function () {

            // confirmation
            var discursante = $('.ref_discursantegrupo2').length;
            if (discursante > 1) {
                $('#discursantegrupo2num' + discursante).slideUp('slow', function () {
                    $(this).remove();
                });

                return false;
            }
            else{
                Materialize.toast('Debe haber al menos un Discursante', 4000,'rounded')
            }
        });

    </script>
{{--    {!! Html::script('js/himnossacramentales.js') !!}--}}
{{--    {!! Html::script('js/oradoressacramentales.js') !!}--}}
@endsection