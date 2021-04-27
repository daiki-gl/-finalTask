<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function counts() {
        $user = Auth::id();
        $count_followings = $user->followUser()->count();
        $count_followers = $user->followerUser()->count();
        
        // return [
        //     'count_followings' => $count_followings,
        //     'count_followers' => $count_followers,
        // ], 
        var_dump($count_followers);
    }
}
