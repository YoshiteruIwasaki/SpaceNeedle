<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Photo extends Model
{
    /** JSONに含める属性 */
    protected $appends = [
      'url', 'likes_count', 'liked_by_user',
    ];

    /** JSONに含める属性 */
    protected $visible = [
    'id',
    'owner',
    'url',
    'comments',
    'likes_count',
    'liked_by_user',
    ];

    /** JSONに含めない属性 */
    //protected $hidden = [
    //    'user_id',
    //    'filename',
    //    self::CREATED_AT,
    //    self::UPDATED_AT,
    //];

    /**
    * リレーションシップ - usersテーブル
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }

    /**
     * リレーションシップ - commentsテーブル
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    /**
    * リレーションシップ - usersテーブル
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    /**
    * アクセサ - url
    * @return string
    */
    public function getUrlAttribute()
    {
        return Storage::url($this->attributes['filename']);
    }


    /**
    * アクセサ - likes_count
    * @return int
    */
    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    /**
    * アクセサ - liked_by_user
    * @return boolean
    */
    public function getLikedByUserAttribute()
    {
        if (Auth::guest()) {
            return false;
        }

        return $this->likes->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }
}
