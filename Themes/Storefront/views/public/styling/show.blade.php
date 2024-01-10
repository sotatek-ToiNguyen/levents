@extends('public.layout')

@section('title', $page->name)

@push('meta')
    <meta name="title" content="{{ $page->meta_title ?: $page->name }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <meta name="twitter:card" content="summary">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $page->meta_title ?: $page->name }}">
    <meta property="og:description" content="{{ $page->meta_description }}">
    <meta property="og:image" content="{{ $file->path }}">
    <meta property="og:locale" content="{{ locale() }}">

    @foreach (supported_locale_keys() as $code)
        <meta property="og:locale:alternate" content="{{ $code }}">
    @endforeach
@endpush
@section('breadcrumb')
    <li class="" ><a href="/blogs/outfit">Outfit</a></li>
    <li class="active">{{$page->name}}</li>
@endsection

@section('content')
    <section class="custom-page-wrap clearfix">
        <div class="container">
            <div class="custom-page-content clearfix">
                {!! $page-> description !!}
            </div>
            <div class="row">
                @foreach($files as $fil)
                    <div class="image-outfix">
                        <img src="{{$fil->path}}" alt="">
                    </div>
                @endforeach
            </div>
            <div class="row slider-styling">
                @foreach($productsSelect as $prod)
                    <div  class="vertical-product-card">
                        <a href="{{route('products.show', $prod->slug)}}" class="product-image">
                            <img src="{{$prod->base_image->path ?? '/themes/storefront/public/images/image-placeholder.png'}}" class="image-placeholder" alt="product-image">
                        </a>

                        <div class="product-info">
                            <a href="{{route('products.show', $prod->slug)}}" class="product-name">
                                <h6>{{ $prod->name }}</h6>
                            </a>

                            <div class="product-price">{{$prod->formatted_price}}</div>
                            <div class="product-rating">
                                <div class="back-stars">
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <div class="front-stars" style="width: {{$prod->rating_percent ? $prod->rating_percent  . '%' : '0%'}}">
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                    </div>
                                </div>
                                <span class="rating-count" v-if="hasReviewCount">({{ (count($prod->reviews)) }})</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
