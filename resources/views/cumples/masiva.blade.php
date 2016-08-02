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
                        <h4 class="center login-form-text">Carga masiva de Cumpleaños</h4>
                    </div>
                </div>
<div class="row">
                    {!! Form::open(['url' => 'cargararchivo','files' => true, 'method' => 'post','id'=>'uploadfileform'])  !!}

                    <div class="input-field col m12 s12">
                        <i class="material-icons">cloud_upload</i>
                        {!! Form::file('archivo', $attributes = array('id'=>'archivo')) !!}
                        @if ($errors->has('archivo'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('archivo') }}</strong>
                            </span>
                        @endif
                        <label for="archivo" data-error="dato no valido" data-success="Correcto" class="left-align">    </label>
                        <div class="form-group{{ $errors->has('archivo') ? ' has-error' : '' }}">
                        </div>
                    </div>



                    <div class="input-field col m12 s12">
                            <button  type="submit" href="#!" class="green lighten-2 waves-effect waves-green btn-flat tooltipped" data-position="top" data-tooltip="Guardar Registro">Cargar</button>
                            {{--<a  id="addfile" class="btn-flat waves-effect waves-light green lighten-3" data-position="top" data-tooltip="Guardar"><i class="material-icons">save</i>Guardar</a>--}}
                            <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
                        </div>
                    {!! Form::close() !!}






</div>
                    @include('cumples.masivaresultado')

                    @if (count($errors) > 0)

                        <script>
                            $('#masivaresultado').openModal({
                                dismissible: false,
                            });
                        </script>
                    @endif




            </div>
        </div>

    </div>





    @include('cumples.nuevo')
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


@endsection

