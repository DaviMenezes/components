{{--checkgroup--}}
{{--@author     Davi Menezes--}}
{{--@copyright  Copyright (c) 2019. (davimenezes.dev@gmail.com)--}}
{{--@see https://github.com/DaviMenezes--}}

@include('Widget.Form.Field.Base.label')
@if ($useButton)
    <div data-toggle="buttons">
        <div class="btn-group" style="clear:both;float:left; @if ($size_use_percentage) width:100% @endif ">
@endif

@foreach($items as $key => $item)
    <label title="{{$item->label}}" @include('Widget.Form.Field.CheckGroup.View.label_class')>
        <input id="{{$properties['id']}}" name="{{$properties['name']}}[]" value="{{$item->key}}"
               widget="tcheckbutton" type="checkbox" checkgroup="check"
           @if ($item->event_change_action)
            @include('Widget.Form.Script.post_lookup', ['change_action' => $item->event_change_action])
           @endif
        > {{$item->label}}
    </label>
@endforeach

@if ($useButton)
        </div>
    </div>
@endif

@include('Widget.Form.Field.base.field_info')