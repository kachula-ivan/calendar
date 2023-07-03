<header class="header">
    <div class="@auth header__container header__container-about @endauth container">
        <a href="{{ route('index') }}" class="header__logo-full-link">
            <img class="header__logo-full" src="{{ asset('img/full_logo.svg') }}" alt="logo">
        </a>
        @auth
            <div class="header__user-avatar">
                <nav class="menu hide">
                    <div class="menu__title">
                        <div class="menu__avatar header__user-avatar">
                            <img src="{{ $user->avatar }}" alt="avatar"
                                 class="user__avatar-image user__avatar-image-header">
                        </div>
                        <div class="menu__data">
                            <span class="menu__data-name">{{ $user->surname }} {{ $user->name }}</span>
                            <span class="menu__data-email">{{ $user->email }}</span>
                        </div>
                    </div>
                    <hr class="menu__line">
                    <ul class="menu__list">
                        <li class="menu__item">
                            <a class="menu__link" href="#">
                                <span>Видалити аккаунт</span>
                                <svg class="edit__img-button edit__img-button-trash">
                                    <use xlink:href="{{ asset('img/icons.svg#trash') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="menu__item">
                            <a class="menu__link" href="{{route('login')}}">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <a class="menu__link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); this.closest('form').submit()">Вихід
                                        <svg class="edit__img-button">
                                            <use xlink:href="{{ asset('img/icons.svg#exit') }}"></use>
                                        </svg>
                                    </a>
                                </form>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endauth
    </div>
</header>
