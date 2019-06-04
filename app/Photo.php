<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Log;

class Photo extends Model
{
    /** JSONに含める属性 */
    protected $appends = [
      'url',
    ];

    /** JSONに含める属性 */
    protected $visible = [
    'id',
    'owner',
    'url',
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
 * アクセサ - url
 * @return string
 */
    public function getUrlAttribute()
    {
        Log::error(Storage::url($this->attributes['filename']));
        return Storage::url($this->attributes['filename']);
    }
}
