@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                @if(Session::has('message'))
                    <script>
                        Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
                    </script>
                @endif
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Entrevistas</h4>
                    </div>
                </div>
                    @permission('add.entrevista')
                <a href="{!! route('nuevaentrevista') !!}" class="btn btn-floating waves-effect waves-light blue lighten-2 tooltipped " data-position="left" data-tooltip="Nueva Entrevista"><i class="material-icons ">add</i></a>
                    @endpermission
                <div class="entrevistas">

                    <table class="bordered responsive-table highlight">
                        <thead>
                        <tr>
                            <th data-field="id">Nombre</th>
                            <th data-field="name">Fecha</th>
                            <th data-field="price">Hora</th>
                            <th data-field="price">Realizado</th>
                            <th data-field="price">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($entrevistas as $entrevista)
                            <tr data-id={!! $entrevista->id !!}>
                                <td>{!!$entrevista->nombre !!}</td>
                                <td>{!!$entrevista->fechadma !!}</td>
                                <td>{!!$entrevista->horahm !!}</td>
                                <td>
                                    {!!  Form::select('status', ['0'=>'No','1'=>'Si'],$entrevista->realizado,['class'=>'status browser-default input-field','id'=>'status'.$entrevista->id]) !!}
                                </td>
                                <td>
                                    <a href="{!! route('pdfentrevista',[$entrevista->id,'descargar',$entrevista->token]) !!}" class="btn btn-floating waves-effect waves-light black tooltipped " data-position="top" data-tooltip="Imprimir"><i class="material-icons ">print</i></a>
                                    @permission('edit.asignacion')
                                    <a href="{!! route('editarentrevista',$entrevista->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
                                    @endpermission
                                    @permission('send.asignacion')
                                    <a OnClick='mostrar(this)' id="{!! $entrevista->id !!}" href="#enviar" class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Enviar"><i class="material-icons ">mail_outline</i></a>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="pagination">

                        {!! $entrevistas->render() !!}

                    </div>

                    @include('layouts.enviar')
                    {!! Html::script('js/enviarentrevista.js') !!}
                    {!! Html::script('js/actualizastatusentrevista.js') !!}
                    {!! Html::script('js/utiles.js') !!}
                </div>


            </div>
        </div>
    </div>

    {!! Form::open(['route'=>['actualizarentrevistastatus',':ID'],'method'=>'PUT','id'=>'form-update','class'=>'hide']) !!}
    {!! Form::text('realizado',':VALOR' ,['class'=>'realizado ']) !!}
    {!! Form::close() !!}
    @include('layouts.loading')

@endsection
@section('scripts')

    {!! Html::script('js/paginacion.js') !!}
@endsection