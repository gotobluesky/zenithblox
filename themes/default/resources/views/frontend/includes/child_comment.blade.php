@php
    $label = $label + 1;
    $comment_close = commentClose($blog->publish_at); //If a comment is close or not
    
    // Cheking child comment thread level
    if ($comment_setting['thread_comments'] == 1) {
        $nested_level = $comment_setting['thread_comments_level'];
    } else {
        $nested_level = 6;
    }
    
@endphp

@foreach ($child_comment as $child)
    <ul class="child-comment-list">
        <li class="single-comment-wrapper row" id="comment-{{ $child->id }}">
            @for ($i = 0; $i < $label; $i++)
                @if ($i == $nested_level)
                @break
            @endif
            <div class="ml-0 ml-sm-5"></div>
        @endfor
        <!-- Single Comment -->
        <div class="single-post-comment my-2">
            <!-- Author Image -->
            <div class="comment-author-image">
                @php
                    $author_image = $child->user_type == 'admin' ? $child->user->image : null;
                    $author_name = $child->user_type == 'admin' ? $child->user->name : null;
                    
                    $count_child = count($child->childs);
                @endphp
                <img src="
                    @if (isset($author_image)) {{ asset(getFilePath($author_image)) }}
                    @else
                        @if ($comment_setting['show_avatars'] == 1)
                            {{ asset('/public/comment-author-image/' . $comment_setting['avatar_default'] . '.png') }}
                        @else
                            {{ asset(getFilePath($author_image)) }} @endif
                        @endif
                        "
                    alt="author-img" class="img-fluid w-75">
            </div>
            <!-- Comment Content -->
            <div class="comment-content">
                <div class="comment-author-name">
                    @if (isset($author_name))
                        <h6>{{ $author_name }}</h6>
                    @else
                        <h6>{{ $comment->user_name }}</h6>
                    @endif
                    <span>{{ getFormatedDateTime($child->comment_date, 'j M Y \a\t g:i a') }} </span>
                </div>
                <p>{{ $child->comment }} </p>
                {{-- Checking if close closing settings is on and is comment close --}}
                @if (!($comment_setting['close_comments_for_old_blogs'] == '1' && $comment_close == true))
                    <a href="javascript:void(0)" class="reply-btn mr-3 font-weight-bold"
                        data-id='{{ $child->id }}'
                        data-username='{{ $comment->user_name }}'>{{ front_translate('Reply') }}</a>
                @endif
                {{-- Checking if Comment has Reply or not --}}
                @if ($count_child > 0)
                    {{-- see reply on collapse --}}
                    <a class="collapsed more_comment_btn" href="javascript:;void(0)" data-toggle="collapse"
                        data-target="#replyToggle{{ $child->id }}" aria-expanded="false"
                        aria-controls="replyToggle{{ $child->id }}">
                        <small class="font-weight-bold text-dark">{{ front_translate('See Replies') }}</small>
                        <i class="fa fa-angle-down font-weight-bold" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
        </div>
        <!-- End of Single Comment -->
    </li>
</ul>
{{-- if comment has reply including them --}}
@if ($count_child > 0)
    <div class="collapse" id="replyToggle{{ $child->id }}">
        @include('theme/default::frontend.includes.child_comment', [
            'comment_setting' => $comment_setting,
            'child_comment' => $child->childs,
            'label' => $label,
        ])
    </div>
@endif
@endforeach
