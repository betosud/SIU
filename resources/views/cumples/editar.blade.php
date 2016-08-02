<div class="container-fluid col-lg-3">
    <div id="editar" name="editar" class="modal modal-fixed-footer" >
        <div class="modal-content">
            <h4 class="modal-title titulo center-align"></h4>

            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
            {{--<input type="hidden" name="id" value="" id="id">--}}

{{--            {!! Form::model(['route' => ['guardarcumple',':ID'], 'method' => 'PUT','class'=>'form-horizontal-update','id'=>'form-horizontal-update']) !!}--}}
            <div class="row margin">
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">account_circle</i>
                    {!! Form::text('idactualiza','',['class'=>'validate input-field idactualiza hide','id'=>'idactualiza','placeholder'=>'Nombre Completo'])  !!}
                    {!! Form::text('nombre','',['class'=>'validate input-field nombre','id'=>'nombre','placeholder'=>'Nombre Completo'])  !!}
                    @if ($errors->has('nombre'))
                        <span class="help-block red-text">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                    @endif
                    <label for="email" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre</label>
                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    </div>
                </div>
            </div>

            <div class="row margin">
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">event</i>
                    {!! Form::text('fecha','',['class'=>'validate input-field datepicker fecha','id'=>'fecha','placeholder'=>'Fecha Nacimiento'])  !!}
                    @if ($errors->has('fecha'))
                        <span class="help-block red-text">
                                <strong>{{ $errors->first('fecha') }}</strong>
                            </span>
                    @endif
                    <label for="fecha" data-error="dato no valido" data-success="Correcto" class="left-align">Fecha Nacimiento</label>
                    <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                    </div>
                </div>
            </div>



        </div>
        <div class="modal-footer">
            {!! link_to('#',$title='Actualizar',$attributes=['id'=>'actualizarcumple','class'=>'modal-action modal-close waves-effect waves-green btn-flat','role'=>'button'],$secure=null) !!}
            {!! link_to('#',$title='Eliminar',$attributes=['id'=>'eliminarcumple','class'=>'modal-action modal-close waves-effect waves-red btn-flat','role'=>'button'],$secure=null) !!}
            {{--<button type="submit" class="btn-flat waves-effect waves-light green lighten-2 tooltipped" data-position="top" data-tooltip="Guardar"> <i class="material-icons">save</i>Guardar</button>--}}
            {{--<button  class="btn-flat waves-effect waves-light red lighten-2 tooltipped" data-position="top" data-tooltip="Eliminar"> <i class="material-icons">delete</i>Eliminar</button>--}}



            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable blue lighten-2">Cancelar</a>

        </div>
{{--        {!! Form::close() !!}--}}
    </div>
</div>




