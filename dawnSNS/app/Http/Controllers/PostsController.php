<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Follow;

class PostsController extends Controller
{
    //
    public function index(){
        if(Auth::check()){
            return view('posts.index');
        }
        return redirect('/login');
    }

    // 投稿
    public function create(Request $request)
    {
        $id = Auth::id();
        $post = $request->input('textareaRemarks');
        \DB::table('posts')->insert([
            'user_id' => $id,
            'post' => $post
        ]);
        return redirect('/top');
    }

    // 投稿表示
    // public function read()
    // {
        // $list = \DB::table('posts')->get();
        // $list = Post::All();
    //     return view('posts.index',['list'=>$list]);
    // }

    //　投稿削除
    public function delete($id)
    {
        \DB::table('posts')
            ->where('id', $id)
            ->delete();
        return redirect('/top');
    }

    // 投稿更新
    public function update(Request $request)
{
    $post = $request->input('update');
    $article = Post::find($request->id);
    $article->post = $post;
    $article->save();
    return redirect('/top');
}

// フォローユーザーと自分の投稿
public function read() {
    if(Auth::check()){
        $list = Post::query()->whereIn('user_id', Auth::user()->followUser()->pluck('follow_id'))->orWhere('user_id', Auth::user()->id)->latest()->get();
        return view('posts.index',['list'=>$list]);
    } 
    return redirect('/login');
}

// フォローユーザーの投稿
public function readFollow() {
    if(Auth::check()){
        // フォロ-中の投稿
        $list = Post::query()->whereIn('user_id', Auth::user()->followUser()->pluck('follow_id'))->latest()->get();
        // フォロー中の画像・ID
        $followUsers = User::query()->whereIn('id', Auth::user()->followUser()->pluck('follow_id'))->get();
            return view('follows.followList',compact('list', 'followUsers'));
    } 
    return redirect('/follow-list');
}

// フォローユーザーの投稿
public function readFollower(Post $post, Follow $follow)
    {
        if(Auth::check()){
        $user = auth()->user();
        $follow_ids = $follow->followIds($user->id);
        $following_ids = $follow_ids->pluck('follower_id')->toArray();
        $list = $post->getTimelines($user->id, $following_ids);
        // フォロー中の画像・ID
        $followUsers = User::query()->whereIn('id', $following_ids)->get();
        return view('follows.followerList',compact('list', 'followUsers'));
        }
        return redirect('/follower-list');
    }

public function followProf() {
        if(Auth::check()){
            $url = url()->full();
            $url = substr($url, strrpos($url, '?') +1);
            $id = intval($url);

            $followUser = User::query()->where('id', $id)->get();
            $list = Post::query()->where('user_id', $id)->latest()->get();
        return view('users.followProf', compact('followUser','list'));
        } 
        return redirect('/login');
    }

}