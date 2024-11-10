@php
$placeholder_info = getPlaceHolderImage();
$placeholder_image = '';
$placeholder_image_alt = '';
$image_src = '';

if ($placeholder_info != null) {
    $placeholder_image = $placeholder_info->placeholder_image;
    $placeholder_image_alt = $placeholder_info->placeholder_image_alt;
}

if ($data == null || $data == '') {
    $data = [];
} else {
    if (gettype($data) == 'string') {
        $data = explode(',', $data);
    }
}
@endphp
<input type="hidden" name="{{ $input }}" id="{{ $input }}_{{ $indicator }}"
    value="{{ implode(',', $data) }}">
<div class="image-box">
    <div class="d-flex flex-wrap gap-10 mb-3">
        <div id="multi_input_container_{{ $indicator }}" class="d-flex flex-wrap gap-10">
            @if (sizeof($data) == 0)
                <div class="preview-image-wrapper" id="div_preview">
                    <img src="{{ project_asset($placeholder_image) }}" alt="{{ $placeholder_image_alt }}" width="150"
                        class="preview_image" id="preview_image" />
                </div>
            @endif
            @if (sizeof($data) > 0)
                @for ($i = 0; $i < sizeof($data); $i++)
                    @if ($data[$i] != null)
                        <div class="preview-image-wrapper"
                            id="div_preview_{{ $input }}_{{ $indicator }}_{{ $data[$i] }}">
                            <img src="{{ project_asset(getFileDetails($data[$i])->path) }}"
                                alt="{{ $placeholder_image_alt }}" width="150" class="preview_image"
                                id="preview_{{ $input }}_{{ $indicator }}_{{ $data[$i] }}" />
                            <button type="button" title="Remove image" class="remove-btn style--three"
                                id="remove_{{ $input }}_{{ $indicator }}_{{ $data[$i] }}"
                                onclick="removeSelectionForMultiSelect('#preview_{{ $input }}_{{ $indicator }}_{{ $data[$i] }},#{{ $input }}_{{ $indicator }},#remove_{{ $input }}_{{ $indicator }}_{{ $data[$i] }},#div_preview_{{ $input }}_{{ $indicator }}_{{ $data[$i] }}',{{ $data[$i] }})"><i
                                    class="icofont-close"></i></button>
                        </div>
                    @endif
                @endfor
            @endif
        </div>
    </div>
    <div class="image-box-actions">
        <button type="button" class="btn-link" data-toggle="modal" data-target="#mediaUploadModal"
            id="{{ $input }}_choose"
            onclick="setDataInsertableIdsForMultiSelect('#{{ $input }},{{ $container_id }}',{{ $indicator }})">
            {{ translate('Choose Files') }}
        </button>
    </div>
</div>
