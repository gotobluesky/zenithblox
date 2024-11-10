@php
    $category_fields = getSidebarWidgetValues($sidebar_has_widget,getFrontLocale());
    $title_placeholder = isset($category_fields['title_placeholder']) ? $category_fields['title_placeholder']:'';
    $sidebarCategories = frontendSidebarCategories();
@endphp
<div class="widget widget-select-category">
    <!-- Widget Content -->
    <div class="widget-content">
        <!-- Select -->
        {{-- Forach loop for all categories and filter blogs with each category start --}}
        <select name="category" class="form-control p-0" id="category_field">
            <option value="" selected>{{ $title_placeholder }}</option>
            @foreach ($sidebarCategories as $category)
                <option value="{{ $category->permalink }}">
                    {{ $category->name }}
                </option>
                @if (count($category->active_childs))
                    @include('theme/default::frontend.includes.blog_child_category',
                        [
                            'child_category' => $category->active_childs,
                            'label' => 1,
                            'parent' => null,
                            'permalink' => true,
                            'active_childs' => true,
                        ])
                @endif
            @endforeach
        </select>
        {{-- Forach loop for all categories and filter blogs with each category end --}}
    </div>
    <!-- End of Widget Content -->
</div>