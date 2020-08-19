<div class="sec-banner bg0 p-t-30">
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        @foreach(\App\Models\Category::getData() as $item)
                        <div class="hero__categories__all">
                            <i class=""></i>
                            <span>{{ $item['alias'] }}</span>
                        </div>
                        <ul style="">
                            @if(isset($item['children']))
                                @foreach($item['children'] as $v)
                                    <li><a href="#">{{ $v['alias'] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__item set-bg">
                        <img src="{{ asset("frontend/images/Logo/Ảnh to.png") }}" alt="" class="img-banner">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
