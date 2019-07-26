{{--{!!$label!!}--}}
<select
    @foreach($properties as $item => $value)
        {{$item}}="{{$value}}"
    @endforeach
>
    @foreach($option_items as $key => $option_value)
        <option value = "{{$key}}"
            @foreach($options_properties as $prop_key => $value)
                {{$prop_key}}="{{$value}}"
            @endforeach
        >{{$option_value}}</option>
    @endforeach
</select>
{!! $field_info !!}