@extends('layouts.app')

@section('title', 'Show post')

@section('content')
    <div class="row border shadow">
        <div class="col p-0 border-end">
            <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4 px-0 bg-white">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="#">
                                @if ($post->user->avatar)
                                    <img src="{{ asset('/storage/avatar/' . $post->user->avatar) }}" alt="{{ $post->user->avatar }}" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0">
                            <a href="#" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                        </div>
                        <div class="col-auto">
                            <div class="dropdown">
                                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                {{-- If you are the OWNER OF THE POST, you can Edit or Delete this post. --}}
                                @if (Auth::user()->id == $post->user_id)
                                    <div class="dropdown-menu">
                                        <a href="{{ route('post.edit',$post->id) }}" class="dropdown-item">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </a>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete-post-{{ $post->id }}">
                                            <i class="fa-regular fa-trash-can"></i> Delete
                                        </button>
                                    </div>
                                    @include('users.posts.contents.modals.delete')
                                @else
                                    {{-- If you are NOT THE OWNER OF THE POST, show an Unfollow button. To be discussed soon. --}}
                                    <div class="dropdown-menu">
                                        <form action="#" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body w-100">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            {{-- like button --}}
                            <form action="{{ route('like.store') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm shadow-none p-0">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-auto px-0">
                            {{-- like counter --}}
                            <span>3</span>
                        </div>
                        <div class="col text-end">
                            {{-- categories seletected --}}
                            @foreach ($post->categoryPost as $category_post)
                                <div class="badge bg-secondary bg-opacity-50">
                                    {{ $category_post->category->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- description of the post and date --}}
                    <a href="#" class="text-decoration-none text-dark">
                        {{ $post->user->name }}
                    </a> &nbsp;
                    <p class="d-inline fw-light">{{ $post->description }}</p>
                    <p class="text-muted xsmall">{{ $post->created_at->diffForHumans() }}</p>
                    {{-- comments here --}}
                    @if ($post->comments->isNotEmpty())
                    <div class="list-group">
                        @foreach ($post->comments as $comment)
                            <div class="list-group-item border-0">
                                <a href="#" class="text-decoration-none text-dark"> {{ $comment->user->name }}</a>
                                &nbsp;
                                <span class="fw-light">{{ $comment->body }}</span>

                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div>
                                        <span class="text-muted xsmall">{{ $comment->created_at->diffForHumans() }}</span>
                                        &middot;
                                        @if ($comment->user_id === Auth::user()->id)
                                            <button type="submit" class="btn btn-link text-decoration-none text-danger"
                                                title="Delete comment">Delete</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('comment.store') }}" method="post">
                    @csrf

                    <div class="input-group mt-2">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea name="body" id="" rows="1" class="form-control" placeholder="Add a commnet"></textarea>

                        <button class="btn btn-outline-secondary" type="submit" id="comment">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
