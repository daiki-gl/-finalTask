@extends('layouts.login')

@section('content')

<div class="main-box  follow-prof">

@foreach($followUser as $followUser)
<div class="img-box">
        <img src="images/icons/{{ $followUser->images }}" alt="" class="prof-img">
    </div>

    <table>
    <tr>
        <td>Name</td>
        <td>　{{ $followUser->username }} </td>
    </tr>
    <tr>
        <td>Bio</td>
        <td class="bio">{!! nl2br(e($followUser->bio )) !!}</td>
        <td></td>
    </tr>
</table>
@if (auth()->user()->isFollowing($followUser->id))
        <form action="/search/{{$followUser->id}}/unfollow" method="POST" class="prof-follow">
        @csrf
            <input type="submit" value="フォローをはずす" class="btn follows-btn un_follow">
        </form>
        @else
        <form action="/search/{{$followUser->id}}/follow" method="POST" class="prof-follow">
        @csrf
            <input type="submit" value="フォローする" class="btn follows-btn">
        </form>
@endif
</div>


@endforeach




<div class="post-container">
    <ul class="post-list">
                @foreach ($list as $list)
                <li class="post-item">
                <div class="img-box">
                    <img class="prof-img" src="/images/icons/{{ $list->user->images }}" alt="">
                </div>

            <div class="post-prof-box">
                <div class="name-post">
                    <span class="post-name">{{ $list->user->username }}</span>
                    <p style="font-weight: bold; font-size: 24px;">{!! nl2br(e($list->post )) !!}</p>
                </div>

                <div class="date-btns date">
                    <span class="post-date">{{ date( 'Y-m-d h:s',strtotime($list->created_at)) }}</span>
                </div>
            </div>
                </li>
                @endforeach
            </ul>
</div>
@endsection