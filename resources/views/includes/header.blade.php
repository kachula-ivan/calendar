<header class="header">
    <div class="header__container container">
        <div class="header__item header__item-resp">
            <a href="{{ route('index') }}" class="header__logo-full-link">
                <img class="header__logo" src="{{ asset('img/logo.svg') }}" alt="logo">
            </a>
        </div>
        <div class="header__burger">
            <span></span>
        </div>
        <ul class="header__list">
            <li class="header__item">
                <ul class="header__list-link">
                    <li class="header__item-link">
                        <a href="{{ route('index') }}" class="header__link">Головна</a>
                    </li>
                    <li class="header__item-link">
                        <a href="{{ route('dashboard') }}" class="header__link">Календар</a>
                    </li>
                    <li class="header__item-link">
                        <a href="{{ route('about-us') }}" class="header__link">Про нас</a>
                    </li>
                </ul>
            </li>
            <li class="header__item header__logo-resp">
                <a href="{{ route('index') }}" class="header__logo-full-link">
                    <img class="header__logo" src="{{ asset('img/logo.svg') }}" alt="logo">
                </a>
            </li>
            <li class="header__item">
                <ul class="header__list-link">
                    <li class="header__item-link">
                        <a href="{{ route('contacts') }}" class="header__link">Контакти</a>
                    </li>
                    @auth
                        <li class="header__item-link">
                            <div class="header__user-nav">
                                <div class="menu__header-button">
                                    <span class="header__mail">{{ $user->email }}</span>
                                    <svg class='header__user-img'>
                                        <use xlink:href='{{ asset('img/icons.svg#user') }}'></use>
                                    </svg>
                                </div>
                                <nav class="menu menu__header hide">
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
                                            <a class="menu__link" href="{{ route('account') }}">
                                                <span>Мій профіль</span>
                                            </a>
                                        </li>
                                        <li class="menu__item">
                                            <a class="menu__link" href="{{ route('account-update') }}">
                                                <span>Редагувати профіль</span>
                                            </a>
                                        </li>
                                        <li class="menu__item">
                                            <a class="menu__link flex" href="{{ route('friends') }}">
                                                <span>Друзі</span>
                                                @if(Auth::user()->friendsRequestsCount(Auth::user()) || \App\Models\EventsInvites::with('user')->where('friend_id', $user->id)->count())
                                                    <span class="header__friends-info"></span>
                                                @endif
                                            </a>
                                        </li>
                                        <li class="menu__item">
                                            <a class="menu__link" href="{{ route('dashboard') }}">
                                                <span>Календар</span>
                                                <svg class="edit__img-button-calendar">
                                                    <use xlink:href="{{ asset('img/icons.svg#calendar') }}"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="menu__item">
                                            <a class="menu__link" target="_blank" href="https://t.me/Calendar_its_bot">
                                                <span>Телеграм бот</span>
                                                <svg class="edit__img-button-calendar">
                                                    <use xlink:href="{{ asset('img/icons.svg#telegram') }}"></use>
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
                        </li>
                    @endauth

                    @guest
                        <li class="header__item-link">
                            <a href="{{ route('login') }}" class="login__button">Ввійти</a>
                        </li>
                        <li class="header__item-link">
                            <a href="{{ route('register') }}" class="register__button">Зареєструватись</a>
                        </li>
                    @endguest
                </ul>
            </li>
            <div class="waves_resp">
                <div class="wave1"></div>
            </div>
            <div class="waves_resp">
                <div class="wave2"></div>
            </div>
        </ul>
    </div>
</header>
