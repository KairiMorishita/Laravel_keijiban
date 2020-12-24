<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'image_path',
        'photo_id',
    ];

    // リレーションシップ - photoテーブル
    public function photo()
    {
        return $this->hasOne('App\Photo','id','photo_id');
    }

    // リレーションシップ - userテーブル
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
