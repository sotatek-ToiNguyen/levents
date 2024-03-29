<div class="panel">
    <div class="panel-header">
        {{--        <h5>{{ $label }}</h5>--}}
    </div>

    <div class="panel-body">
        @hasAccess('admin.media.index')
        <div class="panel-image">
            @if (is_null($banner->image->path))
                <i class="file-icon fa fa-file-video-o"></i>
                <video class="hide">
            @else
                <video src="{{ $banner->image->path }}" alt="Banner">
            @endif

            <input type="hidden" name="translatable[{{ $name }}_file_id]" value="{{ $banner->image->id }}" class="banner-file-id">
        </div>
        @endHasAccess

        <div class="panel-content clearfix">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-6 clearfix">
                    <div class="form-group">
                        <label for="{{ $name }}-title">Title</label>
                        <input type="text" name="{{ $name }}_title" value="{{ $banner->title }}" class="form-control" id="{{ $name }}-title">
                    </div>

                    <div class="form-group">
                        <label for="{{ $name }}-video">Link Video</label>
                        <input type="text" name="{{ $name }}_video" value="{{ $banner->video }}" class="form-control" id="{{ $name }}-video">
                    </div>

                    <div class="form-group">
                        <label for="{{ $name }}-description">Description</label>
                        <textarea type="text" name="{{ $name }}_description"  class="form-control" id="{{ $name }}-description">{{$banner->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="{{ $name }}-call-to-action-url">{{ trans("storefront::attributes.call_to_action_url") }}</label>
                        <input type="text" name="{{ $name }}_call_to_action_url" value="{{ $banner->call_to_action_url }}" class="form-control" id="{{ $name }}-call-to-action-url">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-6">
                    <div class="checkbox">
                        <input type="hidden" name="{{ $name }}_open_in_new_window" value="0">
                        <input type="checkbox" name="{{ $name }}_open_in_new_window" value="1" id="{{ $name }}-open-in-new-window" {{ $banner->open_in_new_window ? 'checked' : '' }}>
                        <label for="{{ $name }}-open-in-new-window">
                            {{ trans("storefront::attributes.open_in_new_window") }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
