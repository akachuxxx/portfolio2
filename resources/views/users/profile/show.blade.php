@extends('layouts.app')

@section('title', 'Profile')

@section('content')

        @include('users.profile.header')

            <div style="margin-top:100px;">
                @if ($user->posts->isNotEmpty())
                        <div class="row mt-3">
                            @foreach ($user->posts as $post)
                                <div class="col-lg-4 col-md-6 mb-4">
                                        <a href="{{ route('post.show',$post->id) }}">
                                            <img src="{{ asset('/storage/images/' . $post->image) }}" alt="$post->image" class="img-thumbnail" style="width: 300px;height:300px;">
                                        </a>
                                </div>
                            @endforeach
                        </div>
                        @else
                        <h3 class="text-muted text-center">No Posts Yet</h3>
                @endif
            </div>

@endsection
