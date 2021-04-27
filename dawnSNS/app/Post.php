<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['post'];
    // ユーザー名取得用 りれーしょん
    public function user()
{
    return $this->belongsTo('App\User', 'user_id', 'id');
}

public function getTimeLines(Int $user_id, Array $follow_ids)
    {
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate();
    }

}
