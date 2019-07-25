<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title id="page_title">{{$pagetitle}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('theme3/libraries')

    {{$head}}

    <link rel="stylesheet" href="{{$urlbase}}/app/templates/{{$template}}/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{$urlbase}}/app/templates/{{$template}}/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="{{$urlbase}}/app/include/application.css">
    <link rel="stylesheet" href="{{$urlbase}}/app/include/last_application.css">
</head>