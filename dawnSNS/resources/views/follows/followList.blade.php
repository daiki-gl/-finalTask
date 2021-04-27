@extends('layouts.login')

@section('content')
<div class="main-box follow-follower-container">
<h2>Follow List</h2>
    <div class="follow-list-container">
        <ul class="follow-list">
            @foreach ($followUsers as $followUser)
            <li class="follow-item"><a class="prof-link" href="{{ route('follow_profile', $followUser->id)}}"><img src="images/icons/{{ $followUser->images }}" alt="" class="prof-img"></a></li>
            @endforeach
        </ul>
    </div>
</div>


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
