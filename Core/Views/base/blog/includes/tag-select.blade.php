<h4 class="font-16">{{ translate('Tags') }}</h4>
<div class="form-group row mt-4">
    <div class="col-sm-12">
        <select id="tag-select" class="CategorySelect form-control" name="tags[]" multiple>
            @foreach ($tags as $tag)
                @if (isset($blog_tag))
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $blog_tag) ? 'selected' : '' }}>
                        {{ $tag->translation('name', getLocale()) }}</option>
                @else
                    <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                        {{ $tag->translation('name', getLocale()) }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
@can('Manage Tag')
    <div class="row px-3 d-none tag-create-form">
        <h4 class="font-14 my-1 col-12">{{ translate('New Tag') }}</h4>
        <input type="text" name="tag_name" class="form-control col-8" id="tag_input" placeholder="Create Tag">
        <button type="button" class="btn custom-btn mb-2 offset-1 col-2 mx-2 my-1"
            id="add_tag_button">{{ translate('Add') }}</button>
    </div>
    <button type="button" class="btn sm btn-primary my-2 w-50"
        id="add_new_tag_button">{{ translate('Add New Tag') }}</button>
@endcan
