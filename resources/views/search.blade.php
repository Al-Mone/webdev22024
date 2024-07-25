@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="results-container mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Search Results</h3>
                    <div>
                        <a href="{{ route('search', ['query' => $query, 'type' => 'users']) }}" class="btn btn-dark">Users</a>
                        <a href="{{ route('search', ['query' => $query, 'type' => 'posts']) }}" class="btn btn-dark">Posts</a>
                    </div>
                </div>
                @foreach ($results as $result)
                    <div class="result-item mb-3">
                        @if ($type === 'users')
                            <div class="result-item-header d-flex align-items-center">
                                <a href="{{ route('user.profile', ['id' => $result->id]) }}">
                                    <img src="{{ $result->profile_photo }}" alt="Profile" class="profile-pic-iconified">
                                    <h5 class="ml-2">{{ $result->username }}</h5>
                                </a>
                            </div>
                            <div class="result-item-body">
                                <p>{{ $result->name ?? '' }}</p>
                            </div>
                        @else
                            <div class="result-item-header d-flex align-items-center">
                                <a href="{{ route('user.profile', ['id' => $result->user->id]) }}">
                                    <img src="{{ $result->user->profile_photo }}" alt="Profile"
                                        class="profile-pic-iconified">
                                    <h5 class="ml-2">{{ $result->title }}</h5>
                                </a>
                            </div>
                            <div class="result-item-body">
                                <p>{{ $result->body }}</p>
                            </div>
                            <div class="result-item-footer d-flex align-items-center">
                                <small class="text-muted">Posted by {{ $result->user->username }}</small>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            @include('includes.recommended_users')
        </div>
    </div>
@endsection
