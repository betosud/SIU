<nav class="navbar navbar-default" role="navigation">
<div class="container-fluid">
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#acolapsar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>
        @if(Auth::guest())
            <a href="/" class="brand-logo"><img style="max-width:55px; margin-top: -2px;" src="{!! asset('imagenes/logotransparente.png') !!}" border="0"></a>
        @else
            {{--<a href="/" class="navbar-brand">Test</a>--}}
            <a href="/" class="brand-logo"><img style="max-width:55px; margin-top: -2px;" src="{!! asset('imagenes/logotransparente.png') !!}" border="0"></a>
            <a class="brand-logo">{!! Auth::user()->barrionombre !!}</a>

            @endif
        </div>
            <nav class="collapse navbar-collapse" id="acolapsar">
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::guest())
                        <li><a href="/">Inicio<span class="glyphicon glyphicon-home"></span></a></li>
                        <li><a href={!! route('solicitudgasto') !!}>Solicitar Gasto</a></li>
                        <li><a href={!! route('auth/login') !!}>Ingresar</a></li>
                        {{--<li><a href="http://www.estacaamecameca.org">Pagina<i class=""></i></a></li>--}}
                        {{--<li><a href="http://www.lds.org">Sitio Oficial<i class=""></i></a></li>--}}
                        {{--<li><a href="http://www.facebook.com/estacaamecameca">Facebook<i class=""></i></a></li>--}}
                    @else
                        {{--@permission('view.solicitudes')--}}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gastos <span class="glyphicon gly glyphicon glyphicon glyphicon-usd"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href={!! route('solicitudgasto') !!}><span class="glyphicon-align-right glyphicon glyphicon glyphicon-menu-hamburger"></span> Nueva Solicitud</a></li>
                                @permission('view.solicitudes|edit.solicitudes')
                                <li><a href={!! route('solicitudes') !!}><span class="glyphicon-align-right glyphicon glyphicon glyphicon-inbox"></span> Solicitudes</a></li>
                                @endpermission

                                @permission('view.sit|edit.sit')
                                <li><a href={!! route('sits') !!}><span class="glyphicon-align-right glyphicon glyphicon glyphicon-menu-hamburger"></span> Sit's</a></li>
                                @endpermission
                            </ul>
                        </li>
                    {{--@endpermission--}}

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cartas <span class="glyphicon gly glyphicon glyphicon glyphicon-book"></span></a>
                            <ul class="dropdown-menu">
                                @permission('view.discurso|add.discurso')
                                <li><a href={!! route('discursos') !!}><span class="glyphicon-align-right glyphicon glyphicon glyphicon-list-alt"></span> Discursos</a></li>
                                @endpermission
                                @permission('add.entrevista|view.entrevista')
                                <li><a href={!! route('entrevistas') !!}><span class="glyphicon-align-right glyphicon glyphicon-list-alt"></span> Entrevistas</a></li>
                                @endpermission

                                @permission('add.asignacion|view.asignacion')
                                <li><a href={!! route('asignaciones') !!}><span class="glyphicon-align-right glyphicon glyphicon-list-alt"></span> Asignaciones</a></li>
                                @endpermission
                            </ul>
                        </li>



                        @role('admin|pcia_estaca|sec_estaca|obispado|sec_barrio')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Barrio <span class="glyphicon gly glyphicon-home"></span></a>
                            <ul class="dropdown-menu">
                                @permission('view.indicadores|edit.indicadores')
                                <li><a href={!! route('indicadoresbarrio') !!}><span class="glyphicon glyphicon-stats"></span> Indicadores</a></li>
                                @endpermission
                                @permission('add.lider|view.lider')
                                <li><a href={!! route('lideres') !!}><span class="glyphicon glyphicon-user"></span> Lideres</a></li>
                                @endpermission
                            </ul>
                        </li>
                        @endrole

                        @role('admin')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administracion <span class="glyphicon gly glyphicon-cog"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href={!! route('usuarios') !!}><span class="glyphicon glyphicon-user"></span> Usuarios</a></li>
                            </ul>
                        </li>
                        @endpermission
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{!! Auth::user()->name !!} <span class="glyphicon gly glyphicon-user"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href={!! route('auth/logout') !!}><span class="glyphicon gly glyphicon-log-out"></span> Salir</a></li>
                            </ul>
                        </li>

                    @endif


                    {{--<li><a href="#"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>--}}

                </ul>
            </nav>
</div>
</nav>