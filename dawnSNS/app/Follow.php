<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Follow extends Model
{
    protected $table = 'follows';
    
    protected $fillable = [
        'follow_id',
        'follower_id'
    ];

    // リレーションシップ
    public function user() {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }
    
    public function followIds(Int $user_id)
    {
        return $this->where('follow_id', $user_id)->get();
    }
}
