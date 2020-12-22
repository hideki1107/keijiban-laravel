@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メール認証のお願い') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('メール認証リンクがあなたのメールアドレス宛に送信されました。') }}
                        </div>
                    @endif

                    {{ __('メール認証リンクをクリックして認証をお願いします。') }}
                    {{ __('メールが来ていない場合は') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('こちら') }}</button>
                    </form>
                    {{ __('をクリックすることで再送信されます') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
