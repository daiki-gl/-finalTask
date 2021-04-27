<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    //
    public function profile(){
        if(Auth::check()){
            return view('users.profile');
        }
        return redirect('/login');
    }

    // ユーザー取得
    public function allUser() {
        // ->simplePaginate(15) を ->get()の代わりに入れられる
        $users = User::where("id" , "!=" , Auth::user()->id)->get();
        $search_word = null;
        return view('users.search', compact('users', 'search_word'));
    }
    
    //   検索
    public function searchKeyword(Request $request) {
        $keyword_name = $request->input('name');
        if(!empty($keyword_name)) {
            $search_word = "検索ワード : ".$keyword_name;
            $query = User::query();
            // ->simplePaginate(15) を ->get()の代わりに入れられる
            $users = $query->where('username','like', '%' .$keyword_name. '%')
            ->where("id" , "!=" , Auth::user()->id)->get();
        return view('users.search',compact('users','keyword_name','search_word'));
        } else {
        return view('users.search')->with('message',$message);
        }
    }

    // ログインユーザー情報
    public function loginUser() {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }


    // プロフ編集
    public function profUpdate(Request $request, $id)
    {
    // バリデーションルール
      $request->validate([
            'username'  => 'string|min:4|max:12',
            'mail' =>  'string|email|max:255|min:4|unique:users,mail,'.$request->id.',id',
            'bio' => 'max:200',
            'images' => 'image',
            // 'images' => 'image|alpha_num|alpha_dash', |regex:/[A-Za-z0-9+.+_+]/
        ]);
    
    $auth = User::find($id);
    // // フォームトークン削除
    unset($request['_token']);
    // nullの場合更新対象から除外する
    foreach ($request as $key => $value) {
        if($value == null) {
            unset($request[$key]);
        }
    }

    //ファイルが送信されたか確認
if($request->hasFile('images')){
    //アップロードに成功しているか確認
    if($request->file('images')->isValid()){
      $path = $request->file('images')->store('public/images/icons');
      $auth->images = basename($path);

      // 拡張子つきでファイル名を取得
      $imageName = $request->file('images')->getClientOriginalName();
      // 拡張子のみ
      $extension = $request->file('images')->getClientOriginalExtension();
      // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
      $newImageName = pathinfo($imageName, PATHINFO_FILENAME). uniqid() . "." . $extension;
      $request->file('images')->move(public_path() . "/images/icons", $newImageName);
      $image = "/images/icons/" . $newImageName;
    }

    // ハッシュ化
    if (isset($request['password']) && !$request['password'] == $request['confirm']) {

        // pass validation
        $request->validate([
            'password' => 'required|string|max:255|min:4|unique:users,password,'.$request->id.',id|confirmed|alpha_num',
            'password_confirmation' => 'required|string|max:255|min:4|same:password|alpha_num',
            ]);

        $request['password'] = bcrypt($request['password']);

        $auth->username = $request->username;
        $auth->mail = $request->mail;
        $auth->password = $request->password;
        $auth->bio = $request->bio;
        $auth->images = $newImageName;
        $auth->save();
        return redirect('/profile');
    }
    $auth->username = $request->username;
    $auth->mail = $request->mail;
    $request['password'] = $auth->password;
    $auth->bio = $request->bio;
    $auth->images = $newImageName;
    
    $auth->save();
    return redirect('/profile');
    } 
                // ハッシュ化
                if (isset($request['password']) && !$request['password'] == $request['confirm']) {

            // pass validation
            $request->validate([
            'password' => 'required|string|max:255|min:4|unique:users,password,'.$request->id.',id|confirmed|alpha_num',
            'password_confirmation' => 'required|string|max:255|min:4|same:password|alpha_num',
            ]);

                    $request['password'] = bcrypt($request['password']);
                    $auth->fill($request->all())->save();
                    return redirect('/profile');
                } 
                $request['password'] = $auth->password;
                $auth->fill($request->all())->save();
                // var_dump($request['password']);
                return redirect('/profile');
    }


}