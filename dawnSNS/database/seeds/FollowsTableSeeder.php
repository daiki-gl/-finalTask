<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $following_data = [
            ['follow_id' => 1, 'follower_id' => 3], // ID: 1は ID: 3をフォローしてる
            ['follow_id' => 2, 'follower_id' => 3], // ID: 2も ID: 3をフォローしてる
            ['follow_id' => 3, 'follower_id' => 1], // ID: 3は ID: 1をフォローしてる
        ];
        //
        foreach($following_data as $following_values) {
            $following = new \App\Follow();
            $following->user_id = $following_values['user_id'];
            $following->following_user_id = $following_values['following_user_id'];
            $following->save();
        }
    }
}
