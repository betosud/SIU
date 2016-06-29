<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper grey darken-4 ">

        @if(Auth::guest())
            <a href="/" class="brand-logo"><img style="max-width:55px; margin-top: -2px;" src="{!! asset('imagenes/logotransparente.png') !!}" border="0"></a>
        @else
            {{--<a href="/" class="navbar-brand">Test</a>--}}
            <a href="/" class="brand-logo"><img style="max-width:55px; margin-top: -2px;" src="{!! asset('imagenes/logotransparente.png') !!}" border="0">{!! Auth::user()->barrionombre !!}</a>
            {{--<a class="brand-logo">{!! Auth::user()->barrionombre !!}</a>--}}

        @endif


        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            @if(Auth::guest())
                <li><a href="/"><i class="material-icons left">home</i>Inicio</a></li>
                <li><a href="/"><i class="material-icons left">payment</i>Solicitar Gasto</a></li>

                <li><a href="{!! route('auth/login') !!}"><i class="material-icons left">perm_identity</i>Ingresar</a></li>
                {{--<li><a href="http://www.estacaamecameca.org">Pagina<i class=""></i></a></li>--}}
                {{--<li><a href="http://www.lds.org">Sitio Oficial<i class=""></i></a></li>--}}
                {{--<li><a href="http://www.facebook.com/estacaamecameca">Facebook<i class=""></i></a></li>--}}
            @else

                    {{--<li><a class="dropdown-button" href="#!" data-activates="cartas">Cartas<i class="material-icons right">collections_bookmark</i></a></li>--}}
                    {{--@role('admin')--}}
                        <li><a class="dropdown-button" href="#!" data-activates="administracion">Administracion<i class="material-icons right">supervisor_account</i></a></li>
                    {{--@endrole--}}
                    <li><a class="dropdown-button" href="#!" data-activates="usuario">{!! Auth::user()->name !!}<i class="material-icons right">perm_identity</i></a></li>

            @endif
        </ul>

            {{--menus para mobiles--}}
        <ul class="side-nav " id="mobile-demo">


            @if(Auth::guest())
                <li><a href="/" ><img style="max-width:55px; margin-top: -2px;" src="{!! asset('imagenes/logotransparente.png') !!}" border="0"></a></li>
                <li><a href="/"><i class="material-icons left">home</i>Inicio</a></li>
                <li><a href="/"><i class="material-icons left">payment</i>Solicitar Gasto</a></li>
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

    <ul id="cartas" class="dropdown-content">
        @permission('add.asignacion|view.asignacion')
        <li><a class="black-text" href="{!!url('usuarios') !!}">Usuarios<i class="material-icons right">supervisor_account</i></a></li>
        @endpermission
    </ul>
</nav>
</div>