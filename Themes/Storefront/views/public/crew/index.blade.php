@extends('public.layout')

@section('title')
    @if (request()->has('query'))
        {{ trans('storefront::products.search_results_for') }}: "{{ request('query') }}"
    @else
        {{ trans('storefront::products.shop') }}
    @endif
@endsection

@push('globals')
    <script>
        FleetCart.langs['storefront::products.showing_results'] = '{{ trans("storefront::products.showing_results") }}';
        FleetCart.langs['storefront::products.show_more'] = '{{ trans("storefront::products.show_more") }}';
        FleetCart.langs['storefront::products.show_less'] = '{{ trans("storefront::products.show_less") }}';
    </script>
@endpush
@section('breadcrumb')
    <li class="active">{{"Crew"}}</li>
@endsection
@section('content')
    <section class="product-search-wrap">
        <div class="container crew">
            @foreach($products as $product)
                <div class="crew-item" data-slug="{{$product->slug}}">
                    <img src="{{'/storage/'  . $product->path}}">
                </div>
            @endforeach
        </div>
    </section>
    <div id="myModal" class="modal fade">
        <span class="close">&times;</span>
        <div class="modal-content">
            <div class="thumbnail-name">
                <img width="100px" src="https://levents.asia/cdn/shop/files/Thi_t_k_ch_a_co_ten.jpg?v=1699357749&width=1000" alt="">
            </div>
            <div class="product-card-modal product-card">
                <div class="gallery-modal__header flex items-center justify-between">
                    <div class="text-1">
                        @levents.official
                    </div>
                    <a class="button button--small button--auto" href="https://www.instagram.com/levents.official/">
                        Truy cập
                    </a>
                </div>
                <div class="creatdei-cat product-name">
                    <img width="100px" src="">
                    <h6>title</h6>
                    <span class="product-price"></span>
                    <div>
                        <a class="full-unstyled-link button button--lg  w-100 no-underline">
                            Xem sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
