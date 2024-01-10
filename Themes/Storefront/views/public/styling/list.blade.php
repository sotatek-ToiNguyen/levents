@extends('public.layout')

@section('title', 'Outfit – Weins')

@push('meta')
    <meta name="title" content="Outfit – Weins">
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
    <li class="active">Outfit</li>
@endsection

@section('content')
    <section class="custom-page-wrap clearfix colection outfit">
        <div class="container">
            <div class="row">
                @foreach($page as $pag)
                    <div class="post-card">
                        <div class="product-card-top">
                            <a href="{{route('styling.index', $pag->slug)}}" class="product-image">
                                <img src="{{$pag->files->path ?? '/themes/storefront/public/images/image-placeholder.png'}}" alt="product image">
                            </a>
                        </div>

                        <div class="product-card-middle">
                            <a href="{{route('styling.index', $pag->slug)}}" class="post-name">
                                <h6>{{$pag->name}}</h6>
                            </a>
                            <button>
                                <a href="{{route('styling.index', $pag->slug)}}" class="post-name">
                                    Xem bộ phối
                                </a>
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
