@extends('admin::layout')
@component('admin::components.page.header')
    @slot('title', 'Styling')
    @push('scripts')
        <!-- Thêm các đường dẫn tới các file JS cần sử dụng -->
        <script src="{{ asset('/modules/product/admin/js/styling.js?v=3.0.8') }}"></script>
    @endpush
    <li class="active">Styling</li>
@endcomponent

@section('content')
    <div class="row">
        <div class="btn-group pull-right">
            <a href="{{route('admin.products.styling.create')}}" class="btn btn-primary btn-actions btn-create">
                Create Styling
            </a>
        </div>
    </div>
    <section class="content">

    <div class="row">
        <div class="btn-group pull-left">
            <div class="dataTables_length" id="DataTables_Table_0_length">
                <button type="button" class="btn btn-default btn-delete delete-styling">
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
                        @foreach($stylings as $styling)
                            <tr role="row" class="odd clickable-row">
                                <td>
                                    <div class="checkbox">
                                        <input type="checkbox" class="select-row" value="{{$styling->id}}" id="ib_{{$styling->id}}">
                                        <label for="ib_{{$styling->id}}"></label>
                                    </div>
                                </td>
                                <td style="cursor: pointer;">
                                    <a href="{{route('admin.styling.edit', $styling->id)}}">
                                    {{$styling->id}}
                                    </a>
                                </td>
                                <td style="cursor: pointer;"><div class="thumbnail-holder">
                                        <img width="70px" src="{{$styling->files->path}}" alt="thumbnail">
                                    </div>
                                </td>
                                <td style="cursor: pointer;">
                                    {{$styling->name}}
                                </td>
                                <td class="sorting_1" style="cursor: pointer;">
                                    <span data-toggle="tooltip" title="Dec 28, 2023">
                                        {{$styling->created_at}}
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
