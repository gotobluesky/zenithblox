@extends('core::base.layouts.master')

@section('title')
    {{ translate('Edit Comment') }}
@endsection

@section('custom_css')
@endsection

@section('main_content')
    <form class="form-horizontal my-4 mb-4" action="{{ route('core.blog.comment.update') }}" method="post"
        enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-30">
                    <div class="card-header">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="font-20">{{ translate('Edit Comment') }}</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $comment->id }}">
                        @if ($errors->has('id'))
                            <p class="text-danger my-1">{{ $errors->first('id') }}</p>
                        @endif
                        {{-- Author --}}
                        <div class="my-3">
                            <h3 class="font-20 black my-3">{{ translate('Author') }}</h3>
                            <div class="row mb-2">
                                <span class="col-sm-2 black">{{ translate('Name') }}</span>
                                <div class="col-sm-8">
                                    <input type="text" name="user_name" class="form-control" value="{{ $comment->user_name }}">
                                    @if ($errors->has('user_name'))
                                        <p class="text-danger my-1">{{ $errors->first('user_name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-2">
                                <span class="col-sm-2 black">{{ translate('Email') }}</span>
                                <div class="col-sm-8">
                                    <input type="text" name="user_email" class="form-control"  value="{{ $comment->user_email }}">
                                    @if ($errors->has('user_email'))
                                        <p class="text-danger my-1">{{ $errors->first('user_email') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-4">
                                <span class="col-sm-2 black">{{ translate('Url') }}</span>
                                <div class="col-sm-8">
                                    <input type="text" name="user_website"  class="form-control"  value="{{ $comment->user_website }}">
                                    @if ($errors->has('user_website'))
                                        <p class="text-danger my-1">{{ $errors->first('user_website') }}</p>
                                    @endif
                                </div>
                            </div>
                            <textarea name="comment" class="form-control h-100" rows="5">{{ $comment->comment }}</textarea>
                            @if ($errors->has('comment'))
                                <p class="text-danger my-1">{{ $errors->first('comment') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Add Blog Side Field --}}
            <div class="col-md-4">
                {{-- Publish Section --}}
                <div class="card card-body">
                    <h4 class="font-16">{{ translate('Save') }}</h4>

                    {{-- Comment Status part --}}
                    <div class="row mt-2 mx-1">
                        <i class="icofont-eye icofont-1x"></i>
                        <span class="font-14 black mx-1">{{ translate('Status') }} : </span>
                        @switch($comment->status)
                            @case(1)
                                {{ translate('Approve') }}
                            @break
                            @case(2)
                                {{ translate('Pending') }}
                            @break
                            @case(3)
                                {{ translate('Spam') }}
                            @break
                            @default
                        @endswitch
                    </div>
                    <div class="mx-1" id="visibility_form">
                        <input type="radio" checked name="status" id="status-radio-approve" value="approve" {{ $comment->status == '1' ? 'checked':'' }}/>
                        <label for="status-radio-approve">{{ translate('Approve') }}</label>
                        <br />

                        <input type="radio" name="status" id="status-radio-pending" value="pending"  {{ $comment->status == '2' ? 'checked':'' }}/>
                        <label for="status-radio-pending">{{ translate('Pending') }}</label>
                        <br />

                        <input type="radio" name="status" id="status-radio-spam" value="spam"  {{ $comment->status == '3' ? 'checked':'' }}/> <label
                            for="status-radio-spam">{{ translate('Spam') }}</label><br />
                    </div>
                    @if ($errors->has('status'))
                        <p class="text-danger my-1">{{ $errors->first('status') }}</p>
                    @endif
                    {{-- Comment Status part end --}}

                    {{-- Submitted part --}}
                    <div class="row my-2 mx-1">
                        <i class="icofont-ui-calendar icofont-1x mt-2"></i>
                        <span class="font-14 black ml-1 mt-2">{{ translate('Submitted on') }} :</span>
                        <input type="datetime-local" name="comment_date" class="theme-input-style w-75 ml-2 py-0"
                            value="{{ $comment->comment_date }}">
                        @if ($errors->has('comment_date'))
                            <p class="text-danger my-1">{{ $errors->first('comment_date') }}</p>
                        @endif
                    </div>
                    {{-- Submitted part end --}}

                    {{-- In Response to part --}}
                    <div class="row my-2 mx-1">
                        <i class="icofont-comment icofont-1x"></i>
                        <span class="font-14 black mx-1">{{ translate('In Response to') }} :</span>
                        <a href="{{ route('core.edit.blog', ['id' => $comment->blog_id, 'lang' => getDefaultLang()]) }}"
                            target="_blank" class="text-primary d-block mb-1">{{ $comment->blog->translation('name', getLocale())}}</a>
                    </div>
                    {{-- In Response to part end --}}

                    {{-- In Reply to part --}}
                    @if (isset($comment->parent))
                        <div class="row my-2 mx-1">
                            @php
                                $parent_comment = Core\Models\TlBlogComment::where('id', $comment->parent)->first()->user_name;
                            @endphp
                            <span class="d-block mb-3 mx-1">{{ translate('In reply to') }} :</span>
                            <a href="javascript:void(0)" class="text-primary" >{{ $parent_comment }}</a>
                        </div>
                    @endif
                    {{-- In Reply to part end --}}
                    <div class="row mx-1 mt-4">
                        <button type="submit" class="col-sm-3 btn sm">{{ translate('Update') }}</button>
                    </div>
                </div>
                {{-- Publish Section End --}}
            </div>
            {{-- Add Blog Side Field End --}}

        </div>

    </form>
@endsection

@section('custom_scripts')
@endsection
