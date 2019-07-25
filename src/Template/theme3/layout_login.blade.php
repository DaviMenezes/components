<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('pagetitle')</title>

        @include('theme3/libraries')

        @section('head') @show

        <link rel="stylesheet" href="{{$urlbase}}/app/templates/{{$template}}/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{$urlbase}}/app/templates/{{$template}}/css/skins/_all-skins.min.css">
        
        <style>
        .panel-heading
        {
            height: 57px !important;
            background: #3c8dbc !important;
            color: white !important;
            display:block;
            margin:auto;
            text-align:center;
            float:inherit !important;
        }
        
        .panel-heading .panel-title
        {
            text-align:center;
            float:inherit !important;
            font-size: 20px;
        }
        .fb-inline-field-container
        {
            padding-right: 0 !important;
        }
        </style>
    </head>
    <body>
        <nav class="main-header navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; text-align:center">
            <div class="navbar-header" style="display: inline-block;float:none">
                <a class="navbar-brand" style="color:black" href="https://github.com/DaviMenezes/Dvi-for-Adianti">{{$appname}}</a>
            </div>
            <!-- /.navbar-header -->
        </nav>
        
        <div id="wrapper" style="width:90%;margin:auto;margin-top:10px">
            <div id="adianti_div_content">@section('adianti_div_content') @show</div>
            <div id="adianti_online_content"></div>
            <div id="adianti_online_content2"></div>
            
        </div>
        <div style="text-align:center">
            <div class="btn-group" role="group" aria-label="...">
                <a href="{{$urlbase}}/login" type="button" class="btn btn-default">Login</a>
                <a href="{{$urlbase}}/registry" type="button" class="btn btn-default">_t{Create account}</a>
                <a href="{{$urlbase}}/password/request" type="button" class="btn btn-default">_t{Reset password}</a>
            </div>
        </div>
        
        <a class="little-float-button bg-yellow" title="PHP Modules" href="{{$urlbase}}/admin/system/modules/check" style="pointer-events: auto;">
            <i class="fa fa-cog internal-float-button"></i>
        </a>
        
        <!-- /#wrapper -->
    </body>
</html>
