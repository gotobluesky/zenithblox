<!-- Post Style Three -->
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
<div class="post-default post-has-bg-img  {{ $class }}">
    <div class="post-thumb">
        <a href="{{ route('theme.default.blog_details', $blog->permalink) }}" aria-label="blog image">
            @php
                $variation = getImageVariation($blog->image, 'large');
            @endphp
            <div data-bg-img="{{ isset($blog->image) ? $variation : '' }}"></div>
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
        <!-- Post Meta -->
        <ul class="nav meta align-items-center">
            <li class="meta-author">
                @php
                    $variation = getImageVariation($blog->user_image, 'small');
                    $author = str_replace(' ','-', strtolower($blog->user_name));
                @endphp
                <img data-src="{{ $variation }}" alt="Author Image" class="img-small-60 lazy">
                <a href="{{ route('theme.default.blogByAuthor', $author) }}">{{ $blog->user_name }}</a>
            </li>
            <li class="meta-date">
                <a href="{{ route('theme.default.blogByDate', getFormatedDateTime($blog->publish_at, 'Y/m/d') ) }}">{{ getFormatedDateTime($blog->publish_at, 'd M y') }}</a>
            </li>
            <li class="meta-comments"><a href="{{ route('theme.default.blog_details', $blog->permalink) . '#comment' }}"><i class="fa fa-comment mx-1"></i>{{ $blog->allblog_comment_count }}</a>
            </li>
        </ul>
    </div>
</div>
