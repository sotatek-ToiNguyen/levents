@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', 'Create Styling')

    <li><a href="{{ route('admin.products.styling.index') }}">Styling</a></li>
    <li class="active">Create Styling</li>
    @push('scripts')
        <!-- Thêm các đường dẫn tới các file JS cần sử dụng -->
        <script src="{{ asset('/modules/media/admin/js/media.js?v=3.0.0') }}"></script>
        <script src="{{ asset('/modules/product/admin/js/styling.js?v=3.0.0') }}"></script>
        <link rel="stylesheet" href="{{ asset('/modules/media/admin/css/media.css?v=3.0.0') }}">
        <link rel="stylesheet" href="{{ asset('/modules/product/admin/css/product.css?v=3.0.0') }}">
    @endpush
@endcomponent

@section('content')
    <form method="POST" action="{{ request()->routeIs('admin.products.styling.create') ? route('admin.products.styling.store') : route('admin.styling.update', $styling->id) }}" class="form-horizontal" id="styling-create-form" enctype="multipart/form-data" novalidate>
        {{ csrf_field() }}

        <div class="accordion-content clearfix">
            <div class="col-lg-3 col-md-4">
                <div class="accordion-box">
                    <div class="panel-group" id="PageTabs">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a>
                                        Page Information
                                    </a>
                                </h4>
                            </div>

                            <div id="page_information" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <ul class="accordion-tab nav nav-tabs">
                                        <li class="active ">
                                            <a href="#general" data-toggle="tab">General</a>
                                        </li><li class=" ">
                                            <a href="#seo" data-toggle="tab">SEO</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="accordion-box-content">
                    <div class="tab-content clearfix">
                        <div class="tab-pane fade in active" id="general">
                            <h3 class="tab-content-title">General</h3>
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label text-left">Name<span class="m-l-5 text-red">*</span></label>
                                <div class="col-md-10">
                                    <input required name="name" class="form-control " id="name" value="{{isset($styling) ? $styling->name : ''}}" labelcol="2" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="body" class="col-md-2 control-label text-left">Thumbnail</label>
                                <div class="col-md-10">
                                    <div class="media-picker-divider"></div>
                                    @include('media::admin.image_picker.single', [
                                    'title' => '',
                                    'inputName' => 'files[base_image]',
                                    'file' => $file,
                                    ])
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="body" class="col-md-2 control-label text-left">Library</label>
                                <div class="col-md-10">
                                    <div class="media-picker-divider"></div>
                                    @include('media::admin.image_picker.multiple2', [
                                        'title' => '',
                                        'inputName' => 'files[library_images][]',
                                        'files' => $files,
                                    ])
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="body" class="col-md-2 control-label text-left">Product</label>
                                <div class="col-md-10 chose-product">
                                    <div class="select-product">
                                        <ol>
                                            @if(isset($productsSelect))
                                                @foreach($productsSelect as $pro)
                                                    <li id="check-{{$pro->id}}">
                                                        <lable>{{$pro->name}}</lable>
                                                        <i onclick="remoteProduct(event, {{$pro->id}})" class="fa fa-times"></i>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ol>
                                    </div>
                                    <div class="option-product">
                                        <input type="text" class="search" placeholder="name-search" name="name-search">
                                        <ul>
                                            @foreach($products as $product)
                                                <li>
                                                    <input {{isset($productIds) && in_array($product->id, $productIds) ? "checked" : ''}} onclick="isCheckedById({{$product->id}}, '{{$product->name}}')" type="checkbox" value="{{$product->id}}">
                                                    {{$product->name}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="body" class="col-md-2 control-label text-left">Body<span class="m-l-5 text-red">*</span></label>
                                <div class="col-md-10">
                                    <textarea required name="description" class="form-control  wysiwyg" id="body" rows="10" cols="10" labelcol="2" aria-hidden="true">
                                        {{isset($styling) ? $styling->description : ''}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in " id="seo">
                            <h3 class="tab-content-title">SEO</h3>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="meta-title" class="col-md-3 control-label text-left">
                                            Meta Title
                                        </label>

                                        <div class="col-md-9">
                                            <input type="text" name="meta_title" class="form-control" id="meta-title" value="{{isset($styling) ? $styling->meta_title : ''}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta-description" class="col-md-3 control-label text-left">
                                            Meta Description
                                        </label>

                                        <div class="col-md-9">
                                            <textarea name="meta_description" class="form-control" id="meta-description" rows="10" cols="10">{{isset($styling) ? $styling->meta_description : ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn btn-primary" data-loading="">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($productsSelect))
            @foreach($productsSelect as $prod)
                <input type="hidden" name="productid[]" value="{{$prod['id']}}">
            @endforeach
        @endif
    </form>
@endsection

@include('product::admin.products.partials.shortcuts')
