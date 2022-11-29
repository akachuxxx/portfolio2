{{-- Deactivate --}}
<div class="modal fade" id="deactivate-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-user-slash"></i> Deactivate User
                </h3>
            </div>
            <div class="modal-body">
                Are you sure want to deactivate <span class="fw-bold">{{ $user->name }}</span>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.users.deactivate',$user->id) }}" method="post">
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
<div class="modal fade" id="activate-user-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-user-check"></i> Deactivate User
                </h3>
            </div>
            <div class="modal-body">
                Are you sure want to activate <span class="fw-bold">{{ $user->name }}</span>?
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.users.activate',$user->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cansel</button>
                    <button type="submit"class="btn btn-success btn-sm">Active</button>
                </form>
            </div>
        </div>
    </div>
</div>

