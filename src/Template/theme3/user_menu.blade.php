{{--
* @author     Davi Menezes
* @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
* @see https://github.com/DaviMenezes
--}}

<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-user"></i>
        <span class="hidden-xs">{{$username}}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header" style="height:initial">
            @if(!empty($profile_image))
                <img src="{{$profile_image}}" width="50px">
            @else
                <i class="fa fa-user fa-3x" style="color:white"></i>
            @endif

            <p>
                {{$username}}<br>
                <a href="{{$urlbase}}/admin/system/profile/view" generator="adianti" style="color:white;font-size:12px">[Perfil]</a>
            </p>
        </li>
        <!-- Menu Body -->
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="{{$urlbase}}/admin/login/reload/permissions/&static=1" generator="adianti" class="btn btn-default btn-flat">Recarregar</a>
            </div>
            <div class="pull-right">
                <a href="{{$urlbase}}/admin/logout" class="btn btn-default btn-flat">Sair</a>
            </div>
        </li>
    </ul>
</li>