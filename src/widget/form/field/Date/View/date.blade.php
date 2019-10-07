{{--@author     Davi Menezes--}}
{{--@copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)--}}
{{--@see https://github.com/DaviMenezes--}}

@if($mask)
    <script language="JavaScript">tentry_new_mask('{{$id}}', {{$mask}}); </script>
@endif

@include('Widget.Form.Field.Base.label')

<input {!! $properties !!}>

@include('form.fields.base.field_info')

@if($editable)
    <script language="JavaScript">tdate_start( '#{{$id}}', '{{$mask}}', '{{$language}}', '{{$outer_size}}', '{{$options}}');</script>
@endif