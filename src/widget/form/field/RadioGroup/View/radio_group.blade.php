/**
* radio
* @author     Davi Menezes
* @copyright  Copyright (c) 2018. (davimenezes.dev@gmail.com)
* @see https://github.com/DaviMenezes
*/
@include('Widget.Form.Field.Base.label')

@if ($useButton)
    <div data-toggle="buttons">
        <div class="btn-group" style="clear:both;float:left; @if ($size_use_percentage) width:100% @endif ">
@endif

@foreach($items as $key => $item)
    <label class="
        @if ($useButton)
            btn btn-default
        @else
            tcheckgroup_label
        @endif

        @if ($item['active'])
            active
        @endif
        "
    >
        <input name="{{$properties['name']}}" value="{{$item['value']}}"
               widget="tradiobutton" type="radio" id="{{$properties['id']}}"
            @if ($event_change_action)
                @include('Widget.Form.Script.post_lookup', ['change_action' => $event_change_action])
            @endif
        > {{$item['label']}}

    </label>
@endforeach

@if ($useButton)
        </div>
    </div>
@endif

@include('Widget.Form.Field.base.field_info')


