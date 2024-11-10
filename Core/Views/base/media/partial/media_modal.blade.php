<!-- modal -->
<div class="modal fade" id="mediaUploadModal" tabindex="-1" role="dialog" aria-labelledby="mediaUploadModalLable"
    aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{translate('Media Library')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    @include('core::base.media.partial.media_list')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /modal -->

<!-- Attchment Details-->
<div class="media-sidebar">
    <div class="media-sidebar-close pb-4">
        <i class="icofont-close-circled"></i>
    </div>
    <h6 class="mb-3">{{translate('ATTACHMENT DETAILS')}}</h6>
    <div class="attachment-info">
        <div class="thumbnail thumbnail-image">
            <img id="selected_media" src="" alt="" />
        </div>

        <div class="details">
            <div class="filename" id="media_name"></div>
            <div class="media_file_uploading_date" id="media_file_uploading_date"></div>
            <div class="media_file_size" id="media_file_size"></div>
        </div>
    </div>
    <div class="attachment-meta-wrap">
        <form method="POST">
            @csrf
            <input type="hidden" name="id" id="media_id">
            <div class="settings-wrap pb-3 mb-3 border-bottom2">
                <span class="setting mb-10 has-description">
                    <label for="attachment-details-alt-text" class="name">{{translate('Alt
                        Text :')}}</label>
                    <span id="attachment-details-alt-text"></span>
                </span>
                <span class="setting mb-10">
                    <label for="attachment-details-title" class="name">{{translate('Title :')}}</label>
                    <span id="attachment-details-title"></span>
                </span>
                <span class="setting mb-10">
                    <label for="attachment-details-caption" class="name">{{translate('Caption :')}}</label>
                    <span id="attachment-details-caption"></span>
                </span>
                <span class="setting mb-10">
                    <label for="attachment-details-description" class="name">{{translate('Description :')}}</label>
                    <span id="attachment-details-description"></span>
                </span>
            </div>
            <div class="d-flex gap-10 justify-content-end flex-wrap mt-2">
                @can('Manage Media')
                <button type="button" class="btn sm btn-danger" onclick="deleteMediaFile()">
                    <i class="icofont-ui-delete"></i>
                </button>
                @endcan
                <button type="button" class="btn sm btn-info insert_image">
                    {{translate('Insert')}}
                </button>
            </div>
        </form>
    </div>
</div>
<!-- /Attchment Details-->