@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}
@error('username')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
@enderror

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
@error('mail')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
@enderror

{{ Form::label('パスワード') }}
{{ Form::password('password',null,['class' => 'input']) }}
@error('password')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
@enderror

{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}
@error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
@enderror

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}

@endsection
