<div class="mt-3">

    @if ($post->comments->isNotEmpty())
        <div class="list-group">
            @foreach ($post->comments->take(3) as $comment)
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
            @if ($post->comments->count() > 3)
                <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">All view
                    comments({{ $comment->count() }})</a>
            @endif
        </div>
    @endif


    <form action="{{ route('comment.store') }}" method="post">
        @csrf

        <div class="input-group">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <textarea name="body" id="body" rows="1" class="form-control" placeholder="Add a commnet"></textarea>
            @error('body')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-outline-secondary">Save</button>
        </div>
    </form>
</div>
