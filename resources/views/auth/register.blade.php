@extends('layouts/app')
@section('content')
<div class="container-field bg-success vh-100">
    <div class="title-container text-center">
        <span class="display-4 text-white font-weight-bold">掲示板</span>
        <small class="text-white sub-text">ようこそ</small>
    </div>
    <div class="sign-up-card card card-body py-4 px-5 mx-auto">
        <form action="{{ route('register') }}" method="POST" id="sign_up_form" class="p-3">
            {{ csrf_field() }}
            <div class="form-group user-name-wrapper">
                <label for="name" class="ml-3 mb-0 text-secondary">User name</label>
                <input type="text" class="form-control rounded-pill form-lg" id="name" name="user_name" placeholder="ユーザー名">
                @if ($errors->has('user_name'))
                    <span class="error-msg ml-3 text-danger font-weight-bold">
                        <strong>{{ $errors->first('user_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group email-wrapper">
                <label for="email" class="ml-3 mb-0 text-secondary">e-mail</label>
                <input type="email" class="form-control rounded-pill form-lg" id="email" name="email" placeholder="メールアドレス" value="">
                @if ($errors->has('email'))
                    <span class="error-msg ml-3 text-danger font-weight-bold">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group password-wrapper">
                <label for="password" class="ml-3 mb-0 text-secondary">Password</label>
                <input type="password" class="form-control rounded-pill form-lg" id="password" name="password" placeholder="パスワード">
                @if ($errors->has('password'))
                    <span class="error-msg ml-3 text-danger font-weight-bold">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group agree-wrapper form-check ml-3 mb-4">
                <input type="checkbox" class="form-check-input" id="agree" name="agree">
                <label class="form-check-label text-success" for="agree">利用規約に同意する</label>
                <br>
                @if ($errors->has('agree'))
                    <span class="error-msg ml-3 text-danger font-weight-bold">
                        <strong>{{ $errors->first('agree') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" id="sign_up_submit" name="submit" class="btn bg-brown text-white w-100">新規登録</button>
        </form>
    </div>
</div>
@endsection
