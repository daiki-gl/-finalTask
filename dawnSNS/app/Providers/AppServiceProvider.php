<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\User;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // フォロー数
        View::composer('*', function($count)
        {
        $id = Auth::id();
        $followCount = Follow::query()->where('follower_id', $id)->count();
        $count->with('followCount', $followCount);
        });

        // フォロワー数
        View::composer('*', function($counts)
        {
        $id = Auth::id();
        $followerCount = Follow::query()->where('follow_id', $id)->count();
        $counts->with('followerCount', $followerCount);
        });

        View::composer('*', function($image)
        {
        $id = Auth::id();
        $userImage = User::query()->where('id', $id)->get();
        $image->with('userImage', $userImage);
        });
    }
}
