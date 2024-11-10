@php
    $media_file_type = config('settings.media_file_type');
    $media_type = array_flip(config('settings.media_type'));
    $year_months = getMonthsForUploadedFiles();
@endphp

<!-- Media Library -->
<ul class="attachments list-unstyled" id="attachment-list">
    @php
        // $data = json_encode($all_media);
        $data = json_encode($media_ids);
    @endphp
    @foreach ($all_media as $media)
        <li onclick="nextMediaSlide(event,'{{ $data }}','{{ $media->id }}')"
            id="list_item_{{ $media->id }}">
            <div class="attachment-preview">
                <div class="thumbnail">
                    @if ($media->file_type == 'pdf')
                        <img class="lozad" src="{{ project_asset('/backend/assets/img/pdf-placeholder.png') }}"
                            alt="{{ $media->alt }}" />
                    @elseif($media->file_type == 'zip')
                        <img class="lozad" src="{{ project_asset('/backend/assets/img/zip-placeholder.png') }}"
                            alt="{{ $media->alt }}" />
                    @elseif($media->file_type == 'video')
                        <img class="lozad" src="{{ project_asset('/backend/assets/img/mp4-placeholder.png') }}"
                            alt="{{ $media->alt }}" />
                    @else
                        <img class="lozad" src="{{ project_asset($media->path) }}" alt="{{ $media->alt }}" />
                    @endif
                </div>
            </div>

            <button type="button" class="check" id="check_{{ $media->id }}">
                <i class="icofont-check icon-check"></i>
                <i class="icofont-minus icon-minus"></i>
            </button>
        </li>
    @endforeach
</ul>
<!-- /Media Library -->
