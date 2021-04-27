@extends('layouts.login')

@section('content')

<div class="profile-container">
    <div class="img-box">
    @foreach($userImage as $userImage)
        <img class="prof-img" src="images/icons/{{ $userImage->images }}" alt="">
    @endforeach
    </div>
    {!! Form::open(['url' => "/profile/$user->id/update", 'files' => true]) !!}
    <!-- トークンの処理がよく分からん -->
    <table>
        <tr>
            <td>UserName</td>
            <td><input type="text" name="username" value="{{ $user->username}}"></td>
            @error('username')
                <td>
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </td>
            @enderror
        </tr>
        <tr>
            <td>MailAdress</td>
            <td><input type="email" name="mail" value="{{ $user->mail}}"></td>
            @error('mail')
            <td>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </td>
            @enderror
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" value="" placeholder="●●●●●●"></td>
            @error('password')
            <td>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </td>
            @enderror
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="password_confirmation" value="" placeholder="●●●●●●"></td>
            @error('password_confirmation')
            <td>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </td>
            @enderror
        </tr>
        <tr>
            <td>Bio</td>
            <td><textarea name="bio" cols="30" rows="10" placeholder="一言コメント">{{ $user->bio }}</textarea></td>
            @error('bio')
            <td>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </td>
            @enderror
        </tr>
        <tr>
            <td>Icon Image</td>
            <td><label id="js-label">
                {!! Form::input('file','images', null, ['accept' => 'image/*' ,'class' => 'file', 'id' => 'js-file', 'onchange' => 'myFunction()']) !!}</td>
            </label>
            @error('images')
            <td>
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </td>
            @enderror
            </tr>
        </table>
        <button type="submit" class="btn update-btn">更新</button>
        {!! Form::close() !!}

        

</div>


@endsection