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
            <div class="clearfix">
                {!! $page-> description !!}
            </div>
            <div class="row justify-content-center">
                <h2 class="align-center">Danh mục sản phẩm</h2>
            </div>
            <div class="tab-content landscape-left-tab-collection">
                @foreach($productsSelect as $product)
                <div class="product-card-collection">
                    <div class="product-card-top">
                        @if($product->files)
                        <div class="colection-image-data">
                            @foreach($product->files as $file)
                                <div>
                                    <img src="{{$file->path}}" class="image-placeholder" alt="product image">
                                </div>
                            @endforeach
                        </div>
                        @else
                        <div class="product-image">
                            <img src="{{$product->base_image->path}}" class="hasBaseImage" alt="product image">
                        </div>
                        @endif
                    </div>

                    <div class="product-info">

                        <a href="products/{{$product->slug}}" class="product-name">
                            <h6>{{ $product->name }}</h6>
                        </a>

                        <div class="product-price product-price-clone">
                            {!! $product->formatted_price !!}
                        </div>
                    </div>

                </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
