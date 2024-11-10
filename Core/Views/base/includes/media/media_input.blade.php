@php
    $placeholder_info = getPlaceHolderImage();
    $placeholder_image = '';
    $placeholder_image_alt = '';
    $image_src = '';
    
    if ($placeholder_info != null) {
        $placeholder_image = $placeholder_info->placeholder_image;
        $placeholder_image_alt = $placeholder_info->placeholder_image_alt;
    }
    if (!empty($data)) {
        $file_details = getFileDetails($data);
        if ($file_details != null) {
            $image_src = project_asset($file_details->path);
        } else {
            $image_src = project_asset($placeholder_info->placeholder_image);
        }
    } else {
        $image_src = project_asset($placeholder_info->placeholder_image);
    }
@endphp

<input type="hidden" name="{{ $input }}" id="{{ $input }}_id" value="{{ $data }}"
    @if (isset($disable) && $disable === true) disabled @endif>
<div class="image-box">
    <div class="d-flex flex-wrap gap-10 mb-3">
        @if (isset($data))
            <div class="preview-image-wrapper">
                <img src="{{ $image_src }}" alt="{{ $placeholder_image_alt }}" width="150" class="preview_image"
                    id="{{ $input }}_preview" />
                <button type="button" title="Remove image" class="remove-btn style--three black 555"
                    id="{{ $input }}_remove"
                    onclick="removeSelection('#{{ $input }}_preview,#{{ $input }}_id,#{{ $input }}_remove')"><i
                        class="icofont-close"></i></button>
            </div>
        @else
            <div class="preview-image-wrapper">
                <img src="{{ $image_src }}" alt="{{ $placeholder_image_alt }}" width="150" class="preview_image"
                    id="{{ $input }}_preview" />
                <button type="button" title="Remove image" class="remove-btn style--three black d-none"
                    id="{{ $input }}_remove"
                    onclick="removeSelection('#{{ $input }}_preview,#{{ $input }}_id,#{{ $input }}_remove')"><i
                        class="icofont-close"></i></button>
            </div>
        @endif

    </div>
    <div class="image-box-actions">
        <button type="button" class="btn-link" data-toggle="modal" data-target="#mediaUploadModal"
            id="{{ $input }}_choose"
            onclick="setDataInsertableIds('#{{ $input }}_preview,#{{ $input }}_id,#{{ $input }}_remove')">
            {{ translate('Choose File') }}
        </button>
    </div>
</div>
