<h4 class="font-16">{{ translate('Categories') }}</h4>
<small>{{ translate('Only Active Categories') }}</small>
<div class="form-group row mt-4">
    <div class="col-sm-12">
        <select class="CategorySelect form-control" id="category-select" name="categories[]" multiple
            placeholder="{{ translate('Select a Category') }}">
            <option value="">
                {{ translate('Select a Category') }}
            </option>
            @foreach ($categories as $category)
                @if (isset($blog_category))
                    <option value="{{ $category->id }}" {{ in_array($category->id, $blog_category) ? 'selected' : '' }}>
                        {{ $category->translation('name', getLocale()) }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->translation('name', getLocale()) }}</option>
                @endif
                @if (count($category->active_childs))
                    @include('core::base.blog.includes.blog_child_category', [
                        'child_category' => $category->active_childs,
                        'label' => 1,
                        'parent' => null,
                        'active_childs' => true,
                    ])
                @endif
            @endforeach
        </select>
    </div>
</div>
{{-- Create a new Category --}}
@can('Manage Category')
    <div class="row px-3 d-none category-create-form">
        <h4 class="font-14 my-1">{{ translate('New Category') }}</h4>

        <input type="text" name="category" class="form-control col-12 mb-2" id="category_input"
            placeholder="Create Category">
        <select class="parentCategorySelect form-control col-12 mb-2" name="parent"
            placeholder="{{ translate('Select Parent') }}">
            <option value="">
                {{ translate('Select a Parent Category') }}
            </option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->translation('name', getLocale()) }}
                </option>
                @if (count($category->active_childs))
                    @include('core::base.blog.includes.blog_child_category', [
                        'child_category' => $category->active_childs,
                        'label' => 1,
                        'parent' => null,
                        'active_childs' => true,
                    ])
                @endif
            @endforeach
        </select>
        <button type="button" class="btn custom-btn mb-2 col-2" id="add_category_button">{{ translate('Add') }}</button>
    </div>
    <button type="button" href="#" class="btn sm my-2 w-50"
        id="add_new_category_button">{{ translate('Add New Category') }}</button>
@endcan
{{-- Create a new Category End --}}