<!-- Post Style Two -->
@php
    switch ($blog->formate) {
        case 'video':
            $class = 'post-has-general-video';
            break;
        case 'audio':
            $class = 'post-has-general-audio';
            break;
        default:
            $class = '';
            break;
    }
@endphp
<div class="post-default {{ $class }} post-style-two">
    <div class="post-thumb">
        <a href="{{ route('theme.default.blog_details', $blog->permalink) }}" aria-label="blog image">
            @php
                $variation = getImageVariation($blog->image, 'medium');
            @endphp
            <img data-src="{{ isset($blog->image) ? $variation : '' }}" alt="{{ $blog->name }}"
            class="img-fluid lazy" width="100%">
        </a>
    </div>
    <div class="post-data">
        <!-- Category -->
        <div class="cats">
            {{-- Checking if blog category id exists --}}
            @if (count($blog->blog_category))
                @foreach ($blog->blog_category as $cat)
                    <a href="{{ route('theme.default.blogByCategory', $cat->permalink) }}"
                        class="mr-1">{{ $cat->name }}</a>
                @endforeach
            @endif
        </div>
        <!-- Title -->
        <div class="title">
            <h2><a href="{{ route('theme.default.blog_details', $blog->permalink) }}">
                    {{ $blog->name }}
                </a>
            </h2>
        </div>
        <!-- Post Desc -->
        <div class="desc">
            @php
                $short_description = $blog->short_description;
            @endphp
            <p>
                {{ strlen($short_description) > $blog_excerpt ? mb_substr($short_description, 0, $blog_excerpt, 'UTF-8') . '...' : $short_description }}
            </p>
        </div>
    </div>
</div>

<!-- Post Style Two -->
