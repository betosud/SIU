@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">

                {{--<div class="row">--}}
                    {{--<div class="input-field col s12 center">--}}
                        {{--<h4 class="center login-form-text blue-text">Informacion de Solicitud</h4>--}}
                    {{--</div>--}}
                {{--</div>--}}
                @if(Session::has('message'))
                    <script>
                        Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
                    </script>
                @endif

                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="blue-text tab col s6"><a href="#datos">Datos</a></li>
                            @if($sit->idsit=='')
                                <li class="blue-text tab col disabled s6"><a href="#comprobantes">Comprobantes</a></li>
                                @else
                                <li class="blue-text tab col s6"><a href="#comprobantes">Comprobantes</a></li>
                            @endif
                        </ul>
                    </div>
                    <div id="datos" class="col s12">
                        <ul class="collection with-header">
                            <li class="collection-header center-align"><h4>Informacion de Solicitud de Gasto</h4></li>



                            @if($sit->status==64)
                                <li class="center-align">
                                    <h5>La Solicitud del Gasto: <strong>{!! $sit->idsit !!}</strong> ha sido Cancelada, si tienen alguna duda con esta solicitud contacte a los lideres de la unidad
                                    </h5>
                                </li>
                                <li class="center-align">
                                    <h5>
                                        Para poder realizar otra solicitud vaya a <a href="{!! URL::to('solicitudgasto') !!}">Solicitar Gasto</a>
                                    </h5>
                                </li>
                            @else



                                <li class="collection-item">Barrio: <strong>{!! $sit->datosbarrio->nombreunidad !!}</strong></li>
                                <li class="collection-item">Solicitante: <strong> {!! $sit->solicitante !!}</strong></li>

                                @if($sit->idsit!='')
                                    <li class="collection-item">Referencia: <strong> {!! $sit->idsit !!}</strong></li>
                                    <li class="collection-item">Banco de Cobro: <strong> {!! $barrio->datosbanco->nombre !!}</strong></li>
                                @endif


                                <li class="collection-item">Pagable: <strong> {!! $sit->pagable !!}</strong></li>
                                <li class="collection-item">Cantidad: <strong>{!! $sit->cantidad !!}</strong></li>
                                <li class="collection-item">Descripcion: <strong>{!! $sit->descripcion !!}</strong></li>
                                <li class="collection-item">Organizacion: <strong>{!! $sit->organizacionnombre !!}</strong></li>
                                <li class="collection-item">Tipo de Pago: <strong>{!! $sit->tipopagodsc !!}</strong></li>
                                <li class="collection-item">Status : <strong>{!! $sit->statusnombre !!}</strong></li>
                                @if($sit->observaciones!="")
                                    <li class="collection-item">Observaciones : <strong>{!! $sit->observaciones !!}</strong></li>
                                    <li class="collection-item">
                                        Si tiene algun comentario sobre esta solicitud favor de realizarla con los lideres de su unidad <strong>{!! $sit->datosbarrio->nombreunidad !!}</strong>
                                        o envieles un correo electronico <a href="mailto:{!! $sit->datosbarrio->email !!}">{!! $sit->datosbarrio->email !!}</a>
                                    </li>
                                @endif



                                @if($sit->idsit!='' && $sit->status!=64)
                                    <li class="center-align">
                                        <a href="{!! route('pdfsit',[$sit->id,'completo','descargar',$sit->token]) !!}" class="waves-effect waves-light green lighten-3 btn-flat tooltipped"data-position="top" data-tooltip="Impreme Formato Completo"><i class="material-icons right">print</i>Completo</a>
                                        <a href="{!! route('pdfsit',[$sit->id,'sit','descargar',$sit->token]) !!}" class="waves-effect waves-light green lighten-3 btn-flat tooltipped"data-position="top" data-tooltip="Imprime el SIT para ir al Banco"><i class="material-icons right">print</i>SIT</a>
                                        <a href="{!! route('pdfsit',[$sit->id,'solicitud','descargar',$sit->token]) !!}" class="waves-effect waves-light green lighten-3 btn-flat tooltipped"data-position="top" data-tooltip="Imprime Solo la Solicitud de Gasto"><i class="material-icons right">print</i>Solicitud</a>

                                    </li>

                                @endif
                            @endif
                        </ul>

                    </div>

                    <div id="comprobantes" class="col s12">
                        <a href="#uploadfile"  class="btn-flat waves-effect waves-light blue lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Agregar Archivo"><i class="material-icons">cloud_upload</i></a>
                        <table class="bordered responsive-table highlight striped">
                            <thead>
                            <tr>
                                <th data-field="referencia">ID</th>
                                <th data-field="nombre">Nombre</th>
                                <th data-field="descripcion">Descripcion</th>
                                <th data-field="tipo">Tipo</th>
                                <th data-field="cantidad">Monto</th>
                                <th data-field="subido">Subido por</th>
                                <th data-field="validado">Validado por</th>
                                <th data-field="acciones">Acciones</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($archivossit as $archivo)
                                <tr data-id={!! $archivo->id !!}>
                                    <td class="blue-text"><u>{!!$archivo->id !!}</u></td>
                                    <td>{!!$archivo->nombrearchivo !!}</td>
                                    <td>{!!$archivo->descripcionarchivo !!}</td>
                                    <td>{!!$archivo->tipoarchivo !!}</td>
                                    <td>{!!$archivo->montoarchivo !!}</td>
                                    <td>{!!$archivo->subidonombre !!}</td>
                                    <td>

                                            {!!  $archivo->validadonombre !!}


                                    </td>
                                    <td>
                                        <a href="{!! url('download?path='.public_path('archivossit')."/".$archivo->rutaarchivo)!!}" class="btn-floating green tooltipped waves-effect waves-ligh" data-position="top" data-tooltip="Descargar Archivo"><i class="material-icons">cloud_download</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>





            </div>
        </div>
    </div>


    <!-- Modal subir archivo -->
    <div id="uploadfile" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Agregar Archivo </h4>
            {!! Form::open(['url' => ['guardararchivoexterno',$sit->token],'files' => true, 'method' => 'post','id'=>'uploadfileform'])  !!}

            {!! Form::text('idsit',$sit->id,['placeholder'=>'','class'=>'hide','id'=>'idsit']) !!}
            {!! Form::text('token',csrf_token() ,['class'=>'hide','id'=>'token']) !!}



            <div class="input-field col m12 s10">
                <i class="material-icons prefix">description</i>
                {!! Form::text('nombrearchivo','',['class'=>'validate input-field','id'=>'nombrearchivo','placeholder'=>'Ingresa el Nombre del archivo'])  !!}
                @if ($errors->has('nombrearchivo'))
                    <span class="help-block red-text">
                                <strong>{{ $errors->first('nombrearchivo') }}</strong>
                            </span>
                @endif
                <label for="nombrearchivo" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre</label>
                <div class="form-group{{ $errors->has('nombrearchivo') ? ' has-error' : '' }}">
                </div>
            </div>


            <div class="input-field col m12 s10">
                <i class="material-icons prefix">description</i>
                {!! Form::text('descripcionarchivo','',['class'=>'validate input-field','id'=>'descripcionarchivo','placeholder'=>'Descripcion del archivo'])  !!}
                @if ($errors->has('descripcionarchivo'))
                    <span class="help-block red-text">
                                <strong>{{ $errors->first('descripcionarchivo') }}</strong>
                            </span>
                @endif
                <label for="descripcionarchivo" data-error="dato no valido" data-success="Correcto" class="left-align">Descripcion</label>
                <div class="form-group{{ $errors->has('descripcionarchivo') ? ' has-error' : '' }}">
                </div>
            </div>


            <div class="input-field col m12 s10">
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



        </div>
        <div class="modal-footer">
            <button  type="submit" href="#!" class=" waves-effect waves-green btn-flat tooltipped" data-position="top" data-tooltip="Guardar Registro">Guardar</button>
            {{--<a  id="addfile" class="btn-flat waves-effect waves-light green lighten-3" data-position="top" data-tooltip="Guardar"><i class="material-icons">save</i>Guardar</a>--}}
            <a href="" class="modal-action modal-close waves-effect waves-green btn-flat ">Canlcel</a>

        </div>

        {!! Form::close() !!}
    </div>


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

@endsection