@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">


                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <script>
                            Materialize.toast('{!! $error !!}', 3000, 'rounded');
                        </script>
                    @endforeach
                @endif
                @if(Session::has('message'))
                    <script>
                        Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
                    </script>
                @endif
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Crear Sit</h4>
                    </div>
                </div>


                    {!! Form::model($sit,['route' => ['guardarsit',$sit->id], 'method' => 'PUT','class'=>'form-horizontal']) !!}

                    {!! Form::text('user_id',Auth::user()->id,['class'=>'hide']) !!}
                    <div class="row margin">
                        <div class="input-field col  m4 s12">
                            <i class="material-icons">credit_card</i>
                            {!! Form::text('ife',$sit->ife,['class'=>'validate input-field','disabled'=>'','id'=>'ife','placeholder'=>'ife'])  !!}
                            @if ($errors->has('ife'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('ife') }}</strong>
                                </span>
                            @endif
                            <label for="ife" data-error="dato no valido" data-success="Correcto" class="left-align">IFE Solicitante</label>
                            <div class="form-group{{ $errors->has('ife') ? ' has-error' : '' }}">
                            </div>
                        </div>

                        <div class="input-field col  m4 s12">
                            <i class="material-icons">account_circle</i>
                            {!! Form::text('pagable',$sit->pagable,['class'=>'validate input-field ','disabled'=>'','id'=>'pagable','placeholder'=>'Nombre del Beneficiario'])  !!}
                            @if ($errors->has('pagable'))
                                <span class="help-block red-text">
                        <strong>{{ $errors->first('pagable') }}</strong>
                        </span>
                            @endif
                            <label for="pagable" data-error="dato no valido" data-success="Correcto" class="left-align">Pagable</label>
                            <div class="form-group{{ $errors->has('pagable') ? ' has-error' : '' }}">
                            </div>
                        </div>

                        <div class="input-field col  m4 s12">
                            <i class="material-icons prefix ">payment</i>
                            {!! Form::text('organizaciongasto',$sit->organizacionnombre,['class'=>'validate input-field ','disabled'=>'','id'=>'organizaciongasto','placeholder'=>'Nombre Organizacion'])  !!}
                            @if ($errors->has('organizaciongasto'))
                                <span class="help-block red-text">
                        <strong>{{ $errors->first('organizaciongasto') }}</strong>
                        </span>
                            @endif
                            <label for="organizaciongasto" data-error="dato no valido" data-success="Correcto" class="left-align">Organizacion</label>
                            <div class="form-group{{ $errors->has('organizaciongasto') ? ' has-error' : '' }}">
                            </div>
                        </div>

                    </div>

                    <div class="row margin">
                        <div class="input-field col  m4 s12">
                            <i class="material-icons prefix ">event</i>
                            {!! Form::text('fechasit','',['class'=>'validate input-field datepicker','id'=>'datepicker','placeholder'=>'Seleeciona Fecha'])  !!}
                            @if ($errors->has('fechasit'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('fechasit') }}</strong>
                                </span>
                            @endif
                                <label for="fechasit" data-error="dato no valido" data-success="Correcto" class="left-align">Fecha</label>
                                <div class="form-group{{ $errors->has('fechasit') ? ' has-error' : '' }}">
                            </div>
                        </div>

                        <div class="input-field col  m4 s12">
                            <i class="material-icons prefix ">payment</i>
                            {!! Form::text('idsit','',['class'=>'validate input-field ','id'=>'idsit','placeholder'=>'ingresa el numero de referencia del MLS'])  !!}
                            @if ($errors->has('idsit'))
                                <span class="help-block red-text">
                        <strong>{{ $errors->first('idsit') }}</strong>
                        </span>
                            @endif
                            <label for="idsit" data-error="dato no valido" data-success="Correcto" class="left-align">Referencia</label>
                            <div class="form-group{{ $errors->has('idsit') ? ' has-error' : '' }}">
                            </div>
                        </div>


                        <div class="input-field col  m4 s12">
                            <i class="material-icons prefix ">library_books</i>
                            {!!  Form::select('categoria',$combos['categoria'],null,['placeholder'=>'Selecciona Categoria','id'=>'categoria']) !!}
                            @if ($errors->has('categoria'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('categoria') }}</strong>
                                </span>
                            @endif
                            <label for="categoria" data-error="dato no valido" data-success="Correcto" class="left-align">Categoria</label>
                            <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                            </div>
                        </div>

                    </div>

                    <div class="row margin">

                        <div class="input-field col  m6 s12">
                            <i class="material-icons prefix ">account_circle</i>
                            {!!  Form::select('pteorganizacion',$combos['lideres'],null,['placeholder'=>'Selecciona Lider','id'=>'pteorganizacion','class'=>'pteorganizacion']) !!}
                            @if ($errors->has('pteorganizacion'))
                                <span class="help-block red-text">
                        <strong>{{ $errors->first('pteorganizacion') }}</strong>
                        </span>
                            @endif
                            <label for="pteorganizacion" data-error="dato no valido" data-success="Correcto" class="left-align">Pte. Organizacion</label>
                            <div class="form-group{{ $errors->has('pteorganizacion') ? ' has-error' : '' }}">
                            </div>
                        </div>


                        <div class="input-field col  m6 s12">
                            <i class="material-icons prefix ">account_circle</i>
                            {!!  Form::select('obispo',$combos['obispado'],null,['placeholder'=>'Selecciona Lider','id'=>'obispo','class'=>'obispo']) !!}
                            @if ($errors->has('obispo'))
                                <span class="help-block red-text">
                        <strong>{{ $errors->first('obispo') }}</strong>
                        </span>
                            @endif
                            <label for="obispolabel" data-error="dato no valido" data-success="Correcto" class="left-align">Lider Obispado</label>
                            <div class="form-group{{ $errors->has('obispo') ? ' has-error' : '' }}">
                            </div>
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


    <!-- Modal Structure -->
    <div id="salir" class="modal">
        <div class="modal-content">

            <h5>Si Sale del Modulo no se Guardara los Cambios</h5>
        </div>
        <div class="modal-footer">
            <a href="{!! route('solicitudes') !!}" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable red lighten-2">Cancelar</a>
        </div>
    </div>



    <!-- formulario agregar lider ajax -->
    <div id="addlider" class="modal">
        <div class="modal-content">

            @include('lideres.agregar')


            <div class="row">
                <div class="input-field col s4 m6 left">
                    {{--<button type="submit" class="btn waves-effect waves-light col s12 grey darken-1 tooltipped" data-position="top" data-tooltip="Guardar"> <i class="material-icons">save</i>Guardar</button>--}}
{{--                    {!! link_to('#',$title='Guardar',$attributes=['id'=>'addlider','class'=>'btn waves-effect waves-light col s12 grey darken-1']) !!}--}}

                    <a href="#" id="addlidersave" class="btn waves-effect waves-light col s12 grey darken-1" data-position="top" data-tooltip="Guardar registro"><i class="material-icons">save</i>Guardar</a>
                </div>
                {{--</div>--}}
                {{--<div class="row">--}}
                <div class="input-field col s4 m6 lefç">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn tooltipped red lighten-2 col s12" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>
                    {{--<a href="#" class="btn modal-action modal-close waves-effect waves-light col s12 red lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>--}}
                    {{--<a  class="modal-action modal-close waves-effect waves-green btn-flat tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>--}}
                </div>
            </div>

            {!! Form::close() !!}

    </div>


@endsection
@section('scripts')
    <script>

        $("#addlidersave").click(function () {
                var nombre=$('#nombre').val();
                var idbarrio=$('#idbarrio').val();
                var email=$('#email').val();
                var organizacion=$('#organizacion').val();
                var phone=$('#phone').val();
                var llamamiento=$('#llamamiento').val();
                var token=$('#token').val();
                var route='/guardarlider';
            $.ajax({
                url:route,
                headers:{'X-CSRF-TOKEN':token},
                type:'post',
                datatype:'json',
                data:{idbarrio:idbarrio,nombre: nombre,email:email,organizacion:organizacion,phone:phone,llamamiento:llamamiento},
                success:function(lider){

                    Materialize.toast('Lider Agregado',3000,'rounded');
                    $('#addlider').closeModal();
                    actualizacomboslideres();
                },

                error:function(msj){
                    $('#addlider').openModal({
                        dismissible: false,
                    });
                    var result =msj.responseJSON;
                    $.each(result, function(i, item) {
                        Materialize.toast(item,3000,'rounded');
                    });

                }

            });

        });

        function actualizacomboslideres() {
            var route= '/consultalideres/todos/activos';
            $.get(route, function (res) {
                $("#pteorganizacion").empty();
                $("#pteorganizacion").append('<option value="" placeholder="Selecciona Barrio" >Selecciona Lider</option>');


                for(var i=0;i<res.combo.length;i++){
                    $("#pteorganizacion").append('<option value="' + res.combo[i].id + '">' + res.combo[i].nombre + '</option>');
                    console.log("id "+res.combo[i].id+" nombre "+res.combo[i].nombre);
                }
                $('select').material_select();
            });

//            actualiza combo obispado
            var route= '/consultalideres/Obispado/activos';
            $.get(route, function (res) {
                $("#obispo").empty();
                $("#obispo").append('<option value="" placeholder="Selecciona Barrio" >Selecciona Lider</option>');
                for(var i=0;i<res.combo.length;i++){
                    $("#obispo").append('<option value="' + res.combo[i].id + '">' + res.combo[i].nombre + '</option>');
                    console.log("id "+res.combo[i].id+" nombre "+res.combo[i].nombre);
                }

                $('select').material_select();
            });
        }

        $('#pteorganizacion').on('change',function (e) {
            var id = document.getElementById("pteorganizacion").value;
            if(id==-1) {
                $('#addlider').openModal({
                    dismissible: false,
                });
            }
        });
        $('#obispo').on('change',function (e) {
            var id = document.getElementById("obispo").value;
            if(id==-1) {
                $('#addlider').openModal({
                    dismissible: false,
                });
            }
        });


    </script>
@endsection
