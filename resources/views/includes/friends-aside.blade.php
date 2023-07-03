
<div class="friends__aside">
    <ul class="friends__aside-list">
        <li class="friends__aside-item">
            <a href="{{ route('friends') }}" class="friends__aside-link">Мої друзі</a>
        </li>
        <li class="friends__aside-item friends__aside-item-requests flex">
            <a href="{{ route('requests-friends') }}" class="friends__aside-link">Запити в друзі</a>
            @if(Auth::user()->friendsRequestsCount(Auth::user()))
                @if(Auth::user()->friendsRequestsCount(Auth::user()) >= 10)
                    <span class="friends__requests-info">9+</span>
                @else
                    <span class="friends__requests-info">{{ Auth::user()->friendsRequestsCount(Auth::user()) }}</span>
                @endif
            @endif
        </li>
        <li class="friends__aside-item">
            <a href="{{ route('search-results') }}" class="friends__aside-link">Пошук друзів</a>
        </li>
        <li class="friends__aside-item friends__aside-item-requests flex">
            <a href="{{ route('events-invites') }}" class="friends__aside-link">Запрошення на події</a>
            @if(\App\Models\EventsInvites::with('user')->where('friend_id', $user->id)->count())
                @if(\App\Models\EventsInvites::with('user')->where('friend_id', $user->id)->count() >= 10)
                    <span class="friends__requests-info">9+</span>
                @else
                    <span class="friends__requests-info">{{ \App\Models\EventsInvites::with('user')->where('friend_id', $user->id)->count() }}</span>
                @endif
            @endif
        </li>
    </ul>
</div>
