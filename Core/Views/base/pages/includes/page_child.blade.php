@php
    $label = $label + 1;
@endphp
@foreach ($child_page as $child)
        <option value="{{ isset($permalink)?$child->permalink:$child->id }}" {{ $parent == $child->id ? 'selected' : '' }}>
            @for ($i = 0; $i < $label; $i++)
                -
            @endfor{{ $child->translation('title', getLocale()) }}
        </option>
        @if (count($child->childs))
            @include('core::base.pages.includes.page_child', [
                'child_page' => $child->childs,
                'label' => $label,
            ])
        @endif
@endforeach
