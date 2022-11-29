@extends('layouts.app')

@section('title','Edit')

@section('content')
<form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')


    <div class="mb-3">
        <label for="category" class="fw-bold form-label d-block">
            Category <span class="text-muted fw-normal">(Up to 3)</span>
        </label>
        @foreach ($all_categories as $category)

        @if(in_array($category->id, $selected_categories))
            <div class="form-check form-check-inline mb-3">
                <input type="checkbox" name="category[]" class="form-check-input" id="{{ $category->name }}" value="{{ $category->id }}" checked>
                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
            </div>
         @else
             <div class="form-check form-check-inline mb-3">
                <input type="checkbox" name="category[]" class="form-check-input" id="{{ $category->name }}" value="{{ $category->id }}">
                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
            </div>
        @endif

        @endforeach

        @error('category')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label fw-bold">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control" placeholder="What's on your mind">{{ old('description',$post->description) }}</textarea>
        @error('description')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-4">

        <img src="{{ asset('/storage/images/'.$post->image) }}" alt="{{ $post->image }}" style="height: 300px;width:300px;" class="img-thumbnail mb-2">
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




    <button type="submit" class="btn btn-primary mt-3 px-5" >Edit</button>
</form>


@endsection
