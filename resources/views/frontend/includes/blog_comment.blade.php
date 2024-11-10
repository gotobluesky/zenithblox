{{-- Checking If comments is available or not --}}
@if (count($blog_comments) > 0)
    @php
        $comment_close = commentClose($blog->publish_at); //If a comment is close or not
    @endphp

    {{-- Comment Collapse button --}}
    <button class="btn btn-comment" type="button" data-toggle="collapse" data-target="#commentToggle" aria-expanded="false"
        aria-controls="commentToggle">
        {{ front_translate('Hide Comments') }} (<span id="comment_count">{{ count($blog->allblogComment) }}</span> )
    </button>
    {{-- Comment Collapse button End --}}

    {{-- Comment List --}}
    <div class="collapse show" id="commentToggle">
        <ul class="post-all-comments">
            {{-- Loop through All Top Level Comments --}}
            @foreach ($blog_comments as $comment)
                <li class="single-comment-wrapper" id="comment-{{ $comment->id }}">
                    <!-- Single Comment -->
                    @php
                        $author_image = $comment->user_type == 'admin' ? $comment->admin_user_image : null;
                        $author_name = $comment->user_type == 'admin' ? $comment->admin_user_name : null;
                        
                        $count_child = count($comment->childs);
                    @endphp
                    <div class="single-post-comment">
                        <!-- Author Image -->
                        <div class="comment-author-image my-auto">
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
                                <span>{{ getFormatedDateTime($comment->comment_date, 'j M Y \a\t g:i a') }}</span>
                            </div>
                            <p>{{ $comment->comment }}</p>
                            {{-- Checking if close closing settings is on and is comment close --}}
                            @if (!($comment_setting['close_comments_for_old_blogs'] == '1' && $comment_close == true))
                                <a href="javascript:void(0)" class="reply-btn mr-3 font-weight-bold"
                                    data-id='{{ $comment->id }}'
                                    data-username='{{ $comment->user_name }}'>{{ front_translate('Reply') }}</a>
                            @endif
                            {{-- Checking if Comment has Reply or not --}}
                            @if ($count_child > 0)
                                {{-- see reply on collapse --}}
                                <a class="collapsed more_comment_btn" href="javascript:;void(0)" data-toggle="collapse"
                                    data-target="#replyToggle{{ $comment->id }}" aria-expanded="false"
                                    aria-controls="#replyToggle{{ $comment->id }}">
                                    <small
                                        class="font-weight-bold text-dark">{{ front_translate('See Replies') }}</small>
                                    <i class="fa fa-angle-down font-weight-bold" aria-hidden="true"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                    <!-- End of Single Comment -->
                    {{-- if comment has reply including them --}}
                    @if ($count_child > 0)
                        <div class="collapse" id="replyToggle{{ $comment->id }}">
                            @include('theme/default::frontend.includes.child_comment', [
                                'comment_setting' => $comment_setting,
                                'child_comment' => $comment->childs,
                                'label' => 1,
                            ])
                        </div>
                    @endif
                </li>
            @endforeach
            {{-- Loop through All Top Level Comments End --}}
        </ul>
    </div>
    {{-- Comment List End --}}

    <!-- Comment Pagination -->
    @if ($comment_setting['page_comments'] == 1)
        {{-- Checking if comments have more page or just 1 --}}
        @if ($blog_comments->lastPage() == 1)
            <p class="black mt-3 mr-2 text-center">{{ front_translate('No More Comments') }}</p>
        @else
            @php
                $last_page = $blog_comments->lastPage(); // last page of comments page
                $current_page = request()->input('page') ? request()->input('page') : 1;
            @endphp
            <div class="post-pagination d-flex justify-content-center">
                <p class="black mt-3 mr-2">{{ front_translate('See More Comments') }}</p>
                {{-- Previous Button --}}
                <a href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=' . request()->input('page') - 1 }}"
                    style="{{ !request()->input('page') || request()->input('page') == 1 ? 'pointer-events: none' : '' }}"><i
                        class="fa fa-angle-left"></i></a>
                {{-- Previous Button End --}}


                {{-- Pagination Number Start --}}
                @if ($current_page - 3 > 1)
                    <a href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=' . 1 }}">1</a>
                    <a style="pointer-events: none;">...</a>
                @endif

                @if ($current_page - 3 == 1)
                    <a href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=' . 1 }}">1</a>
                @endif

                @if ($current_page - 2 > 0)
                    <a
                        href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=' . $current_page - 2 }}">
                        {{ $current_page - 2 }}</a>
                @endif

                @if ($current_page - 1 > 0)
                    <a
                        href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=' . $current_page - 1 }}">
                        {{ $current_page - 1 }}</a>
                @endif

                <!-- Current Page Number -->
                <a href="#" class="current" style="pointer-events: none;">{{ $current_page }}</a>

                @if ($current_page + 1 <= $last_page)
                    <a
                        href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=' . $current_page + 1 }}">
                        {{ $current_page + 1 }}</a>
                @endif

                @if ($current_page + 2 == $last_page)
                    <a href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=' . $last_page }}">
                        {{ $last_page }}</a>
                @endif

                @if ($current_page < $last_page - 2)
                    <a style="pointer-events: none;">...</a>
                    <a
                        href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=' . $last_page }}">{{ $last_page }}</a>
                @endif
                {{-- Pagination Number Start end --}}

                {{-- Next Button --}}
                @if (request()->input('page'))
                    <a href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=' . request()->input('page') + 1 }}"
                        style="{{ request()->input('page') == $blog_comments->lastPage() ? 'pointer-events: none' : '' }}"><i
                            class="fa fa-angle-right"></i></a>
                @else
                    <a href="{{ route('theme.default.blog_details', $blog->permalink) . '?page=2' }}"
                        style="{{ 1 == $blog_comments->lastPage() ? 'pointer-events: none' : '' }}"><i
                            class="fa fa-angle-right"></i></a>
                @endif
                {{-- Next Button End --}}

            </div>
        @endif
    @endif
    <!-- End of comment Pagination -->
@endif
