@php
    $label = $label + 1;
@endphp
@foreach ($child_category as $child)
        <option value="{{ isset($permalink)?$child->permalink:$child->id }}" {{ $parent == $child->id ? 'selected' : '' }}>
            @for ($i = 0; $i < $label; $i++)
                -
            @endfor{{ $child->translation('name', getLocale()) }}
        </option>
        @php
            // if it requested for only active child then get all the active/publish child or get all child
            $getChilds = $active_childs === true ? $child->active_childs : $child->childs;
        @endphp
        @if (count($getChilds))
            @include('core::base.blog.includes.blog_child_category', [
                'child_category' => $getChilds,
                'label' => $label,
            ])
        @endif
@endforeach
