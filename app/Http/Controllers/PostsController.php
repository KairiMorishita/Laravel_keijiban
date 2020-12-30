<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Post;
use App\Photo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * 一覧表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disk = Storage::disk('s3');
        $files = $disk->files('/');
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts], ['files' => $files]);
    }

    /**
     * 新規投稿処理
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //投稿する際のバリデーションを定義
        $params = $request->validate([
            'text' => 'required|max:50',
            'user_id' => 'required|max:50',
            'photo' => 'nullable|file|image|max:4000',
        ]);

        //投稿時に画像が添付されている場合はS3に画像を保存
        if(array_key_exists("photo", $params)){
                $file = $params['photo'];
                $fileContents = file_get_contents($file->getRealPath());
                $disk = Storage::disk('s3');
                $disk->put($file->hashName(), $fileContents, 'public');
                $params['filename'] = $file->hashName();
                $params['image_path'] = Storage::disk('s3')->url($params['filename']);

                $data =  Photo::create($params);
                $params['photo_id'] = $data->id;
        }
        Post::create($params);
        return redirect('/');
    }

    /**
     * 投稿編集処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	$request->validate([
            'text' => 'required',
        ]);
        $posts = Post::findOrFail($id);
        $posts->text = $request->text;
        $posts->save();
        return redirect('/');
    }

    /**
    * 投稿削除処理
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if(isset($post->photo)){
            $post->photo->delete();
            $disk = Storage::disk('s3');
            $disk->delete($post->photo->filename);
        }
        return redirect("/");
    }

}
