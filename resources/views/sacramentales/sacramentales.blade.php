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
                        <h4 class="center login-form-text">Sacramentales</h4>
                    </div>
                </div>
                @permission('add.sacramentales')
                <a href="{!! route('nuevosacramental') !!}" class="btn btn-floating waves-effect waves-light blue lighten-2 tooltipped " data-position="left" data-tooltip="Nueva Entrevista"><i class="material-icons ">add</i></a>
                @endpermission
                <div class="sacramentales">

                    <table class="bordered responsive-table highlight">
                        <thead>
                        <tr>

                            <th data-field="name">Fecha</th>
                            <th data-field="price">Hora</th>
                            <th data-field="price">Preside</th>
                            <th data-field="price">Direccion</th>
                            <th data-field="price">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($sacramentales as $sacramental)
                            <tr data-id={!! $sacramental->id !!}>
                                <td>{!!$sacramental->fechadma !!}</td>
                                <td>{!!$sacramental->horahm !!}</td>
                                <td>{!!$sacramental->preside !!}</td>

                                <td>{!!$sacramental->direccion_programa !!}</td>

                                <td>
                                    {{--<a href="{!! route('pdfentrevista',[$entrevista->id,'descargar',$entrevista->token]) !!}" class="btn btn-floating waves-effect waves-light black tooltipped " data-position="top" data-tooltip="Imprimir"><i class="material-icons ">print</i></a>--}}
                                    @permission('edit.sacramentales')
                                    <a href="{!! route('editarsacramental',$sacramental->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
                                    @endpermission
                                    @permission('print.sacramentales')
                                    <a href="{!! route('pdfsacramental',$sacramental->id) !!}" class="btn btn-floating waves-effect waves-light blue lighten-2 tooltipped " data-position="top" data-tooltip="Imprimir"><i class="material-icons ">print</i></a>
                                    @endpermission
                                    {{--@permission('send.asignacion')--}}
                                    {{--<a OnClick='mostrar(this)' id="{!! $entrevista->id !!}" href="#enviar" class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Enviar"><i class="material-icons ">mail_outline</i></a>--}}
                                    {{--@endpermission--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="pagination">
                        {!! $sacramentales->render() !!}
                    </div>
                </div>


            </div>
        </div>
    </div>
    @include('layouts.loading')
@endsection
@section('scripts')

    {!! Html::script('js/paginacion.js') !!}
@endsection