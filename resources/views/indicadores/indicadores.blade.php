@extends('layouts.app')

@section('contenido')


    <div class="container-fluid">

            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Indicadores Barrio</h3>
                    </div>


                    <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped table-condensed clearfix">
                            <tr class="">
                                <th data-field="id">Indicador</th>
                                <th data-field="real">Real</th>
                                <th data-field="potencial">Potencial</th>
                                <th data-field="meta">Meta</th>
                            </tr>
                            @foreach($indicadores as $indicador)
                                <tr id="{!! $indicador->id !!}">
                                    <td>{!!$indicador->id.".- ".$indicador->nombre !!}</td>
                                    <td class="text-right">{!! Form::text('real',$valores[$indicador->id]['real'][0]->valor,['OnChange'=>'cambio(this)','id'=>$valores[$indicador->id]['real'][0]->id.'-real-'.$valores[$indicador->id]['real'][0]->idindicador,'class'=>'form-control input-sm text-right','style'=>'height: 30px;width: 60px;']) !!}
                                    <td class="text-right">{!! Form::text('potencial',$valores[$indicador->id]['potencial'][0]->valor,['OnChange'=>'cambio(this)','id'=>$valores[$indicador->id]['potencial'][0]->id.'-potencial-'.$valores[$indicador->id]['potencial'][0]->idindicador,'class'=>'form-control input-sm text-right','style'=>'height: 30px;width: 60px;']) !!}
                                    <td class="text-right">{!! Form::text('meta',$valores[$indicador->id]['meta'][0]->valor,['OnChange'=>'cambio(this)','id'=>$valores[$indicador->id]['meta'][0]->id.'-meta-'.$valores[$indicador->id]['meta'][0]->idindicador,'class'=>'form-control input-sm text-right','style'=>'height: 30px;width: 60px;']) !!}

                                </tr>
                            @endforeach

                        </table>
                    </div>
                    </div>{{--fin del panel body--}}
                </div>

                {!! Form::open(['route'=>['actualizaindicador',':ID'],'method'=>'PUT','id'=>'form-update','class'=>'hide']) !!}
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                {{--<input type="hidden" name="id" value="" id="id">--}}
                {!! Form::close() !!}
            </div>
    </div>


@endsection

@section('scripts')
    {!! Html::script('js/actualizaindicador.js') !!}


@endsection