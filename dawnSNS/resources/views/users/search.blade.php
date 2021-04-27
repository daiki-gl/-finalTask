@extends('layouts.login')

@section('content')
<div class="main-box search">
{!! Form::open(['url' => '/search']) !!}
    <div class="form-group">
        {!! Form::input('text','name', null, ['required', 'class' => 'search-box', 'placeholder' => 'ユーザー名']) !!}
        <button type="submit" class="search-icon" name="post" cols="50" rows="8"><img src="images/search.png"></button>
        @if(isset($users))
            <p class="keyword">{{ $search_word }} </p>
            @endif
        </div>
        {!! Form::close() !!}
    </div>

    
    <div class="main-content">
        @if(isset($users))
    <ul class="users-list">
        @foreach($users as $user)
        <li class="users-item" style="margin-bottom: 30px;">
        <div class="img-name">
            <div class="img-box">
                <img class="prof-img" src="images/icons/{{ $user->images }}" alt="">
            </div>
            <p class="users-name">{{$user->username}}</p>
        </div>
            
                    <!-- フォローかチェック -->
                    @if (auth()->user()->isFollowing($user->id))
                    <form action="/search/{{$user->id}}/unfollow" method="POST">
                        @csrf
                        <input type="submit" value="フォローをはずす" class="btn follows-btn un_follow">
                    </form>
                    @else
                        <form action="/search/{{$user->id}}/follow" method="POST">
                            @csrf
                            <input type="submit" value="フォローする" class="btn follows-btn">
                        </form>
                    @endif
        </li>
        @endforeach
    </ul>
</table>
@endif



</div>


@endsection