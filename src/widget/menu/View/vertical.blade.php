<!-- /app/view/menu/vertical.blade.php -->

<ul class="sidebar-menu" id="side-menu">
    @isset($items)
        @foreach($items as $item1)
            @isset($item1['items'])
                @include('menu.items', $item1)
            @else
                @include('menu.item', $item1)
            @endisset
        @endforeach
    @endisset
</ul>