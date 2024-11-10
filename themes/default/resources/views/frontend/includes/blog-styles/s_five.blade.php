<!-- Post Style Five -->
<div class="post-default post-has-no-thumb">
    <div class="post-data">
        <!-- Category -->
        <div class="cats">
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
                    $author = str_replace(' ', '-', strtolower($blog->user_name));
                @endphp
                <img src="{{ asset(getFilePath($blog->user_image)) }}" alt="author" class="img-fluid">
                <a href="{{ route('theme.default.blogByAuthor', $author) }}">{{ $blog->user_name }}</a>
            </li>
            <li class="meta-date">
                <a href="{{ route('theme.default.blogByDate', getFormatedDateTime($blog->publish_at, 'Y/m/d') ) }}">{{ getFormatedDateTime($blog->publish_at, 'd M y') }}</a>
            </li>
            <li class="meta-comments"><a href="{{ route('theme.default.blog_details', $blog->permalink) . '#comment' }}"><i class="fa fa-comment mx-1"></i>{{ $blog->allblog_comment_count }}</a>
            </li>
        </ul>
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
<!-- Post Style Five -->
