{{--
* @author     Davi Menezes
* @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
* @see https://github.com/DaviMenezes
--}}

<!-- Third part libraries required by Adianti Framework -->
<script src="{{$urlbase}}/lib/jquery/jquery.min.js?afver=505" type="text/javascript"></script>
<script src="{{$urlbase}}/lib/bootstrap/js/bootstrap.min.js?afver=505"></script>
<script src="{{$urlbase}}/lib/bootstrap/js/bootstrap-plugins.min.js?afver=505" type="text/javascript"></script>
<script src="{{$urlbase}}/lib/bootstrap/js/locales/bootstrap-datepicker.pt.js?afver=505" type="text/javascript"></script>
<script src="{{$urlbase}}/lib/bootstrap/js/lang/summernote-pt-BR.min.js?afver=505" type="text/javascript"></script>
<script src="{{$urlbase}}/lib/jquery/jquery-ui.min.js?afver=505" type="text/javascript"></script>
<script src="{{$urlbase}}/lib/jquery/jquery-plugins.min.js?afver=505" type="text/javascript"></script>
<script src="{{$urlbase}}/lib/jquery/select2_locale_pt.js?afver=505" type="text/javascript"></script>
<script src="{{$urlbase}}/lib/jquery/fullcalendar-pt.js?afver=505" type="text/javascript"></script>

<!-- Adianti Framework core and components -->
<script src="{{$urlbase}}/lib/adianti/include/adianti.js?afver=505" type="text/javascript"></script>
<script src="{{$urlbase}}/lib/adianti/include/components.min.js?afver=505" type="text/javascript"></script>

<!-- Application custom Javascript (Optional) -->
<script src="{{$urlbase}}/app/include/application.js?appver=505" type="text/javascript"></script>
<script src="{{$urlbase}}/app/include/fuse/fuse.min.js?appver=505" type="text/javascript"></script>

<script>
    function update_messages_menu() {
        $.get('{{$urlbase}}/message/list/theme/theme3', function(data) {
            $('#envelope_messages').html(data);
        });
    }

    function update_notifications_menu() {
        //Todo alterar as chamadas javascript como a abaixo, por rotas (Deve ter o msm nos arquivos javascript)
        $.get('{{$urlbase}}/admin/system/notification/list/theme/theme3', function(data) {
            $('#envelope_notifications').html(data);
        });
    }

    function createSearchBox() {
        $.get('{{$urlbase}}/admin/searchbox', function(data)
        {
            $('.navbar-custom-menu').append(data).show();
            var search_box = $('.navbar-nav').nextAll('div');
            search_box.css('padding-top', '10px');
            search_box.css('padding-left', '25px');
            search_box.css('display', 'table');
            search_box.css('float', 'left');
            search_box.attr('id', 'search-box');
        });
    }
    $(function() {
        // createSearchBox();

        // update_messages_menu();
        // update_notifications_menu();

        // setInterval( update_messages_menu, 5000);
        // setInterval( update_notifications_menu, 5000);
    });
</script>
