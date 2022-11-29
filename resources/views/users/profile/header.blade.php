<div class="row">
    <div class="col-4">
        {{-- icon image --}}
        @if ($user->avatar)
            <img src=" {{ asset('/storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}"
                class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user d-block text-center text-muted icon-lg "></i>
        @endif
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                {{-- name --}}
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>
            <div class="col-auto p-2">
                {{-- fpllow bbutton --}}
                @if($user->id === Auth::user()->id)
                <a href="{{ route('profile.edit',$user->id) }}" class="btn btn-outline-secondary btn-sm fw-bold">
                    Edit Profie
                </a>
                @else
                <form action="#" method="post">
                    @csrf

                    <button type="submit" class="btn btn-primary btn-sm fw-bbold">Follow</button>
                </form>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="#" class="text-dark text-decoration-none">
                    <strong>{{ $user->posts->count() }}</strong>{{ ($user->posts->count() > 1) ? "posts" : "post" }}
                </a>
            </div>
            <div class="col-auto">
                <a href="#" class="text-dark text-decoration-none">
                    <strong>3</strong> Followers
                </a>
            </div>
            <div class="col-auto">
                <a href="#" class="text-dark text-decoration-none">
                    <strong>3</strong> Following
                </a>
            </div>
        </div>
        <p class="fw-bold">
            {{ $user->introduction }}
        </p>
    </div>
</div>
