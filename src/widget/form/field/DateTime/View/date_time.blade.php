{{--@author     Davi Menezes--}}
{{--@copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)--}}
{{--@see https://github.com/DaviMenezes--}}

@include('Widget.Form.Field.Base.label')

@if($mask)
    <script language="JavaScript">tentry_new_mask('{{$id}}', {{$mask}}); </script>
@endif

<input {!! $properties !!} widget="tdatetime">

@include('form.field.base.field_info')

@if($editable)
    <script language="JavaScript">tdatetime_start( '#{{$id}}', '{{$mask}}', '{{$language}}', '{{$outer_size}}', '{{$options}}');</script>
@endif