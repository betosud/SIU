<div class="container-fluid col-lg-3">
    <div id="nuevo" name="nuevo" class="modal modal-fixed-footer" >
        <div class="modal-content">
            <h4 class="modal-title titulo center-align"></h4>

            {{--<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">--}}
            {{--<input type="hidden" name="id" value="" id="id">--}}
            {!! Form::open(array('url' => 'guardarcumple', 'method' => 'post','class'=>'form-horizontal','id'=>'form-addcumple')) !!}
            <div class="row margin">
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">account_circle</i>
                    {!! Form::text('nombre','',['class'=>'validate input-field','id'=>'nombre','placeholder'=>'Nombre'])  !!}
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
                    {!! Form::text('fecha','',['class'=>'validate input-field datepicker','id'=>'datepicker','placeholder'=>'Fecha Nacimiento'])  !!}
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
            {{--<div class="input-field col s4 m6 ">--}}
                <button type="submit" class="btn-flat waves-effect waves-light green tooltipped" data-position="top" data-tooltip="Guardar"> <i class="material-icons">save</i>Guardar</button>
            {{--</div>--}}


            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable">Cancelar</a>

        </div>
        {!! Form::close() !!}
    </div>
</div>




