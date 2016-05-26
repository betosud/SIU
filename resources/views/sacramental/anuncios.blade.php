<div class="divider"></div>
<div class="btn-group">
    <a class="agregar_anuncio btn btn-success glyphicon glyphicon-plus" id="agregar_anuncio" href="#" role="button" data-toggle="tooltip" data-placement="top" title="Agregar Anuncio"></a>
</div>
<div class="btn-group">
    <a class="btn btn-danger glyphicon glyphicon-remove" href="#" role="button" data-toggle="tooltip" data-placement="top" title="Eliminar anuncio"></a>
</div>


<?php $numanuncio=0;?>
@foreach($eventos as $evento)
    <?php $numanuncio++ ?>
    <div class="row" id="anuncio{!! $numanuncio !!}">




        <div class="form-group referencia_anuncio">
{{--            {!! Form::label($numanuncio,'',['class'=>'col-md-1 control-label'])!!}--}}
            <div class="col-md-12">
                {{--<div class='anuncio{!! $numanuncio !!}' id='anuncio{!! $numanuncio !!}'>--}}
                    {!! Form::text('tbxanuncio'.$numanuncio,"$evento",['placeholder'=>'Datos del Evento','class'=>'form-control','id'=>'tbxanuncio'.$numanuncio]) !!}
                {{--</div>--}}
            </div>
        </div>




    </div>
@endforeach