@extends('layouts.logout')

@section('content')

<div id="clear">
<p>
{{$data['username']}}
さん、</p>
<p>ようこそ！DAWNSNSへ！</p>
<p>ユーザー登録が完了しました。</p>
<p>さっそく、ログインをしてみましょう。</p>
@if( Auth::check() )
    {{ こんにちは }}
@endif

<p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection