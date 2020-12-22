@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('投稿の詳細') }}</div>

                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                    <div class="card text-center">
                      <div class="card-body">
                        <h1 class="card-title">{{ $post->title }}</h1>
                        <h5 class="card-title">
                          カテゴリー:{{ $post->category->category_name }}
                        </h5>
                        <h5 class="card-title">
                          投稿者:{{ $post->user->name }}
                        </h5>
                        <img style='max-width:300px;' src="{{ asset('storage/images/'.$post->image) }}">
                        <p class="card-text">{{ $post->content }}</p>
                      </div>
                      <div class="card-footer text-muted">
                        {{ $post->created_at }}
                      </div>
                    </div>
                    <br>
                    @foreach( $comments as $comment )
                      @if( $comment->post_id == $post->id )
                        @if( $post->user->name == $comment->user->name )
                        <div class="card bg-light mb-3" style="max-width: 16rem;margin:0 0 0 auto;" onclick="Tap()">
                          <div class="card-header">主の回答</div>                     
                        @else
                        <div class="card bg-light mb-3" style="max-width: 16rem;" onclick="Tap()">
                          <div class="card-header">@if( $comment->user->id == Auth::id())あなた
                            @else他の人@endifの回答</div>
                        @endif    
                          <div class="card-body">
                            <h5 class="card-title">{{ $comment->user->name }}</h5>
                            <p class="card-text">{{ $comment->comment }}</p>
                            <p>{{ $comment->created_at->format('Y年m月d日 H:i') }}</p>
                          </div>
                        </div>
                      @endif
                    @endforeach
                      <br>
                      <form action="{{ route('comments.store') }}" method="POST">
                        @csrf                        
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">コメントする</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="comment"></textarea>
                          <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                          <input type="hidden" name="post_id" value="{{ $post->id }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">送信</button>
                        @if ($errors->any())
                          <div class="alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif
                      </form>  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection