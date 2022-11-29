{{-- Deactivate --}}
<div class="modal fade" id="deactivate-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-eye-slash"></i> VISIBLE THIS POST
                </h3>
            </div>
            <div class="modal-body">
                Are you sure want to Hidden this  post <span class="fw-bold">{{ $post->description }}</span>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.posts.deactivate',$post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cansel</button>
                    <button type="submit"class="btn btn-danger btn-sm">Deactive</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- active --}}

{{-- Deactivate --}}
<div class="modal fade" id="activate-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-eye-check"></i> HIDDEN THIS POST
                </h3>
            </div>
            <div class="modal-body">
                Are you sure want to visible <span class="fw-bold">{{ $post->description }}</span>?
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.activate',$post->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cansel</button>
                    <button type="submit"class="btn btn-success btn-sm">Visible</button>
                </form>
            </div>
        </div>
    </div>
</div>

