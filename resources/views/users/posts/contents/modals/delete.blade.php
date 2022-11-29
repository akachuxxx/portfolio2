<div class="modal fade" id="delete-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>Delete Post
                </h3>
            </div>
            <div class="madal-body px-2">
                <p>Are you sure you want to delete this post?</p>
                <div class="mt-3">
                    <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->image}}" class="image-lg img-thumbnail">
                    <p class="mt-1 text-muted">{{ $post->description}}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('post.destroy',$post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" data-bs-dismiss="modal" class="btn btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
