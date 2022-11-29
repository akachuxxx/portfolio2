@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')


    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-scondary">
            <tr>
                <th></th>
                <th></th>
                <th>Category</th>
                <th>Owner</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>


        <tbody class="fw-bold">
            @foreach ($all_posts as $post)
            <tr>
                <td>
                    {{ $post->id }}
                </td>
                <td>
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="thumbnail"
                            style="width: 100px; height: 100px;">
                    </a>
                </td>
                <td>
                    @foreach ($post->categoryPost as $category_post)
                        <div class="badge bg-secondary bg-opacity-50">
                            {{ $category_post->category->name }}
                        </div>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('profile.show', $post->id) }}"
                        class="text-decoration-none text-primary fw-bold">{{ $post->user->name }}</a>
                </td>
                <td>
                    {{ $post->created_at->toFormattedDateString() }}
                </td>
                <td>
                    @if ($post->trashed())
                        <i class="fa-regular fa-circle text-muted"></i>&nbsp;Hidden
                    @else
                        <i class="fa-regular fa-circle text-primary"></i>&nbsp; <span class="text-muted"> Visible</span>
                    @endif
                </td>
                <td>
                    @if (Auth::user()->id !== $post->user->id)
                    <div class="dropdown">
                        <button class="btn btn-sm" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>

                        @if($post->trashed())
                        <div class="dropdown-menu">
                            <button class="dropdown-item text-primary" data-bs-toggle="modal"
                                data-bs-target="#activate-post-{{ $post->id }}">
                                <i class="fa-solid fa-eye"> Visible </i>
                            </button>
                        @else
                            <div class="dropdown-menu">
                                <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                    data-bs-target="#deactivate-post-{{ $post->id }}">
                                    <i class="fa-solid fa-eye-slash"> Hidden </i>
                                </button>
                            </div>
                    @endif
                    </div>
                    @include('admin.posts.modal.status')
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $all_posts->Links() }}

@endsection
