@extends('layouts.app')

@section('title', 'Create post')

@section('content')

    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="category" class="fw-bold form-label d-block">
                Category <span class="text-muted fw-normal">(Up to 3)</span>
            </label>
            @foreach ($all_categories as $category)
                <div class="form-check form-check-inline mb-3">
                    <input type="checkbox" name="category[]" class="form-check-input" id="{{ $category->name }}"
                        value="{{ $category->id }}">
                    <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                </div>
            @endforeach
            @error('category')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control" placeholder="What's on your mind">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-4">
            <label for="image" class="form-label fw-bold text-dark">Image</label>
            <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
            <div class="form-text text-secondary" id="image-info">
                Acceptable fomats:jpeg,jpg,png,gif only
                <br>Max file size is 1048kb
            </div>
            @error('image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>




        <button type="submit" class="btn btn-primary mt-3 px-5" >Post</button>
    </form>


@endsection
