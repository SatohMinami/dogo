<div class="sec-banner navbar-custom bg0 p-t-80">
    <div class="container navbar-child">
        <ul class="menu-child">
            @foreach(\App\Models\Category::getParentCategory() as $item)
                <li><a href="{{ route('front.category', $item['id']) }}" class="font-weight-bold active">{{ $item['alias'] }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
