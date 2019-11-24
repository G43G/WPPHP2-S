@extends('layout.template')

@section('title')
    Snapshot - Picture
@endsection

@section('center')
<div class="content">
    @isset($singlePicture)
        <div class="picture_wrapper">
            <img src="{{ asset('/'.$singlePicture->picture_path) }}" alt="{{ ($singlePicture->picture_name) }}"/>
            <h1>{{ ($singlePicture->picture_name) }}</h1>
            <div class="picture-info">
                <div class="picture-left">
                    <h3>Shared: {{ date('d-M-Y', strtotime($singlePicture->created_at)) }}</h3>
                    <h3>By: {{ ($singlePicture->user_name) }}</h3>
                    <h3>Category: {{ ($singlePicture->category_name) }}</h3>
                    <h3>Views: {{ ($singlePicture->views) }}</h3>
                    <a href="{{ asset('/gallery') }}" class="button cancel">BACK</a>
                </div>
                @isset($comments)
                    @if(count($comments) > 0 )
                        <div class="comments">
                            <h2>Comments</h2>
                            <div class="comment">
                                @foreach($comments as $comment)
                                    <h4>{{ $comment->comment_text }}</h4>
                                    <h5>{{ $comment->user_name }} said this - {{ date("d.m.Y H:i", strtotime($comment->created_at)) }}
                                        @if(session()->has('user'))
                                            @if(session()->get('user')[0]->user_id == $comment->user_id)
                                                <a href="{{ asset('/pictures/'.$singlePicture->picture_id.'/'.$comment->comment_id) }}" class="inline"><i class="fa fa-edit inline"></i></a>
                                                <a href="{{ asset('/pictures/'.$singlePicture->picture_id.'/delete/'.$comment->comment_id) }}" class="inline"><i class="fa fa-trash"></i></a>
                                            @elseif(session()->get('user')[0]->role_id == 1)
                                                <a href="{{ asset('/pictures/'.$singlePicture->picture_id.'/'.$comment->comment_id) }}" class="inline"><i class="fa fa-edit"></i></a>
                                                <a href="{{ asset('/pictures/'.$singlePicture->picture_id.'/delete/'.$comment->comment_id) }}" class="inline"><i class="fa fa-trash"></i></a>
                                            @endif
                                        @endif
                                    </h5>                                        
                                @endforeach
                            </div>
                            @if(session()->has('user'))
                                <form action="{{ (isset($selectedComment)) ? asset('/pictures/'.$singlePicture->picture_id.'/update/'.$selectedComment->comment_id) : asset('/pictures/'.$singlePicture->picture_id.'/comment') }}" method="post">
                                {{ csrf_field() }}
                                    <textarea name="comment" placeholder="Write your comment">{{ (isset($selectedComment)) ? $selectedComment->comment_text : old('comment') }}</textarea>
                                    <div class="form-group">
                                        <input type="submit" name="btn-comment" value="{{ (isset($selectedComment))? 'UPDATE COMMENT' : 'COMMENT' }}" class="btn btn-default"/>
                                        @isset($selectedComment)
                                            <a href="{{ asset('pictures/'.$singlePicture->picture_id) }}" class="button cancel">CANCEL</a>
                                        @endisset
                                    </div> 
                                </form>
                            @endif
                        </div>
                    @else
                        <div class="comments">
                            <h2>Comments</h2>
                            <div class="comment">
                                <div class="no-comments">
                                    <h1>There are no comments on this picture. Be the first one to comment!</h1>
                                </div>
                            </div>
                            @if(session()->has('user'))
                                <form action="{{ (isset($selectedComment)) ? asset('/pictures/'.$singlePicture->picture_id.'/update/'.$selectedComment->comment_id) : asset('/pictures/'.$singlePicture->picture_id.'/comment') }}" method="post">
                                {{ csrf_field() }}
                                    <textarea name="comment" placeholder="Write your comment" value="{{ (isset($selectedComment)) ? $selectedComment->comment_text : old('comment') }}"></textarea>
                                    <div class="form-group">
                                        <input type="submit" name="btn-comment" value="{{ (isset($selectedComment))? 'UPDATE COMMENT' : 'COMMENT' }}" class="btn btn-default"/>
                                        @isset($selectedComment)
                                            <a href="{{ asset('pictures/'.$singlePicture->picture_id) }}" class="button cancel">CANCEL</a>
                                        @endisset
                                    </div> 
                                </form>
                            @endif
                        </div>
                    @endif
                @endisset
            </div>
        </div>
    @endisset
</div>
@endsection
