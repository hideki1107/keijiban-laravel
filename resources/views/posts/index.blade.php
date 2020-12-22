@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @auth
            <div class="card">
                <div class="card-header">{{ __('投稿') }}</div>

                <div class="card-body">
                    @if (session('status'))
                      <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                      </div>
                    @endif
                    <div class="card text-center">
                        <div class="card-body">
                          @if ($errors->any())
                            <div class="alert alert-danger">
                              <ul>
                                @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                          @endif
                          <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label for="exampleFormControlInput1">タイトル</label>
                              <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
                            </div>                           
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">カテゴリー</label>
                              <select class="form-control" id="exampleFormControlSelect1" name="category">
                                <option value="1">book</option>
                                <option value="2">cafe</option>
                                <option value="3">taravel</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlFile1">画像</label>
                              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">本文</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="content"></textarea>
                              <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">送信</button>
                          </form>
                        </div>
                      </div>    
                </div>
            </div>
            @endauth
            <br>
            <div class="card">
                <div class="card-header">{{ __('タイムライン') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($posts as $post)
                      <div class="card text-center">
                        <div class="card-body">
                          <h1 class="card-title">{{ $post->title }}</h1>
                          <h5 class="card-title">
                            カテゴリー:{{ $post->category->category_name }}
                          </h5>
                          <h5 class="card-title">
                            投稿者:{{ $post->user->name }}
                          </h5>
                          <p class="card-text">{{ $post->content }}</p>
                          <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">続きを読む</a>
                        </div>
                        <div class="card-footer text-muted">
                          {{ $post->created_at }}
                        </div>
                      </div>
                      <br>
                    @endforeach  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
