<!-- Post Style Four -->
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
<div class="post-default post-has-front-title {{ $class }}">
    <div class="post-thumb">
        <a href="{{ route('theme.default.blog_details', $blog->permalink) }}" aria-label="blog image">
            @php
                $variation = getImageVariation($blog->image, 'large');
            @endphp
            <img src="{{ isset($blog->image) ? $variation : '' }}" alt="{{ $blog->name }}" class="img-fluid">
        </a>
    </div>
    <div class="d-flex justify-content-center">
        <div class="post-data col-10">
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
        </div>
    </div>
</div>
<!-- Post Style Four -->
