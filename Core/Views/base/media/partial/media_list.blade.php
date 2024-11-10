@php
$media_file_type = config('settings.media_file_type');
$media_type = array_flip(config('settings.media_type'));
$year_months = getMonthsForUploadedFiles();
@endphp
<!-- Media List -->
<ul class="nav nav-tabs pl-20" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="upload-files-tab" data-toggle="tab" href="#upload-files" role="tab"
            aria-controls="upload-files" aria-selected="true">{{ translate('Upload Files') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" id="media-library-tab" data-toggle="tab" href="#media-library" role="tab"
            aria-controls="media-library" aria-selected="false">{{ translate('Media Library') }}</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="upload-files" role="tabpanel" aria-labelledby="upload-files-tab">
        <!-- Upload -->
        <div id="file-drop-area-wrappper" class="p-20 bg-white">
            <!-- Dropzone Start -->
            <form method="post" action="#" id="uploaded"
                enctype="multipart/form-data" class="dropzone style--two" id="dropzone" name="media_file">
                @csrf
                <div class="d-flex justify-content-center flex-column align-items-center align-self-center"
                    data-dz-message>
                    <div class="dz-message bold c2 font-20 mb-3">
                        {{ translate('Click or Drop files here to upload') }}
                        <i class="icofont-cloud-upload"></i>
                    </div>
                </div>
            </form>

            <!-- Dropzone End -->
        </div>
        <!-- End Upload -->
    </div>
    <div class="tab-pane fade show active" id="media-library" role="tabpanel" aria-labelledby="media-library-tab">
        <div class="attachment-wrap border-bottom2">
            <div class="attachment">
                <div class="media-toolbar">
                    <div class="media-toolbar-secondary">
                        <h6 class="media-attachments-filter-heading mb-2">
                            {{ translate('Filter media') }}
                        </h6>
                        <div class="media-filter-wrap">
                            <select id="media-file-filters" class="attachment-filters theme-input-style max-content"
                                onchange="filtermedia()">
                                <option value="all">{{ translate('All File Type') }}</option>
                                @foreach ($media_file_type as $key => $value)
                                <option value="{{ $key }}" {{ isset($selected_file_type) && $selected_file_type==$key
                                    ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                            <select id="media-date-filters" class="attachment-filters theme-input-style"
                                onchange="filtermedia()">
                                <option value="all">{{ translate('All dates') }}</option>
                                @foreach ($year_months as $key => $value)
                                <option value="{{ $key }}" {{ isset($search_date) && $search_date==$key ? 'selected'
                                    : '' }}>
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="media-toolbar-primary search-form">
                        <label for="media-search-input" class="media-search-input-label">Search</label>
                        <input type="search" id="media-search-input" class="search theme-input-style"
                            value="{{ isset($search_input) ? $search_input : '' }}" onchange="filtermedia()" />
                    </div>
                </div>
                <div class="all-attachments">
                    <div id="filtered_media">

                    </div>

                    <div class="d-none load-more-wrapper mt-3 text-center">
                        <p class="load-more-count" id="show_count"></p>
                        <div class="d-flex justify-content-center gap-10" id="load_more">
                            <button type="button" class="btn btn-fill sm load-more" onclick="updateMediaPerPage()">
                                {{translate('Load more')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @if (Request::routeIs(['core.media.page']))
            <div class="d-flex justify-content-end pt-3 bg-white border-top2 px-3">
                <button type="button" class="btn sm btn-danger mb-3" id="delete-media" onclick="deleteMediaFile()"
                    disabled>
                    {{ translate('Delete Permanently') }}
                </button>
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-end pt-3">
            @if (!Request::routeIs(['core.media.page']))
            <button type="button" class="btn sm btn-info insert_image">
                {{ translate('Insert') }}
            </button>
            @endif
        </div>
    </div>
</div>
<!-- Media List -->