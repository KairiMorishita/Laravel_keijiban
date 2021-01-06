@extends('layouts/app')
@section('content')
<div class="container-field bg-success vh-100">
    <div class="title-container text-center">
        <span class="display-4 text-white font-weight-bold">掲示板</span>
        <small class="text-white sub-text">ログインしてください</small>
    </div>
    <div class="sign-up-card card card-body pt-4 pb-5 px-5 mx-auto">
        <form action="{{ route('login') }}" method="POST" id="login_form" class="p-3">
            {{ csrf_field() }}
            <div class="form-group email-wrapper">
                <label for="email" class="ml-3 mb-0 text-secondary">e-mail</label>
                <input type="email" class="form-control rounded-pill form-lg" id="email" name="email" placeholder="メールアドレス" value="">
                @if ($errors->has('email'))
                    <span class="error-msg ml-3 text-danger font-weight-bold">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group password-wrapper mb-5">
                <label for="password" class="ml-3 mb-0 text-secondary">Password</label>
                <input type="password" class="form-control rounded-pill form-lg" id="password"name="password" placeholder="パスワード">
                @if ($errors->has('password'))
                    <span class="error-msg ml-3 text-danger font-weight-bold">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" name="submit" class="btn bg-brown  w-100 mb-4">ログイン</button>
            <button type="button" onclick="location.href='/register'" name="sign_up_btn" class="btn bg-brown  w-100">新規登録</button>
        </form>
    </div>
</div>
@endsection
