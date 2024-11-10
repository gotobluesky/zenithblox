@php
    $author_id = isset($value) && isset($value['author_id']) ? $value['author_id'] : null;
    $users = \Core\Models\User::where('status', config('settings.general_status.active'))->select('id','name')->get();
@endphp
<form action="#" class="widget_input_field_form px-3 py-3 bg-white"
    onsubmit="event.preventDefault(); widgetInputFormSubmit(this);">

    <div class="form-group">
        <label for="author_id">{{ translate('Select a User for Authur Widget') }}</label>
        <select class="form-control mt-1" name="author_id" id="author_id">
            @foreach ( $users as $user)
                <option value="{{ $user->id }}" @selected($author_id && $author_id == $user->id)>{{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="px-3 row justify-content-between">
        <div>
            <a href="javascript:;void(0)" class="text-danger"
                onclick="removeFromSidebar(this)">{{ translate('Delete') }}</a>
            <span class="mx-1">|</span>
            <a href="javascript:;void(0)" class="text-info"
                onclick="closeSidebarDropMenu(this)">{{ translate('Done') }}</a>
        </div>
        <button type="submit" class="btn btn-primary sm">{{ translate('Save') }}</button>
    </div>
</form>
