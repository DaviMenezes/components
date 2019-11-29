{{--label_class--}}
{{--@author     Davi Menezes--}}
{{--@copyright  Copyright (c) 2019. (davimenezes.dev@gmail.com)--}}
{{--@see https://github.com/DaviMenezes--}}

class="
@if ($useButton)
    btn btn-default
@else
    tcheckgroup_label
@endif

@if ($item->active)
    active
@endif
"
