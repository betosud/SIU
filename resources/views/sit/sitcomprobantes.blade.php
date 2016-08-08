@permission('add.archivosit')
{{--<div class="col m6 s6">--}}
{{--<a href="#uploadfile"  class="btn btn-flat waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Agregar Archivo"><i class="material-icons">backup</i>Agregar</a>--}}
{{--</div>--}}
{{--<div class="col m6 s6">--}}
{{--<a  OnClick='mostrar(this)' id="{!! $sit->id !!}" href="#enviarcomprobantes" class="btn btn-flat waves-effect waves-light green lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Enviar Oficinas"><i class="material-icons ">mail_outline</i>Enviar</a>--}}
{{--</div>--}}
@endpermission
<div class="comprobantes">
    @permission('add.archivosit')
        <a href="#uploadfile"  class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Agregar Archivo"><i class="material-icons">backup</i>Agregar</a>
        <a  OnClick='mostrar(this)' id="{!! $sit->id !!}" href="#enviarcomprobantes" class="btn btn-floating waves-effect waves-light green lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Enviar Oficinas"><i class="material-icons ">mail_outline</i>Enviar</a>
    @endpermission
    <table class="bordered highlight striped responsive-table">
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
                @if($archivo->validadopor==0)
                    {!!  Form::select('validado', ['0'=>'No Validado','1'=>'Validado'],$archivo->validadonombre,['class'=>'validado browser-default input-field','id'=>'validado'.$archivo->id]) !!}
                @else
                        {!!  $archivo->validadonombre !!}
                    @endif

                </td>
                <td>
                    <a href="{!! url('download?path='.public_path('archivossit')."/".$archivo->rutaarchivo)!!}" class="btn-floating green tooltipped waves-effect waves-ligh" data-position="top" data-tooltip="Descargar Archivo"><i class="material-icons">cloud_download</i></a>

                    @permission('delete.filesit')
                    <a href="#eliminarfile{!! $archivo->id !!}" class="btn-floating red modal-trigger waves-effect waves-ligh"><i class="material-icons">delete</i></a>
                    @endpermission
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination">

        {!! $archivossit->render() !!}

    </div>

{{--modales para borrar--}}
    @foreach($archivossit as $archivo)
    <div id="eliminarfile{!! $archivo->id !!}" class="modal">
        <div class="modal-content">
            <h5 class="center-align">Eliminar Archivo</h5>
            <p>Esta Seguro de Borrar el Archivo?</p>
            <br>
            <ul class="collection">
                <li class="collection-item">Nombre: <strong>{!! $archivo->nombrearchivo !!}</strong></li>
                <li class="collection-item">Descripcion: <strong>{!! $archivo->descripcionarchivo !!}</strong></li>
                <li class="collection-item">Tipo: <strong>{!! $archivo->tipoarchivo !!}</strong></li>
                <li class="collection-item">Monto: <strong>{!! $archivo->montoarchivo !!}</strong></li>
                <li class="collection-item">Subido por : <strong>{!! $archivo->subidonombre !!}</strong></li>
                <li class="collection-item">Validado por : <strong>{!! $archivo->validadonombre !!}</strong></li>

            </ul>




        </div>
        <div class="modal-footer">
            <a href="{!! route('eliminararchivosit',$archivo->id ) !!}" class="waves-effect waves-green btn-flat green lighten-2">Borrar</a>
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
        </div>
    </div>
        @endforeach



</div>


