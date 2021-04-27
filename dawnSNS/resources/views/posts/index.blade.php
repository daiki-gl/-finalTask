@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/create']) !!}
<div class="main-box">

    <div class="form-group">
    @foreach($userImage as $userImage)
        <img class="prof-img" src="images/icons/{{ $userImage->images }}" alt="">
    @endforeach
        {!! Form::textarea('textareaRemarks', null, ['required', 'class' => 'form-post', 'placeholder' => '何をつぶやこうか...？']) !!}
        <button type="submit" class="post-btn" name="post" cols="50" rows="8"><img src="images/post.png"></button>
    </div>
</div>
 {!! Form::close() !!}

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
                <p>{!! nl2br(e($list->post )) !!}</p>
                </div>

                <div class="date-btns">
                <span class="post-date">{{ date( 'Y-m-d h:s',strtotime($list->created_at)) }}</span>
                @if( ( $list->user_id ) === ( Auth::user()->id ) )
                <div class="btns">
                    
                    <a href="" id="js-modal-open" data-target="{{ $list->id }}" class="modal-btn"><img src="images/edit.png" alt=""></a>
                    <a class="delete-btn" href="/{{$list->id}}/delete" onclick="return confirm('削除してもよろしいですか？')"><img src="images/trash.png"></a>
                </div>
                </div>
                <a href="" id="js-modal-close"></a>
                <div id="{{ $list->id }}" class="modal-container">
                    <div class="modal-content">

                    {!! Form::open(['url' => "$list->id/update"]) !!}
                        <div class="modal-form">
                        <textarea required class="form-post" name="update" cols="50" rows="10">{{ $list->post}} </textarea>
                    </div>
                    <button class="" type="submit"><img src="images/edit.png" alt=""></button>
                        {!! Form::close() !!}
                    </div>
                </div>
                @endif

                </div>
                </li>
                @endforeach
            </ul>
 </div>

@endsection