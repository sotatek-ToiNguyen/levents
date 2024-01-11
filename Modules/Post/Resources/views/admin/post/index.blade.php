@extends('admin::layout')
@component('admin::components.page.header')
    @slot('title', 'Collection')
    @push('scripts')
        <!-- Thêm các đường dẫn tới các file JS cần sử dụng -->
        <script src="{{ asset('/modules/product/admin/js/styling.js?v=3.0.8') }}"></script>
    @endpush
    <li class="active">Collection</li>
@endcomponent

@section('content')
    <div class="row">
        <div class="btn-group pull-right">
            <a href="{{route('admin.post.create')}}" class="btn btn-primary btn-actions btn-create">
                Create Collection
            </a>
        </div>
    </div>
    <section class="content">

        <div class="row">
            <div class="btn-group pull-left">
                <div class="dataTables_length" id="DataTables_Table_0_length">
                    <button type="button" class="btn btn-default btn-delete delete-colection">
                        Delete
                    </button>
                </div>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body index-table" id="stylings-table">
                <div class="table-responsive">
                    <table class="table table-striped table-hover ">
                        <thead><tr>
                            <th>

                            </th>

                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th data-sort="">Created</th>
                        </tr></thead>

                        <tbody>
                        @foreach($posts as $post)
                            <tr role="row" class="odd clickable-row">
                                <td>
                                    <div class="checkbox">
                                        <input type="checkbox" class="select-row" value="{{$post->id}}" id="ib_{{$post->id}}">
                                        <label for="ib_{{$post->id}}"></label>
                                    </div>
                                </td>
                                <td style="cursor: pointer;">
                                    <a href="{{route('admin.post.edit', $post->id)}}">
                                        {{$post->id}}
                                    </a>
                                </td>
                                <td style="cursor: pointer;"><div class="thumbnail-holder">
                                        <img width="70px" src="{{$post->files->path}}" alt="thumbnail">
                                    </div>
                                </td>
                                <td style="cursor: pointer;">
                                    {{$post->name}}
                                </td>
                                <td class="sorting_1" style="cursor: pointer;">
                                    <span data-toggle="tooltip" title="Dec 28, 2023">
                                        {{$post->created_at}}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
