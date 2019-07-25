{!!$label!!}
<input type='hidden' widget="thidden"
@foreach($properties as $item => $value)
    {{$item}}="{{$value}}"
@endforeach
/>
{!! $field_info !!}