@extends('layouts.app')

@section('content')
    @include('layouts.loading')
    <div class="container">
        <div class="row">

            <div class="col s12 m12 z-depth-3 card-panel">


                @if(Session::has('message'))
                    <script>
                        Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
                    </script>
                @endif

                {{--@if (count($errors) > 0)--}}
                    {{--@foreach ($errors->all() as $error)--}}
                        {{--<script>--}}
                            {{--Materialize.toast('{!! $error !!}', 3000, 'rounded');--}}
                        {{--</script>--}}
                    {{--@endforeach--}}
                {{--@endif--}}

                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Editar Sit {!! $sit->idsit !!}</h4>
                    </div>
                </div>


                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="blue-text tab col s6"><a href="#datos">Datos</a></li>
                                <li class="blue-text tab col s6"><a href="#comprobantes">Comprobantes</a></li>

                            </ul>
                        </div>
                        <div id="datos" class="col s12">
                            @include('sit.editardatossit')

                        </div>

                        <div id="comprobantes" class="col s12">
                            @include('sit.sitcomprobantes')
                        </div>
                    </div>

        </div>

            <!-- Modal Structure -->
            <div id="salir" class="modal">
                <div class="modal-content">

                    <h5>Si Sale del Modulo no se Guardara los Cambios</h5>
                </div>
                <div class="modal-footer">
                    <a href="{!! route('sits') !!}" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
                    <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable red lighten-2">Cancelar</a>
                </div>
            </div>


</div>
        </div>


            {!! Form::open(['route'=>['actualizavalidadocomporbante',':ID'],'method'=>'PUT','id'=>'form-update-comprobante','class'=>'hide']) !!}
            {!! Form::text('validadopor',':VALOR' ,['class'=>'validadopor ']) !!}
            {!! Form::close() !!}
            @include('sit.modaluploadfile')
@endsection

@section('scripts')
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        @if($error == 'El campo Nombre del Archivo es obligatorio.'
                         || $error =='El campo Descripcion del Archivo es obligatorio.'
                         || $error =='Monto del Archivo debe ser numérico.'
                         || $error =='El campo archivo es obligatorio.')
                        <script>
                        {{--Materialize.toast('{!! $error !!}', 3000, 'rounded');--}}
                        $('#uploadfile').openModal({
                            dismissible: false,
                        });
                        </script>
                        @endif
                    @endforeach
                @endif

    {!! Html::script('js/actualizacomprobante.js') !!}

@endsection