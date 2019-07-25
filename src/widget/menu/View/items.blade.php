<!-- /app/view/menu/items.blade.php -->

<li class="treeview">
    <a href="#" class="">
        <i style="padding-right:4px;" class="{{$icon}}"></i>
        <span>{{$label}}</span>
    </a>
    @isset($items)
        @foreach($items as $menu_item)
            <ul class="treeview-menu level-{{$nivel}}">
                @include('menu.item', $menu_item)
            </ul>
        @endforeach
    @endisset
</li>
