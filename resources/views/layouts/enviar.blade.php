<div class="modal fade" tabindex="-1" role="dialog" id="enviar" data-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title titulo text-center"></h4>
            </div>


            <div class="form-horizontal">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                <input type="hidden" name="id" value="" id="id">

                    <div class="form-group">

                        {!! Form::label('nombre','',['class'=>'col-sm-2 control-label'])!!}
                        <div class="col-sm-9">
                            <div class='date input-group' id='date'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                                {!! Form::text('nombre',"",['placeholder'=>'nombre Completo','class'=>'form-control','id'=>'nombre']) !!}

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('correo','',['class'=>'col-sm-2 control-label'])!!}
                        <div class="col-sm-9">
                            <div class='date input-group' id='date'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </span>
                                {!! Form::text('email',"",['placeholder'=>'nombre@domino.com','class'=>'form-control','id'=>'email']) !!}

                            </div>
                        </div>
                    </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>


                {!! link_to('#',$title='Enviar',$attributes=['id'=>'enviarcorreo','class'=>'btn btn-success','role'=>'button'],$secure=null) !!}
            </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->