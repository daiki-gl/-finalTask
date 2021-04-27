<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\User;


class FollowsController extends Controller
{
    //
    public function followList(){
        if(Auth::check()){
            return view('follows.followList');
        }
        return redirect('/login');
    }

    public function followerList(){
        if(Auth::check()){
            return view('follows.followerList');
        }
        return redirect('/login');
    }

    // フォローする
    public function follow(Follow $follows, $id)
    {
        $follows = Auth::id();
        $id = intval($id);
        $myself = $follows === $id;

        $follow_data[] = array();
        $follow_data = DB::table('follows')->where('follower_id', $follows)->get();
        $follow_data = DB::table('follows')
                        ->where('follower_id', $follows)
                        ->where('follow_id', $id)
                        ->exists();

        if(!$follow_data && !$myself) {
            \DB::table('follows')->insert([
                'follow_id' => $id,
                'follower_id' => $follows,
                ]);
                return back();
            }
            return back();
            }
            
            // フォロー解除
            public function unfollow(Follow $follows, $id)
            {
                $follows = Auth::id();

                $follow_data[] = array();
                $follow_data = DB::table('follows')->where('follower_id', $follows)->get();
                $follow_data = DB::table('follows')
                        ->where('follower_id', $follows)
                        ->where('follow_id', $id)
                        ->exists();
                
            if($follow_data) {
                \DB::table('follows')
                ->where('follow_id', $id)
                ->where('follower_id', $follows)
                ->delete();
                return back();
            }
            return back();
        }

    
        public function getFollowerCount($user_id)
        {
            return $this->where('follow_id', $user_id)->count();
        }
        

}