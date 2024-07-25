@extends('layouts.app')

@section('title', $user->username)

@section('content')
    <div class="profile-container">
        <div class="cover-photo"
            style="background: url('{{ $user->cover_photo }}') no-repeat center center; background-size: cover;"></div>
        <a href="#" class="custom-link"><img src="{{ $user->profile_photo }}" alt="Profile" class="profile-pic"></a>
    </div>
    <div class="user-details d-flex justify-content-between align-items-center">
        <div>
            <h2>{{ $user->username }}</h2>
            <p>{{ $user->bio ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}</p>
            @if (!empty($user->email))
                <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            @endif
            @if (!empty($user->phone))
                <p><i class="fas fa-phone"></i> {{ $user->phone }}</p>
            @endif
            @if (!empty($user->website))
                <p><i class="fas fa-globe"></i> <a href="{{ $user->website }}" target="_blank"
                        class="custom-link">{{ $user->website }}</a></p>
            @endif
            @if (!empty($user->company_name))
                <p><i class="fas fa-building"></i> {{ $user->company_name }}</p>
            @endif
        </div>
        <div>
            @if ($user->id == Auth::id())
                <button class="btn btn-dark btn-new-post">New Post</button>
            @else
                <button class="btn btn-dark btn-follow">Follow</button>
            @endif
            <div class="dropdown d-inline-block ml-2">
                <button class="btn btn-link dropdown-toggle" type="button" id="profileDropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v" style="color: #000;"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('edit_profile') }}">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 posts">
            @foreach ($user->posts as $post)
                <div class="post">
                    <div class="post-header d-flex align-items-center">
                        <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="custom-link">
                            <img src="{{ $user->profile_photo }}" alt="Profile">
                        </a>
                        <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="ml-2 custom-link">
                            <h5>{{ $user->username }}</h5>
                        </a>
                        <button class="btn btn-link ml-auto"><i class="fas fa-ellipsis-v" style="color: #000;"></i></button>
                    </div>
                    <div class="post-body">
                        <h6>{{ $post->title }}</h6>
                        <p>{{ $post->body }}</p>
                    </div>
                    <div class="post-footer">
                        <button class="btn btn-light"><i class="far fa-thumbs-up"></i></button>
                        <button class="btn btn-light"><i class="far fa-comment"></i></button>
                        <button class="btn btn-light ml-auto"><i class="far fa-share-square"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            @include('includes.recommended_users')
        </div>
    </div>
@endsection
