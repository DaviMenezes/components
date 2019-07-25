{{--{!!$label!!}--}}
<select
    @foreach($properties as $item => $value)
        {{$item}}="{{$value}}"
    @endforeach
>
    @foreach($option_items as $option_value)
        <option
            @foreach($options_properties as $key => $value)
                {{$key}}="{{$value}}"
            @endforeach
        >{{$option_value}}</option>
    @endforeach
</select>
{!! $field_info !!}