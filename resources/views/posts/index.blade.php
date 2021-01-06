@extends('layouts/app')
@section('content')
<div class="container-field bg-success post-container">
<h2 class="text-white text-center py-5">掲示板</h2>

@if (Auth::id())
    <div class="user-info d-flex align-items-center" data-toggle="dropdown" aria-expanded="false">
      <div class="icon-wrapper mr-2">
          <img class="icon rounded-circle bg-white" src="img/icon.jpg" alt="ユーザー画像">
      </div>
      <span class="user-name text-white mr-2"></span>
      <span><i class="arrow fas fa-chevron-down text-white"></i></span>
    </div>
    <ul class="dropdown-menu">
        <li><a href="" class="text-dark dropdown-item" data-toggle="modal" data-target="#logout_modal">ログアウト</a></li>
        <li><a href="" class="text-dark dropdown-item" data-toggle="modal">メニュー１</a></li>
        <li><a href="" class="text-dark dropdown-item" data-toggle="modal">メニュー２</a></li>
    </ul>

    <form method="post" id="post_form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="w-50 mx-auto">
        <div class="form-group post-form mb-3">
        <textarea class="form-control" id="text" name="text" rows="3"></textarea>
        <input type="hidden" name="user_id" value={{Auth::id()}}>
          <div class="image-wrapper">
            <label id="image-post-label" for="image-post">
              <i class="far fa-image"></i>
            </label>
            <input type="file" id="image-post" name="photo" accept="image/*"/>
          </div>
          <img class="preview-cover" src="" alt="" id="image">
        </div>
        <div class="d-flex justify-content-end">
        <button type="submit" id="post_btn_submit" name="submit" class="btn bg-brown text-white mb-3">投稿する</button>
        </div>
    </div>
    </form>
@else
  <div class="signinbtn">
    <a href="{{ route('login') }}" class="btn bg-brown text-white mb-3">ログイン</a>
  </div>
@endif

</div>
<div class="container-field my-5">
@foreach($posts as $post)
<div class="d-flex align-items-center w-50 mx-auto mt-3">
    <div class="icon-wrapper mr-4">
    <img class="icon rounded-circle bg-white" src="{{ asset('/img/icon.png') }}" alt="ユーザー画像">
    </div>
    <div class="card card-body pt-4 pb-3">
    <p>{{ $post->text }}</p>
    @if ($post->image_path)
        <div class="image">
            <img src="{{ $post->image_path }}" width="200px" height="200px">
        </div>
    @endif
    <div class="d-flex justify-content-between mt-3">
        <div class="d-flex">
        <p class="mr-1">{{ $post->user->name }}</p>
        <p>{{ date('Y年m月d日 H:i', strtotime($post->updated_at)) }}</p>
        </div>
        @if ($post->user_id === Auth::id())
        <div class="d-flex">
            <a href="" class="text-dark" data-toggle="modal" data-target="#edit_modal"
                data-id="{{ $post->id }}"
                data-text="{{ $post->text }}">編集</a>
            <a href="" class="text-dark ml-3" data-toggle="modal" data-target="#delete_modal"
                data-id="{{ $post->id }}">削除</a>
        </div>
        @endif
    </div>
    </div>
</div>
@endforeach
</div>

<!-- ログアウトモーダル -->
<div class="modal fade" id="logout_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{ route('logout') }}" method="POST" id="logout_form">
      {{ csrf_field() }}
        <div class="modal-body text-center p-4">
          <p class="pb-2">ログアウトしてよろしいですか？</p>
          <div class="d-flex justify-content-center mt-4">
            <button type="submit" name="submit" class="btn bg-brown text-white mr-4">はい</button>
            <button type="button" class="btn bg-gray text-white"  data-dismiss="modal">いいえ</button>
          </div>
        </div><!-- /.modal-body -->
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 削除モーダル -->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="" method="post" id="delete_form">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-body text-center p-4">
          <p class="pb-2">削除してよろしいですか？</p>
          <div class="d-flex justify-content-center mt-4">
            <button type="submit" name="submit" class="btn bg-brown text-white mr-4">はい</button>
            <button type="button" class="btn bg-gray text-white" data-dismiss="modal">いいえ</button>
          </div>
        </div><!-- /.modal-body -->
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 編集モーダル -->
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="" method="post" id="edit_form">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-header">
          <h5 class="modal-title">投稿編集</h5>
        </div><!-- /.modal-header -->
        <div class="modal-body">
          <textarea class="edit-text form-control" id="edit_text" name="text" rows="8"></textarea>
        </div><!-- /.modal-body -->
        <div class="modal-footer">
          <button type="button" class="btn bg-gray" data-dismiss="modal">キャンセル</button>
          <button type="submit" id="edit_btn_submit" name="submit" class="btn bg-brown">保存</button>
        </div><!-- /.modal-footer -->
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
