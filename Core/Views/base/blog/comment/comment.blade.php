@extends('core::base.layouts.master')

@section('title')
    {{ translate('Blog Comment') }}
@endsection

@section('custom_css')
    <!-- ======= Data-Tables Styles ======= -->
    @include('core::base.includes.data_table.css')
    <!-- ======= Data-Tables Styles Endd ======= -->
    <style>
        .comment_img {
            max-width: 60px;
        }

        .vtop {
            vertical-align: top;
        }

        /* comment status change buttons on hover */
        .buttons {
            visibility: hidden;
            transition-duration: 0.1ms;
        }

        .comment_list:hover .buttons {
            visibility: visible;
            transition-duration: 0.1ms;
        }

        @media (max-width: 575px) {
            .comment-count {
                width: 50px !important;
                height: 50px !important;
            }
        }
    </style>
@endsection

@section('main_content')
    <!-- Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-30">
                <div class="card-header px-3 py-4">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h3 class="font-24">
                            {{ translate('Comments') }}
                            @if (request()->blog)
                                @php
                                    $blog = Core\Models\TlBlog::where('id', request()->blog)->first();
                                @endphp
                                @if (isset($blog))
                                    <a href="{{ route('core.edit.blog', ['id' => $blog->id, 'lang' => getDefaultLang()]) }}"
                                        target="_blank"
                                        class="text-primary mx-1">{{ $blog->translation('name', getLocale()) }}</a>
                                    <a href="/blog/{{ $blog->permalink }}" target="_blank"
                                        class="text-primary mx-1 font-14">{{ translate('View Blog') }}</a>
                                @endif
                            @endif
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Comment Filter Buttons --}}
                    <div class="filter_button row mb-4 pl-3">
                        @php
                            if (request()->blog) {
                                $count = ['tl_blog_comments.blog_id', '=', request()->blog];
                                $if_blog = '&blog=' . request()->blog;
                                $all_blog_request = '?status=singel_blog_comment&blog=' . request()->blog;
                                $search = '';
                            } elseif (request()->search) {
                                $count = ['tl_blog_comments.id', '!=', null];
                                $if_blog = '&search=' . request()->search;
                                $all_blog_request = '?status=search_text&search=' . request()->search;
                                $search = request()->search;
                            } elseif (request()->ip_address) {
                                $count = ['tl_blog_comments.user_ip_address', '=', request()->ip_address];
                                $if_blog = '&ip_address=' . request()->ip_address;
                                $all_blog_request = '?status=user_ip_address&ip_address=' . request()->ip_address;
                                $search = '';
                            } else {
                                $count = ['tl_blog_comments.id', '!=', null];
                                $if_blog = '';
                                $all_blog_request = '';
                                $search = '';
                            }
                        @endphp
                        <a href="{{ route('core.blog.comment') . $all_blog_request }}" class="btn sm btn-dark mx-1 my-2">
                            {{ translate('All') }}({{ getCommentCount([$count], $search) }})</a>

                        <a href="{{ route('core.blog.comment') . '?status=mine' . $if_blog }}"
                            class="btn sm btn-primary sm mx-1 my-2">
                            {{ translate('Mine') }}({{ getCommentCount([$count, ['tl_blog_comments.user_id', '=', Auth::user()->id]], $search) }})</a>

                        <a href="{{ route('core.blog.comment') . '?status=pending' . $if_blog }}"
                            class="btn sm btn-info mx-1 my-2">
                            {{ translate('Pending') }}({{ getCommentCount([$count, ['tl_blog_comments.status', '=', config('settings.blog_comment_status.pending')]], $search) }})</a>

                        <a href="{{ route('core.blog.comment') . '?status=approve' . $if_blog }}"
                            class="btn sm btn-success mx-1 my-2">
                            {{ translate('Approve') }}({{ getCommentCount([$count, ['tl_blog_comments.status', '=', config('settings.blog_comment_status.approve')]], $search) }})</a>

                        <a href="{{ route('core.blog.comment') . '?status=spam' . $if_blog }}"
                            class="btn sm btn-danger mx-1 my-2">
                            {{ translate('Spam') }}({{ getCommentCount([$count, ['tl_blog_comments.status', '=', config('settings.blog_comment_status.spam')]], $search) }})</a>

                        <a href="{{ route('core.blog.comment') . '?status=trash' . $if_blog }}"
                            class="btn sm btn-danger mx-1 my-2">
                            {{ translate('Trash') }}({{ getCommentCount([$count, ['tl_blog_comments.status', '=', config('settings.blog_comment_status.trash')]], $search) }})</a>

                        @if (request()->input('ip_address'))
                            <span class="ml-3 h4">{{ translate('Result For') }} :
                                ({{ request()->input('ip_address') }})</span>
                        @elseif(request()->input('search'))
                            <span class="ml-3 h4">{{ translate('Result For') }} :
                                ({{ request()->input('search') }})</span>
                        @endif

                    </div>
                    {{-- Comment Filter Buttons End --}}
                    <div class="table-responsive">
                        <table class="hoverable text-nowrap border-top2 " id="comment_table">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="select-all" class="select-all" onchange="selectAll()">
                                    </th>
                                    <th>{{ translate('Author') }}</th>
                                    <th>{{ translate('Comment') }}</th>
                                    @if (!request()->blog)
                                        <th>{{ translate('In Response to') }}</th>
                                    @endif
                                    <th>{{ translate('Submitted on') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $key = 1;
                                @endphp
                                @foreach ($comments as $comment)
                                    <tr class="comment_list @if ($comment->status == '2') unapprove @endif">
                                        <td class="vtop">
                                            <input type="checkbox" class="comment_id" name="comment_id[]"
                                                value="{{ $comment->id }}">
                                        </td>
                                        <td class="d-flex align-itmes-center vtop">
                                            @php
                                                $comment_setting = commentFormSettings();
                                                $author = Core\Models\User::where('id', $comment->user_id)->first();
                                                $author_image = isset($author) ? $author->image : null;
                                                $author_name = isset($author) ? $author->name : null;
                                                $author_email = isset($author) ? $author->email : null;
                                            @endphp
                                            <div class="d-inline">
                                                <img src="
                                                    @if (isset($author_image)) {{ getFilePath($author_image) }}
                                                    @else
                                                        @if ($comment_setting['show_avatars'] == 1)
                                                            {{ asset('/public/comment-author-image/' . $comment_setting['avatar_default'] . '.png') }}
                                                        @else
                                                            {{ getFilePath($author_image) }} @endif
                                                    @endif"
                                                    alt="" class="comment_img">
                                            </div>
                                            <div class="d-inline-block ml-1">
                                                <span>
                                                    {{ isset($author_name) ? $author_name : $comment->user_name }}
                                                </span>
                                                <br>

                                                @if (isset($comment->user_website) && $comment->user_website != '')
                                                    <a href="{{ $comment->user_website }}" target="_blank"
                                                        class="text-primary">{{ $comment->user_website }}</a>
                                                    <br>
                                                @endif

                                                @if (isset($author_email))
                                                    <a href="javascript:void(0)" class="text-primary">
                                                        {{ $author_email }}
                                                    </a>
                                                    <br>
                                                @else
                                                    @if ($comment->user_email != '')
                                                        <a href="javascript:void(0)" class="text-primary">
                                                            {{ $comment->user_email }}
                                                        </a>
                                                        <br>
                                                    @endif
                                                @endif

                                                <a href="{{ route('core.blog.comment') . '?status=user_ip_address&ip_address=' . $comment->user_ip_address }}"
                                                    class="text-primary">{{ $comment->user_ip_address }}</a>
                                            </div>
                                        </td>

                                        <td class="vtop">
                                            @if (isset($comment->parent))
                                                @php
                                                    $parent_comment = Core\Models\TlBlogComment::where('id', $comment->parent)->first()->user_name;
                                                @endphp
                                                <span class="d-block mb-3">{{ translate('In reply to') }}
                                                    <a href="javascript:void(0)"
                                                        class="text-primary">{{ $parent_comment }}</a>
                                                </span>
                                            @endif
                                            <span class="d-block mb-2">{{ $comment->comment }}</span>
                                            <div class="buttons d-block row pl-3">
                                                {{-- if status pending and approve --}}
                                                @if ($comment->status == '1' || $comment->status == '2')
                                                    @if ($comment->status == '1')
                                                        <a href="javascript:void(0)" class="text-warning mx-1"
                                                            onclick="commentStatus('unapprove',{{ $comment->id }})">{{ translate('Unapprove') }}
                                                            |</a>
                                                        <a href="javascript:void(0)" class="text-primary mx-1"
                                                            onclick="commentReply({{ $comment->id }},'{{ $comment->blog->permalink }}')">{{ translate('Reply') }}
                                                            |</a>
                                                    @elseif($comment->status == '2')
                                                        <a href="javascript:void(0)" class="text-success mx-1"
                                                            onclick="commentStatus('approve',{{ $comment->id }})">{{ translate('Approve') }}
                                                            |</a>
                                                    @endif
                                                    <a href="{{ route('core.blog.comment.edit', $comment->id) }}"
                                                        class="text-primary mx-1">{{ translate('Edit') }}
                                                        |</a>
                                                    <a href="javascript:void(0)" class="text-danger mx-1"
                                                        onclick="commentStatus('spam',{{ $comment->id }})">{{ translate('Spam') }}
                                                        |</a>
                                                    <a href="javascript:void(0)" class="text-danger mx-1"
                                                        onclick="commentStatus('trash',{{ $comment->id }})">{{ translate('Trash') }}</a>
                                                @else
                                                    {{-- if status trash and spam --}}
                                                    @if ($comment->status == '3')
                                                        <a href="javascript:void(0)"
                                                            class="{{ $comment->previous_status == '1' ? 'text-success' : 'text-warning' }}  mx-1"
                                                            onclick="commentStatus('not_spam',{{ $comment->id }})">{{ translate('Not Spam') }}
                                                            |</a>
                                                    @elseif($comment->status == '4')
                                                        <a href="javascript:void(0)" class="text-danger mx-1"
                                                            onclick="commentStatus('spam',{{ $comment->id }})">{{ translate('Spam') }}
                                                            |</a>
                                                        <a href="javascript:void(0)"
                                                            class="{{ $comment->previous_status == '1' ? 'text-success' : 'text-warning' }}  mx-1"
                                                            onclick="commentStatus('restore',{{ $comment->id }})">{{ translate('Restore') }}
                                                            |</a>
                                                    @endif
                                                    <a href="javascript:void(0)" class="text-danger mx-1"
                                                        onclick="commentDeleteConfirmationModel({{ $comment->id }})">{{ translate('Delete Permanently') }}</a>
                                                @endif
                                            </div>
                                        </td>
                                        {{-- Check if Comments is Filter By Blog Or not --}}
                                        @if (!request()->blog)
                                            <td class="vtop">
                                                <a href="{{ route('core.blog.comment') . '?status=singel_blog_comment&blog=' . $comment->blog_id }}"
                                                    class="header-icon notification-icon comment-count">
                                                    <span class="count bg-warning">
                                                        {{ getCommentCount([['tl_blog_comments.blog_id', '=', $comment->blog_id], ['tl_blog_comments.status', '=', config('settings.blog_comment_status.pending')]]) }}
                                                    </span>
                                                    <span>
                                                        {{ getCommentCount([['tl_blog_comments.blog_id', '=', $comment->blog_id], ['tl_blog_comments.status', '=', config('settings.blog_comment_status.approve')]]) }}
                                                    </span>
                                                </a>
                                                <div class="d-inline-block pl-1">
                                                    <a href="{{ route('core.edit.blog', ['id' => $comment->blog_id, 'lang' => getDefaultLang()]) }}"
                                                        target="_blank"
                                                        class="text-primary d-block mb-1">{{ mb_substr($comment->blog->translation('name', getLocale()), 0, 35, 'UTF-8') }}</a>
                                                    <a href="/blog/{{ $comment->blog_permalink }}" target="_blank"
                                                        class="text-primary d-block mb-3">{{ translate('View Blog') }}</a>
                                                </div>
                                            </td>
                                        @endif

                                        <td class="vtop">
                                            <span>{{ getFormatedDateTime($comment->comment_date, 'Y/m/d \a\t H:i a') }}</span>
                                        </td>
                                    </tr>
                                    @php
                                        $key++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (!(request()->input('page') && request()->input('page') > $comments->lastPage()))
                        {{-- pagination --}}
                        <div class="row mt-2 justify-content-between">
                            {{-- Comment Page Count Info --}}
                            <div class="col-md-4">
                                <p>{{ translate('Showing') }}
                                    @if (!request()->input('page') || request()->input('page') == 1)
                                        1 to {{ count($comments) }}
                                    @else
                                        @php
                                            if (request()->input('per_page')) {
                                                $per_page_count = request()->input('per_page');
                                            } else {
                                                $per_page_count = 10;
                                            }
                                            
                                            $start_count = ((int) request()->input('page') - 1) * $per_page_count + 1;
                                            if (request()->input('page') == $comments->lastPage()) {
                                                $end_count = $comments->total();
                                            } else {
                                                $end_count = (int) request()->input('page') * $per_page_count;
                                            }
                                        @endphp
                                        {{ $start_count . ' to ' . $end_count }}
                                    @endif
                                    {{ translate('items of') }} {{ $comments->total() }}
                                </p>
                            </div>

                            <div class="col-md-4">
                                <!-- Pagination -->
                                <div class="pagination d-flex flex-column align-items-center">
                                    @php
                                        $url = route('core.blog.comment');
                                        
                                        if (request()->input('status')) {
                                            if (request()->input('per_page')) {
                                                if (request()->input('ip_address')) {
                                                    $route = $url . '?status=' . request()->input('status') . '&ip_address=' . request()->input('ip_address') . '&per_page=' . request()->input('per_page');
                                                } elseif (request()->input('search')) {
                                                    $route = $url . '?status=' . request()->input('status') . '&search=' . request()->input('search') . '&per_page=' . request()->input('per_page');
                                                } elseif (request()->input('blog')) {
                                                    $route = $url . '?status=' . request()->input('status') . '&blog=' . request()->input('blog') . '&per_page=' . request()->input('per_page');
                                                } else {
                                                    $route = $url . '?status=' . request()->input('status') . '&per_page=' . request()->input('per_page');
                                                }
                                            } else {
                                                if (request()->input('ip_address')) {
                                                    $route = $url . '?status=' . request()->input('status') . '&ip_address=' . request()->input('ip_address');
                                                } elseif (request()->input('search')) {
                                                    $route = $url . '?status=' . request()->input('status') . '&search=' . request()->input('search');
                                                } elseif (request()->input('blog')) {
                                                    $route = $url . '?status=' . request()->input('status') . '&blog=' . request()->input('blog');
                                                } else {
                                                    $route = $url . '?status=' . request()->input('status');
                                                }
                                            }
                                        } else {
                                            if (request()->input('per_page')) {
                                                $route = $url . '?per_page=' . request()->input('per_page');
                                            } else {
                                                $route = $url . '?comment-list';
                                            }
                                        }
                                        
                                        $last_page = $comments->lastPage();
                                        $current_page = request()->input('page') ? request()->input('page') : 1;
                                    @endphp

                                    <ul class="list-inline d-inline-flex align-items-center mb-2">
                                        <li>
                                            {{-- Previous Button --}}
                                            <a href="{{ $route . '&page=' . request()->input('page') - 1 }}"
                                                style="{{ !request()->input('page') || request()->input('page') == 1 ? 'pointer-events: none' : '' }}">
                                                <i class="icofont-arrow-left"></i>
                                            </a>
                                            {{-- Previous Button End --}}
                                        </li>

                                        {{-- Pagination Number Start --}}
                                        @if ($current_page - 3 > 1)
                                            <li>
                                                <a href="{{ $route . '&page=' . 1 }}">1</a>
                                            </li>
                                            <li>
                                                <a>...</a>
                                            </li>
                                        @endif

                                        @if ($current_page - 3 == 1)
                                            <li>
                                                <a href="{{ $route . '&page=' . 1 }}">1</a>
                                            </li>
                                        @endif

                                        @if ($current_page - 2 > 0)
                                            <li>
                                                <a href="{{ $route . '&page=' . $current_page - 2 }}">
                                                    {{ $current_page - 2 }}</a>
                                            </li>
                                        @endif

                                        @if ($current_page - 1 > 0)
                                            <li>
                                                <a href="{{ $route . '&page=' . $current_page - 1 }}">
                                                    {{ $current_page - 1 }}</a>
                                            </li>
                                        @endif

                                        <li class="current">
                                            <a href="#" style="pointer-events: none;">{{ $current_page }}</a>
                                        </li>

                                        @if ($current_page + 1 <= $last_page)
                                            <li>
                                                <a href="{{ $route . '&page=' . $current_page + 1 }}">
                                                    {{ $current_page + 1 }}</a>
                                            </li>
                                        @endif

                                        @if ($current_page + 2 == $last_page)
                                            <li>
                                                <a href="{{ $route . '&page=' . $last_page }}">
                                                    {{ $last_page }}</a>
                                            </li>
                                        @endif

                                        @if ($current_page < $last_page - 2)
                                            <li>
                                                <a>...</a>
                                            </li>
                                            <li>
                                                <a href="{{ $route . '&page=' . $last_page }}">{{ $last_page }}</a>
                                            </li>
                                        @endif
                                        {{-- Pagination Number Start end --}}
                                        <li>
                                            @if (request()->input('page'))
                                                <a href="{{ $route . '&page=' . request()->input('page') + 1 }}"
                                                    style="{{ request()->input('page') == $comments->lastPage() ? 'pointer-events: none' : '' }}"><i
                                                        class="icofont-arrow-right"></i></a>
                                            @else
                                                <a href="{{ $route . '&page=2' }}"
                                                    style="{{ $comments->lastPage() == 1 ? 'pointer-events: none' : '' }}"><i
                                                        class="icofont-arrow-right"></i></a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Pagination -->
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Content -->


    <!-- Comment Delete Confirmation Modal-->
    <div id="commentDelete-modal" class="Delete-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Comment Delete Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <input type="hidden" id="delete_comment_id" value>
                    <p class="mt-1">{{ translate('Are you sure you want to Permanently Delete This Comment') }}?</p>
                    <button type="button" class="btn long mt-2  btn-danger"
                        data-dismiss="modal">{{ translate('cancel') }}</button>
                    <button class="btn long mt-2" onclick="commentDelete()"
                        id="bulk_button">{{ translate('Delete') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--Category Bulk Delete Modal End-->

    <!-- Comment Bulk Modal-->
    <div id="bulkAction-modal" class="bulkAction-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Bulk Action Confirmation') }}</h4>
                </div>
                <div class="modal-body text-center">
                    <input type="hidden" id="action" value="">
                    <p class="mt-1">{{ translate('Are you sure you want to take this Action') }}?</p>
                    <button type="button" class="btn long mt-2  btn-danger"
                        data-dismiss="modal">{{ translate('cancel') }}</button>
                    <button class="btn long mt-2" onclick="bulkAction()" id="bulk_button"></button>
                </div>
            </div>
        </div>
    </div>
    <!--Comment Bulk Modal End-->

    <!--Comment Reply Modal-->
    <div id="commentReply-modal" class="commentReply-modal modal fade show" aria-modal="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Comment Reply') }}</h4>
                </div>
                <form action="javascript:;void(0)" method="post" id="commentReplyModalForm">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" id="parent" name="parent" value>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="blog_permalink" id="blog_permalink" value>
                        <textarea name="comment" id="comment_textarea" class="form-control h-100" rows="5"></textarea>
                        <button type="button" class="btn long mt-2  btn-danger"
                            data-dismiss="modal">{{ translate('cancel') }}</button>
                        <button class="btn long mt-2" id="bulk_button"
                            onclick="replyCommentSubmit()">{{ translate('Reply') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Comment Reply Modal End-->
@endsection

@section('custom_scripts')
    <!-- ======= Data-Tables Scripts ======= -->
    @include('core::base.includes.data_table.script')
    <!-- ======= Data-Tables Scripts Ends ======= -->

    <script  type="application/javascript">
        $(document).ready(function() {
            "use strict";
            let table = $("#comment_table").DataTable({
                responsive: false,
                scrollX:true,
                lengthChange: true,
                autoWidth: false,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All'],
                ],
            });

            // Show Entry Count on Per Page
            if('{{ request()->per_page }}'){
                if('{{ request()->per_page }}' == '{{ $comments->total() }}'){
                    table.page.len(-1).draw();
                }else{
                    table.page.len('{{ request()->per_page }}').draw();
                }
            }else{
                table.page.len(10).draw();
            }

            // show search text 
            if('{{ request()->search }}'){
                table.search('{{ request()->search }}');
            }

            // Hiding The Default Pagination
            $('#comment_table_paginate').closest(".row").hide();

            // Show Entry On Chnage
            $('#comment_table').on( 'length.dt', function ( e, settings, len ) {
                getComment(len);
            } );

            // Search Form 
            $('.dataTables_filter input').unbind().keyup(function(e) {
                var value = $(this).val();
                if(e.which === 13){
                    getSearchComment(value);
                }
            });

            // Get Bulk Options Based on SattuscommentDeleteConfirmationModel
            var comment_status = '{{ request()->status }}';
            var option;
            if(comment_status != ''){
                    switch ('{{ request()->status }}') {
                        case 'mine':
                            option = `<option value="trash">{{ translate('Move to Trash') }}</option>`
                            break;

                        case 'pending':
                            option = `<option value="approve">{{ translate('Approve') }}</option>
                                        <option value="spam">{{ translate('Mark as Spam') }}</option>
                                        <option value="trash">{{ translate('Move to Trash') }}</option>`
                            break;

                        case 'approve':
                            option = `<option value="unapprove">{{ translate('Unapprove') }}</option>
                                        <option value="spam">{{ translate('Mark as Spam') }}</option>
                                        <option value="trash">{{ translate('Move to Trash') }}</option>`
                            break;

                        case 'spam':
                            option =`<option value="not_spam">{{ translate('Not Spam') }}</option>
                                        <option value="delete_all">{{ translate('Delete Permanetly') }}</option>`
                            break;

                        case 'trash':
                            option =`<option value="spam">{{ translate('Mark as Spam') }}</option>
                                        <option value="restore">{{ translate('Restore') }}</option>
                                        <option value="delete_all">{{ translate('Delete Permanetly') }}</option>`
                            break;

                        default:
                            option =`<option value="unapprove">{{ translate('Unapprove') }}</option>
                                        <option value="approve">{{ translate('Approve') }}</option>
                                        <option value="spam">{{ translate('Mark as Spam') }}</option>
                                        <option value="trash">{{ translate('Move to Trash') }}</option>`
                            break;
                        }
            } else{
                option =`<option value="unapprove">{{ translate('Unapprove') }}</option>
                            <option value="approve">{{ translate('Approve') }}</option>
                            <option value="spam">{{ translate('Mark as Spam') }}</option>
                            <option value="trash">{{ translate('Move to Trash') }}</option>`
            }

            // Bulk Append
            var bulk_actions_dropdown =
                    `<div id="bulk-action" class="dataTables_length d-flex">
                        
                        <select class="theme-input-style bulk-action-selection mr-3">
                            <option value="">{{ translate('Bulk Action') }}</option>`+
                            option
                        +`</select>
                        <button class="btn long" onclick="bulkActionConfirmation()">{{ translate('Apply') }}</button>
                    </div>`;

            $(bulk_actions_dropdown).insertAfter("#comment_table_wrapper #comment_table_length");

        });

        // Reply Button Model Show
        function commentReply(comment_id, blog_permalink){
            "use strict";
            $('#commentReply-modal').modal('show');
            $('#parent').val(comment_id);
            $('#blog_permalink').val(blog_permalink);
            $('#comment_textarea').val('');
        }

        // Modal Form Submit
        function replyCommentSubmit(){
            "use strict";
            var formData = $('#commentReplyModalForm').serializeArray();
            $.ajax({
                    type: "post",
                    url: '{{ route('core.blog.comment.reply') }}',
                    data: formData,
                    success: function(res) {
                        if (res.demo_mode) {
                            toastr.error(res.message, "Alert!");
                        } else {
                            if(res.success){
                                toastr.success(res.success, "Success!");
                                location.reload();
                            } else{
                                if(res.warning){
                                    toastr.warning(res.warning, "Warning!");
                                }
                                
                                if(res.pending){
                                    toastr.info(res.pending, "Pending!");
                                }

                                if(res.error){
                                    toastr.error(res.error, "Error!");
                                }
                            }
                        }
                    },
                    error: function(data, textStatus, jqXHR) {
                        toastr.error( "Comment Submit Failed ", "Error!");
                    }
            });
        }

        // Per-Page Comment
        function getComment(per_page){
            "use strict";
            let count = '';
            if(per_page == '-1'){
                count = '{{ $comments->total() }}';
            }else{
                count = per_page;
            }

            if('{{ request()->status }}'){

                if('{{ request()->ip_address }}'){
                    window.location.replace('{{ route('core.blog.comment') }}?status='+'{{ request()->status }}'+'&ip_address='+'{{ request()->ip_address }}'+'&per_page='+count);

                }else if('{{ request()->search }}'){
                    window.location.replace('{{ route('core.blog.comment') }}?status='+'{{ request()->status }}'+'&search='+'{{ request()->search }}'+'&per_page='+count);

                }else if('{{ request()->blog }}'){
                    window.location.replace('{{ route('core.blog.comment') }}?status='+'{{ request()->status }}'+'&blog='+'{{ request()->blog }}'+'&per_page='+count);

                } else{
                    window.location.replace('{{ route('core.blog.comment') }}?status='+'{{ request()->status }}'+'&per_page='+count);
                }
            } else{
                window.location.replace('{{ route('core.blog.comment') }}?per_page='+count);
            }

        }

        // Search Box Comment
        function getSearchComment(text){
            "use strict";
            if('{{ request()->status }}'){
                window.location.replace('{{ route('core.blog.comment') }}?status='+'{{ request()->status }}'+'&search='+text);
            } else{
                window.location.replace('{{ route('core.blog.comment') }}?status=search_text&search='+text);
            }
        }

        function commentStatus(status,id){
            "use strict";
            $.ajax({
                type: "post",
                url: '{{ route('core.blog.comment.status') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status: status
                },
                success: function(res) {
                    if (res.demo_mode) {
                        toastr.error(res.message, "Alert!");
                    } else {
                        if(!res.error){
                            location.reload();
                        } else {
                            toastr.error( res.error, "Error!");
                        }
                    }
                },
                error: function(data, textStatus, jqXHR) {
                    toastr.error( "Comment Status Failed", "Error!");
                }
            });
        }

        /**
        * Comment Delete Confirmation Model
        */
        function commentDeleteConfirmationModel(id){
            "use strict";
            $('#commentDelete-modal').modal('show');
            $('#delete_comment_id').val(id);
        }

        /**
        * Comment Permanantly delete
        */
        function commentDelete(id){
            "use strict";
            var id = $('#delete_comment_id').val();
            $.ajax({
                type: "post",
                url: '{{ route('core.blog.comment.delete') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                },
                success: function(res) {
                    if (res.demo_mode) {
                        toastr.error(res.message, "Alert!");
                    } else {
                        if(!res.error){
                            location.reload();
                        } else {
                            toastr.error( res.error, "Error!");
                        }
                    }
                },
                error: function(data, textStatus, jqXHR) {
                    toastr.error( "Comment Status Failed", "Error!");
                }
            });
        }

        /**
        * show bulk delete confirmation modal
        */
        function bulkActionConfirmation() {
            "use strict";
            let action = $('.bulk-action-selection').val();
            let button_text
            switch (action) {
                case 'delete_all':
                    button_text = '{{ translate('Delete All') }}'
                    break;
                case 'unapprove':
                    button_text = '{{ translate('Unapprove') }}'
                    break;
                case 'approve':
                    button_text = '{{ translate('Approve') }}'
                    break;
                case 'spam':
                    button_text = '{{ translate('Spam') }}'
                    break;
                case 'trash':
                    button_text = '{{ translate('Trash') }}'
                    break;
                case 'not_spam':
                    button_text = '{{ translate('Not Spam') }}'
                    break;
                case 'restore':
                    button_text = '{{ translate('Restore') }}'
                    break;
            }

            if(action == '' || button_text == ''){
                toastr.error('{{ translate('No Action Selected') }}', "Error!");
            } else{
                $('#bulkAction-modal').modal('show');
                $('#bulkAction-modal #bulk_button').html(button_text);
                $('#action').val(action);
            }
        }

        /**
        * bulk action
        */
        function bulkAction(){
            "use strict";
            var selected_items = [];
            $('input[name^="comment_id"]:checked').each(function() {
                selected_items.push($(this).val());
            });

            var action = $('#action').val();

            if (selected_items.length > 0) {

                $.ajax({
                    type: "post",
                    url: '{{ route('core.blog.comment.bulk.action') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        data: selected_items,
                        action: action
                    },
                    success: function(res) {
                        if (res.demo_mode) {
                            toastr.error(res.message, "Alert!");
                        } else {
                            if(!res.error){
                                $(".comment_id").prop("checked", false);
                                location.reload();
                            } else {
                                toastr.error( res.error, "Error!");
                            }
                        }
                    },
                    error: function(data, textStatus, jqXHR) {
                        toastr.error( "Bulk Action Failed", "Error!");
                    }
                });

            } else {
                toastr.error('{{ translate('No Item Selected') }}', "Error!");
            }
        }

        /**
         * Select all category
         **/
         function selectAll() {
            "use strict";
            if ($('.select-all').is(":checked")) {
                $(".comment_id").prop("checked", true);
            } else {
                $(".comment_id").prop("checked", false);
            }
        }

    </script>
@endsection
