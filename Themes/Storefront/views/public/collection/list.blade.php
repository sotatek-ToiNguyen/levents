@extends('public.layout')

@section('title', 'Bộ sưu tập – Weins')

@push('meta')
    <meta name="title" content="Bộ sưu tập – Weins">
    <meta name="description" content="Weins® - Popular Streetwear Brand | Lì - Ven | - Local Brand Việt Nam hàng đầu dành cho các tín đồ thời trang Streetwear sành điệu.">
    <meta name="twitter:card" content="summary">
    <meta property="og:url" content="{{ url()->current() }}">
{{--    <meta property="og:title" content="{{ $page->meta_title ?: $page->name }}">--}}
{{--    <meta property="og:description" content="{{ $page->meta_description }}">--}}
{{--    <meta property="og:image" content="{{ $file->path }}">--}}
    <meta property="og:locale" content="{{ locale() }}">

    @foreach (supported_locale_keys() as $code)
        <meta property="og:locale:alternate" content="{{ $code }}">
    @endforeach
@endpush
@section('breadcrumb')
    <li class="active">Bộ sưu tập</li>
@endsection

@section('content')
    <section class="custom-page-wrap clearfix colection outfit colection-post">
        <div class="container">
            <div class="row">
                @foreach($collections as $collection)
                    <div class="post-card">
                        <div class="product-card-top">
                            <img src="storage/{{$collection->path ?? '/themes/storefront/public/images/image-placeholder.png'}}" alt="product image">
                        </div>

                        <div class="product-card-middle">
                                <h6>{{$collection->name}}</h6>
                            <button>
                                <a href="{{route('collection.show', $collection->slug)}}" class="post-name">
                                    Xem bộ sưu tập
                                </a>
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
