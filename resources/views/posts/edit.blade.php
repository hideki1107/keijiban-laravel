@extends('layouts.app')

@section('content')
@auth
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('自分の記事一覧') }}</div>

                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif
                  @foreach($posts as $post)
                    @if($post->user->id == Auth::id())
                      <div class="card text-center">
                        <table>
                          <tr>
                            <td>
                              <div class="card-body">
                                <h1 class="card-title">{{ $post->title }}</h1>
                                <h5 class="card-title">
                                  カテゴリー:{{ $post->category->category_name }}
                                </h5>
                                <h5 class="card-title">
                                  投稿者:{{ $post->user->name }}
                                  {{$post->image}}
                                </h5>
                                <img style="max-width:300px;" src="{{ asset('storage/images/'.$post->image) }}">
                                <p class="card-text">{{ $post->content }}</p>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td style="margin-right:5px">
                              <form method="post" action="{{ route('posts.delete',$post->id)}}">
                              {{ csrf_field() }}
                              <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("君は本当に削除するつもりかい？");'>
                              </form>
                            </td>
                          </tr>
                        </table>  
                        <div class="card-footer text-muted">
                          {{ $post->created_at }}
                        </div>
                      </div> 
                      <br>
                    @endif
                  @endforeach  
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection