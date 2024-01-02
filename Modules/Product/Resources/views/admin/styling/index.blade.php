@extends('admin::layout')
@component('admin::components.page.header')
    @slot('title', 'Styling')

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
        <div class="btn-group pull-right">

        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body index-table" id="stylings-table">
            <div class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead><tr>
                        <th>
                            <div class="checkbox">
                                <input type="checkbox" class="select-all" id="styling-index-select-all">
                                <label for="styling-index-select-all"></label>
                            </div>
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
                                        <input type="checkbox" class="select-row" value="{{$styling->id}}" id="ibVcf96sE79fRF2f">
                                        <label for="ibVcf96sE79fRF2f"></label>
                                    </div>
                                </td>
                                <td style="cursor: pointer;">{{$styling->id}}</td>
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
