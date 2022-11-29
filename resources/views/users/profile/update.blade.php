@extends('layouts.app')

@section('title','Update Profile')

@section('content')

<div class="justify-content-center">

        <div class="col-8">
            <form action="{{ route('profile.update',$user->id)}}" method="post" class="bg--white shadow rouded-3 p-5" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <h2 class="h3 mb-3 fw-light text-muted">Update Profile</h2>
                <div class="row mb-3">
                    <div class="col-auto">
                    @if ($user->avatar)
                        <img src="{{ asset('/storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}" class="rounded-circle avatar-lg">
                    @else
                        <i class="fa-solid fa-circle-user text-muted icon-lg"></i>
                    @endif
                    </div>
                    <div class="col-auto align-self-end">
                        <input type="file" name="avatar" id="avatar" class="form-control mt-5" aria-describedby="avatar-info">
                        <div class="form-text text-secondary" id="avatar-info">
                        Acceptable fomats:jpeg,jpg,png,gif only
                        <br>Max file size is 1048kb
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label" >Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name',$user->name)}}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email',$user->email) }}">
                </div>
                <div class="mb-3">
                    <label for="introduction" class="form-label">Introduction</label>
                    <textarea name="introduction" id="introduction" rows="5" class="form-control" placeholder="Describe yourself">{{ old('introduction',$user->introduction)}}</textarea>
                </div>
                <button type="submit" class="btn btn-warning px-5 mt-3">Submit</button>
            </form>
        </div>

</div>

@endsection
