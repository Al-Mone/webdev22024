@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-8 posts">
            <div class="new-post-container mb-4">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <div class="d-flex">
                        <img src="{{ Auth::user()->profile_photo }}" alt="Profile" class="profile-pic-iconified mr-2">
                        <textarea class="form-control" name="body" rows="3" placeholder="What's on your mind?"></textarea>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button type="submit" class="btn btn-dark">Post</button>
                    </div>
                </form>
            </div>
            @foreach ($posts as $post)
                <div class="post mb-3">
                    <div class="post-header d-flex align-items-center">
                        <a href="{{ route('user.profile', ['id' => $post->user_id]) }}">
                            <img src="{{ $post->user->profile_photo }}" alt="Profile">
                        </a>
                        <a href="{{ route('user.profile', ['id' => $post->user_id]) }}"
                            class="ml-2">{{ $post->user->username }}</a>
                        <button class="btn btn-link ml-auto"><i class="fas fa-ellipsis-v" style="color: #000;"></i></button>
                    </div>
                    <div class="post-body">
                        <h6>{{ $post->title }}</h6>
                        <p>{{ $post->body }}</p>
                    </div>
                    <div class="post-footer d-flex justify-content-between">
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
