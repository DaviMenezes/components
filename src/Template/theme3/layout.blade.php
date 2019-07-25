<!DOCTYPE html>
<html lang="pt-BR">
@include('theme3/header')

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="https://github.com/DaviMenezes/Dvi-for-Adianti" target="newwindow" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>Dvi</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{{$appname}}</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        {{$if_builder}}
                        <li class="dropdown" id="asdf">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-cog fa-fw"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a onclick="__adianti_builder_edit_page()" generator="adianti" style="cursor:pointer">
                                        <i class="fa fa-pencil-square-o blue"></i> Editar a página
                                    </a>
                                </li>
                                <li>
                                    <a onclick="__adianti_builder_update_page()" generator="adianti" style="cursor:pointer">
                                        <i class="fa fa-download green"></i> Atualizar a página
                                    </a>
                                </li>
                                <li>
                                    <a onclick="__adianti_builder_get_new_pages()" generator="adianti" style="cursor:pointer">
                                        <i class="fa fa-cloud-download orange"></i> Baixar novas páginas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{$end_if_builder}}

                        <li class="dropdown messages-menu" id="envelope_messages">
                            <!-- /.dropdown-messages -->
                        </li>

                        <li class="dropdown notifications-menu" id="envelope_notifications">
                            <!-- /.dropdown-messages -->
                        </li>

                        <li class="dropdown notifications-menu" id="support">
                            <a generator="adianti" href="{{$urlbase}}/admin/system/support">
                                <i class="fa fa-life-ring fa-fw"></i>
                            </a>
                        </li>

                        @include('theme3/user_menu')
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{$urlbase}}/app/images/photos/admin.jpg" onerror="this.onerror=null;this.src='{{$urlbase}}/app/templates/theme3/img/avatar5.png';" style="border-radius:50%" alt="User">
                    </div>
                    <div class="pull-left info" style="position:initial">
                        <br>
                        <p>{{$username}}</p>
                    </div>
                </div>
                <!-- search form -->
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                </ul>
                {!! $menu !!}
            </section>
            <!-- /.sidebar -->
        </aside>

        @include('theme3/page_content')

        @include('theme3/footer')

        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <!-- AdminLTE App -->
    <script src="{{$urlbase}}/app/templates/{{$template}}/js/app.min.js"></script>
    <script src="{{$urlbase}}/app/templates/{{$template}}/js/custom.js"></script>
    <script src="{{$urlbase}}/app/include/widget_filters.js"></script>
</body>
</html>