<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password','images','bio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // ユーザー名取得用 りれーしょん
    public function posts()
{
    return $this->hasMany('App\Post');
}



    public function followUser()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'follow_id');
    }

    public function followerUser()
    {
        return $this->belongsToMany(User::class, 'follows', 'follow_id', 'follower_id');
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->followUser()->where('follow_id', $user_id)->exists();
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followerUser()->where('follower_id', $user_id)->exists();
    }

    public function authorize()
    {
        return true;
    }
}
