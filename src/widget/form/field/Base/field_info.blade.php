{{--@author     Davi Menezes--}}
{{--@copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)--}}
{{--@see https://github.com/DaviMenezes--}}

@if($field_info)
    <a href="{{$field_info['route']}}" title="{{$field_info['title']}}" generator="adianti">
        <i class="fa fa-exclamation-triangle red" aria-hidden="true"></i> {!!$field_info['label']!!}
    </a>
@endif