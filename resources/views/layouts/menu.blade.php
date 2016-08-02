<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper grey darken-4 ">

            @if(Auth::guest())
                <a href="/home" class="brand-logo"><img style="max-width:55px; margin-top: -2px;" src="{!! asset('imagenes/logotransparente.png') !!}" border="0"></a>
            @else
                {{--<a href="/" class="navbar-brand">Test</a>--}}
                <a href="/home" class="brand-logo"><img style="max-width:55px; margin-top: -2px;" src="{!! asset('imagenes/logotransparente.png') !!}" border="0">{!! Auth::user()->barrionombre !!}</a>
                {{--<a class="brand-logo">{!! Auth::user()->barrionombre !!}</a>--}}

            @endif


            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                @if(Auth::guest())
                    <li><a href="/"><i class="material-icons left">home</i>Inicio</a></li>
                    <li><a href="{!! route('solicitudgasto') !!}"><i class="material-icons left">payment</i>Solicitar Gasto</a></li>

                    <li><a href="{!! route('auth/login') !!}"><i class="material-icons left">perm_identity</i>Ingresar</a></li>
                @else


                    @role('admin|pcia_estaca|sec_estaca|obispado|sec_barrio')
                    <li><a class="dropdown-button" href="#!" data-activates="programas">Formatos Programas  <i class="material-icons right">assignment</i></a></li>
                    <li><a class="dropdown-button" href="#!" data-activates="gastos">Gastos Unidad  <i class="material-icons right">payment</i></a></li>
                    @endrole

                    <li><a class="dropdown-button" href="#!" data-activates="cartas">Formatos Cartas<i class="material-icons right">import_contacts</i></a></li>


                    @role('admin|pcia_estaca|sec_estaca|obispado|sec_barrio')
                    <li><a class="dropdown-button" href="#!" data-activates="barrio">Herramientas Barrio<i class="material-icons right">home</i></a></li>
                    @endrole


                    @role('admin')
                        <li><a class="dropdown-button" href="#!" data-activates="administracion">Administracion<i class="material-icons right">supervisor_account</i></a></li>
                    @endrole


                    <li><a class="dropdown-button" href="#!" data-activates="usuario">{!! Auth::user()->name !!}<i class="material-icons right">perm_identity</i></a></li>

                @endif
            </ul>

            {{--menus para mobiles--}}
            <ul class="side-nav " id="mobile-demo">


                @if(Auth::guest())
                    <li><a href="/" ><img style="max-width:55px; margin-top: -2px;" src="{!! asset('imagenes/logotransparente.png') !!}" border="0"></a></li>
                    <li><a href="/"><i class="material-icons left">home</i>Inicio</a></li>
                    <li><a href="{!! route('solicitudgasto') !!}"><i class="material-icons left">payment</i>Solicitar Gasto</a></li>
                    <li><a href="{!! route('auth/login') !!}"><i class="material-icons left">perm_identity</i>Ingresar</a></li>
                @else
                    <li><a href="/" ><img style="max-width:55px; margin-top: -2px;" src="{!! asset('imagenes/logotransparente.png') !!}" border="0"></a></li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a class="collapsible-header">{!! Auth::user()->name !!}<i class="material-icons">account_circle</i></a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li>
                                            <a class="black-text" href="{!!url('/logout') !!}">Salir<i class="material-icons left">exit_to_app</i></a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            @role('admin')
                            <li>
                                <a class="collapsible-header">Adminsitracion<i class="material-icons">supervisor_account</i></a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li>
                                        <li><a class="black-text" href="{!!url('usuarios') !!}">Usuarios<i class="material-icons right">supervisor_account</i></a></li>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endrole

                            @role('admin|pcia_estaca|sec_estaca|obispado|sec_barrio')
                            <li>
                                <a class="collapsible-header">Barrio<i class="material-icons">home</i></a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li>
                                        <li><a class="black-text" href="{!!url('lideres') !!}">Lideres<i class="material-icons right">supervisor_account</i></a></li>
                                        <li><a class="black-text" href="{!!url('cumples') !!}">Cumpleaños<i class="material-icons right">event</i></a></li>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endrole

                            {{--Cartas--}}
                            <li>
                                <a class="collapsible-header">Cartas<i class="material-icons">import_contacts</i></a>
                                <div class="collapsible-body">
                                    <ul>
                                        @permission('add.asignacion|view.asignacion')
                                        <li><a class="black-text" href="{!!url('asignaciones') !!}">Asignaciones<i class="material-icons right">content_paste</i></a></li>
                                        @endpermission
                                        @permission('add.asignacion|view.asignacion')
                                        <li><a class="black-text" href="{!!url('entrevistas') !!}">Entrevistas<i class="material-icons right">event_seat</i></a></li>
                                        @endpermission
                                        @permission('add.discurso|view.discurso')
                                        <li><a class="black-text" href="{!!url('discursos') !!}">Discursos<i class="material-icons right">mic_none</i></a></li>
                                        @endpermission

                                    </ul>
                                </div>
                            </li>
                            {{--Fincartas--}}

                            {{--gastos--}}
                            <li>
                                <a class="collapsible-header">Gastos<i class="material-icons">payment</i></a>
                                <div class="collapsible-body">
                                    <ul>

                                        <li><a class="black-text" href="{!!url('solicitudgasto') !!}">Solicitar Gasto<i class="material-icons right">content_paste</i></a></li>
                                        @permission('edit.solicitudes|add.solicitudes|view.solicitudes')
                                        <li><a class="black-text" href="{!!url('solicitudes') !!}">Solicitudes<i class="material-icons right">card_membership</i></a></li>
                                        @endpermission
                                        @permission('add.sit|view.sit')
                                        <li><a class="black-text" href="{!!url('sits') !!}">Sit`s<i class="material-icons right">account_balance_wallet</i></a></li>
                                        @endpermission

                                    </ul>
                                </div>
                            </li>
                            {{--fin gastos--}}
                            {{--inicio de programas--}}
                            <li>
                                <a class="collapsible-header">Programas<i class="material-icons">assignment</i></a>
                                <div class="collapsible-body">
                                    <ul>


                                        @permission('add.bautizmal|edit.bautizmales')
                                        <li><a class="black-text" href="{!!url('bautizmales') !!}">Bautismales<i class="material-icons right">accessibility</i></a></li>
                                        @endpermission
                                        @permission('add.sacramentales|edit.sacramentales')
                                        <li><a class="black-text" href="{!!url('sacramentales') !!}">Sacramentales<i class="material-icons right">chrome_reader_mode</i></a></li>
                                        @endpermission
                                        {{--@permission('add.sit|view.sit')--}}
                                        {{--<li><a class="black-text" href="{!!url('sits') !!}">Sit`s<i class="material-icons right">account_balance_wallet</i></a></li>--}}
                                        {{--@endpermission--}}

                                    </ul>
                                </div>
                            </li>
                            {{--fin de programas--}}


                        </ul>
                    </li>
                @endif


            </ul>
        </div>

        {{--combos para menu principal--}}
        <ul id="usuario" class="dropdown-content">
            <li><a class="black-text" href="{!!url('/logout') !!}">Salir<i class="material-icons right">exit_to_app</i></a></li>
        </ul>
        <ul id="administracion" class="dropdown-content">
            <li><a class="black-text" href="{!!url('usuarios') !!}">Usuarios<i class="material-icons right">supervisor_account</i></a></li>
        </ul>


        <ul id="barrio" class="dropdown-content">
            <li>
                <a class="black-text" data-activates="listadolideres" href="{!!url('lideres') !!}">Lideres<i class="material-icons right">supervisor_account</i></a>
            </li>
            <li>
                <a class="black-text" data-activates="cumples" href="{!!url('cumples') !!}">Cuempleaños<i class="material-icons right">event</i></a>
            </li>
        </ul>

        <ul id="gastos" class="dropdown-content">
            <li>
                <a class="black-text"  href="{!!url('solicitudgasto') !!}">Solicitar<i class="material-icons right">attach_money</i></a>
                @permission('add.solicitudes|view.solicitudes')
                <a class="black-text"  href="{!!url('solicitudes') !!}">Solicitudes<i class="material-icons right">card_membership</i></a>
                @endpermission
                @permission('add.sit|view.sit')
                <a class="black-text"  href="{!!url('sits') !!}">Sit's<i class="material-icons right">account_balance_wallet</i></a>
                @endpermission
            </li>
        </ul>

        <ul id="programas" class="dropdown-content">
            <li>
                @permission('add.bautizmal|view.bautizmal')
                <a class="black-text"  href="{!!url('bautizmales') !!}">Bautizmales<i class="material-icons right">accessibility</i></a>
                {{--<a class="black-text"  href="{!!url('solicitudes') !!}">Solicitudes<i class="material-icons right">card_membership</i></a>--}}
                @endpermission
                @permission('add.sacramentales|view.sacramentales')
                <a class="black-text"  href="{!!url('sacramentales') !!}">Sacramentales<i class="material-icons right">chrome_reader_mode</i></a>
                {{--<a class="black-text"  href="{!!url('solicitudes') !!}">Solicitudes<i class="material-icons right">card_membership</i></a>--}}
                @endpermission

            </li>
        </ul>


        {{--listado de lideres--}}


        <ul id="cartas" class="dropdown-content">
            @permission('add.asignacion|view.asignacion')
            <li><a class="black-text" href="{!!url('asignaciones') !!}">Asignaciones<i class="material-icons right">content_paste</i></a></li>
            @endpermission

            @permission('add.entrevista|view.entrevista')
            <li><a class="black-text" href="{!!url('entrevistas') !!}">Entrevistas<i class="material-icons right">event_seat</i></a></li>
            @endpermission

            @permission('add.discurso|view.discurso')
            <li><a class="black-text" href="{!!url('discursos') !!}">Discursos<i class="material-icons right">mic_none</i></a></li>
            @endpermission
        </ul>




    </nav>
</div>