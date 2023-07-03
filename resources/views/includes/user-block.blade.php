<div class="user__block flex">
    <div class="user__block-avatar">
        <a href="{{ route('profile', ['user_id' => $user_block->id]) }}">
            <img src="{{ $user_block->avatar }}" alt="avatar" class="user__block-img">
        </a>
    </div>
    <div class="user__block-info">
        <a href="{{ route('profile', ['user_id' => $user_block->id]) }}">
            <div class="user__block-text">
                <p class="user__block-main">{{ $user_block->name }} {{ $user_block->surname }}</p>
                <p class="user__block-second">{{ $user_block->email }}</p>
            </div>
            <div class="user__block-button">
                @if(\Illuminate\Support\Facades\Auth::user()->hasFriendRequestReceived($user_block))
                    <a href="{{ route('friend-accept', ['user_id' => $user_block->id]) }}"
                       class="accepted__button accepted__button-block">Підтвердити запит</a>
                @endif
            </div>
        </a>
    </div>
</div>
