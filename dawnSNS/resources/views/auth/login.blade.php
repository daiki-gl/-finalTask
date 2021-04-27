@extends('layouts.logout')

@section('content')

    {!! Form::open() !!}
    
    <p>DAWNSNSへようこそ</p>
    
    {{ Form::label('メールアドレス') }}
    {{ Form::text('mail',null,['class' => 'input']) }}
    {{ Form::label('パスワード') }}
    {{ Form::password('password',['class' => 'input']) }}
    
    {{ Form::submit('ログイン') }}
    
    <p><a href="/register">新規ユーザーの方はこちら</a></p>
    
    {!! Form::close() !!}
    
    @endsection
