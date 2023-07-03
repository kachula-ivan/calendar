@extends('layouts.head')

@section('title', 'Особистий кабінет')



@section('content')
    <div class="wrapper">
        @include('includes.header')
        <main class="main">
            <div class="container">
                <section class="user__info">
                    <div class="user__info-header">
                        <h1 class="user__info-title">Інформація особистого кабінету</h1>
                        <div class="user__avatar">
                            <img src="{{ $user->avatar }}" alt="avatar" class="user__avatar-image">
                        </div>
                        <div class="user__name">
                            {{ $user->surname }} {{ $user->name }} ID: {{ $user->id }}
                            @if($user->telegram_id)
                                <a href="https://t.me/Calendar_its_bot" target="_blank" class="flex">
                                    <svg class="user__name-tg">
                                        <use xlink:href='{{ asset('img/icons.svg#telegram-logo')}}'></use>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                    <a class="weatherwidget-io" href="https://forecast7.com/uk/50d7525d33/lutsk/" data-label_1="LUTSK"
                       data-label_2="WEATHER" data-theme="pure">LUTSK WEATHER</a>
                    <div class="user__info-body">
                        <ul class="info__list">
                            <li class="info__item">
                                <h3 class="info__item-title">Персональні дані</h3>
                                <ul class="info__item-list">
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">Ім'я прізвище:</h4>
                                        <span class="info__item-item-text">{{ $user->name }} {{ $user->surname }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">ID:</h4>
                                        <span class="info__item-item-text">{{ $user->id }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">Стать:</h4>
                                        <span
                                            class="info__item-item-text">{{ $user->gender ? $user->gender : '--' }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">Дата народження</h4>
                                        <span class="info__item-item-text">{{ $user->birthday ? $user->birthday : 'дд.мм.рррр' }}
                                            <svg class='info__item-item-img'>
                                                <use
                                                    xlink:href='{{ asset('img/icons.svg#'.app('App\Http\Controllers\Main\UserController')->getZodiacalSign($month, $day)) }}'></use>
                                            </svg>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                            <li class="info__item">
                                <h3 class="info__item-title">Контактна інформація</h3>
                                <ul class="info__item-list">
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">Телефон</h4>
                                        <span
                                            class="info__item-item-text">{{ $user->phone ? $user->phone : '--' }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">E-mail</h4>
                                        <span class="info__item-item-text">{{ $user->email }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">Місто</h4>
                                        <span
                                            class="info__item-item-text">{{ $user->address ? $user->address : '--' }}</span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </main>
    </div>
    @include('includes.footer')
    <script>
        !function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://weatherwidget.io/js/widget.min.js';
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, 'script', 'weatherwidget-io-js');
    </script>
@endsection
