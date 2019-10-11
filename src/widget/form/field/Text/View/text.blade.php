{{--text component--}}
{{--@author     Davi Menezes--}}
{{--@copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)--}}
{{--@see https://github.com/DaviMenezes--}}
@include('Widget.Form.Field.Base.label')
<textarea @include('Widget.Form.Field.Base.properties') >{{$value}}</textarea>
@include('Widget.Form.Field.Base.field_info')
