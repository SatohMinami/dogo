@extends('frontend.layouts.app')

@section('content')
    <section class="bg0 p-t-23 p-b-20">
        <div class="container">
            @foreach ($data as $items)
                <div class="info-product">
                    <div class="p-b-10 d-ltext">
                        <h3 class="ltext-103 cl5 ">
                            {{ $items['name'] }}
                        </h3>
                        <p class="ptext mb-0">
                            <a href="#">Xem tất cả >>></a>
                        </p>
                    </div>
                    <div class="inf-text">
                        <div class="row">
                            @foreach($items['array'] as $item )
                                <div class="col-lg-3">
                                    <div class="card" data-id="{{ $item['id'] }}" data-name="{{ $item['name'] }}"  data-img="{{ $item['image'] }}" data-content="{{ $item['content'] }}" id="show-product-{{ $item['id'] }}">
                                        <img src="{{ $item['image'] }}" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <h6 class="h-text">MÃ HÀNG: 001</h6>
                                            <p class="p-text">
                                                {{ $item['name'] }}
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('[id^="show-product-"]').click(function (){
                $('#modal-product #content-product').html($(this).data('content'));
                $('#modal-product #img-product').attr("src", $(this).data('img'));
                $('#modal-product #name-product').text($(this).data('name'))
                $('#modal-product').modal('show');
            })
        });
    </script>
@endpush


