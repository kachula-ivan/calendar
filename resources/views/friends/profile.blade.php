@extends('layouts.head')

@section('title'){{ $profile_user->surname }} {{ $profile_user->name }}@endsection

@section('custom-link')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="wrapper">
        @include('includes.header')
        <main class="main">
            <div class="container">
                <section class="user__info">
                    <div class="user__info-header">
                        <h1 class="user__info-title">Інформація особистого кабінету</h1>
                        @if(session('status'))
                            <p class="input__info input__info-verify">
                                <svg class="input__info-img">
                                    <use xlink:href="{{ asset('img/icons.svg#info') }}"></use>
                                </svg>
                                <span class="input__info-text">{{ session('status') }}</span>
                            </p>
                        @endif
                        <div class="user__avatar">
                            <img src="{{ $profile_user->avatar }}" alt="avatar" class="user__avatar-image">
                        </div>
                        <div class="user__name">
                            {{ $profile_user->surname }} {{ $profile_user->name }} ID: {{ $profile_user->id }}
                            @if($profile_user->telegram_id)
                                <div class="flex">
                                    <svg class="user__name-tg">
                                        <use xlink:href='{{ asset('img/icons.svg#telegram-logo')}}'></use>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        @if( \Illuminate\Support\Facades\Auth::user()->hasFriendRequestPending($profile_user) )
                            <p class="request__friend-info">Запит на дружбу відправлено</p>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->hasFriendRequestReceived($profile_user))
                            <a href="{{ route('friend-accept', ['user_id' => $profile_user->id]) }}"
                               class="accepted__button">Підтвердити запит</a>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->isFriendWith($profile_user))
                            <button type="button" class="accepted__button" data-bs-toggle="modal" data-bs-target="#form">
                                Спільна подія
                            </button>
                            <form action="{{ route('friend-delete', ['user_id' => $profile_user->id]) }}" method="post">
                                @csrf
                                <input type="submit" class="accepted__button accepted__button-delete" value="Видалити із друзів">
                            </form>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->id !== $profile_user->id)
                            <a href="{{ route('friend-add', ['user_id' => $profile_user->id]) }}" class="accepted__button">Додати
                                в друзі</a>
                        @endif
                    </div>
                    <div class="user__info-body">
                        <ul class="info__list">
                            <li class="info__item">
                                <h3 class="info__item-title">Персональні дані</h3>
                                <ul class="info__item-list">
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">Ім'я прізвище:</h4>
                                        <span
                                            class="info__item-item-text">{{ $profile_user->name }} {{ $profile_user->surname }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">ID:</h4>
                                        <span class="info__item-item-text">{{ $profile_user->id }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">Стать:</h4>
                                        <span
                                            class="info__item-item-text">{{ $profile_user->gender ? $profile_user->gender : '--' }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">Дата народження</h4>
                                        <span class="info__item-item-text">{{ $profile_user->birthday ? $profile_user->birthday : 'дд.мм.рррр' }}
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
                                            class="info__item-item-text">{{ $profile_user->phone ? $profile_user->phone : '--' }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">E-mail</h4>
                                        <span class="info__item-item-text">{{ $profile_user->email }}</span>
                                    </li>
                                    <li class="info__item-item">
                                        <h4 class="info__item-item-title">Місто</h4>
                                        <span
                                            class="info__item-item-text">{{ $profile_user->address ? $profile_user->address : '--' }}</span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <div class="modal fade edit-form" id="form" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog invite-form" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="modal-title">Додати спільну подію</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="myForm">
                    <div class="modal-body">
                        <div class="auth__input-error" role="alert" id="danger-alert" style="display: none;">
                            Кінцева дата повина бути пізніше від початкової!
                        </div>
                        <span id="titleError" class="auth__input-error"></span>
                        <div class="form-group">
                            <label for="event-title" class="user__input-title">Назва
                                <input type="text" class="form-control user__edit-input auth__input-field"
                                       id="event-title"
                                       placeholder="Enter event name" required>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="start-date" class="user__input-title">Початкова дата
                                <input type="date"
                                       class="form-control user__edit-input auth__input-field auth__input-field-date"
                                       id="start-date-edit"
                                       placeholder="start-date" required>
                                <input type="time" class="form-control user__edit-input auth__input-field"
                                       id="start-time-edit"
                                       placeholder="start-time">
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="end-date" class="user__input-title">Кінцева дата
                                <input type="date"
                                       class="form-control user__edit-input auth__input-field auth__input-field-date"
                                       id="end-date-edit"
                                       placeholder="end-date">
                                <input type="time" class="form-control user__edit-input auth__input-field"
                                       id="end-time-edit"
                                       placeholder="end-time">
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="color" class="user__input-title user__input-color">Колір
                                @foreach($colors as $color)
                                    <div class="form-check form-check-color">
                                        <input type="radio" name="color-edit" value="{{ $color->id }}" id="{{ $color->color }}" class="color__edit-check" @if($color->id === 6) checked @endif>
                                        <label for="{{ $color->color }}" class="form-check-label radio__color radio__color-{{ $color->title }}"></label>
                                    </div>
                                @endforeach
                                @error('color')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="group" class="user__input-title">Група
                                @foreach($groups as $group)
                                    <div class="form-check">
                                        <input type="radio" name="group-edit" value="{{ $group->id }}" id="{{ $group->color }}" class="group__edit-check" @if($group->id === 1) checked @endif>
                                        <label for="{{ $group->color }}" class="form-check-label">{{ $group->title }}</label>
                                    </div>
                                @endforeach
                                @error('group')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary btn__close" id="cancel-button">Закрити</button>
                        <button type="submit" class="btn btn-primary btn__add-event" id="submit-button">Додати подію</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.info-message')
    @include('includes.footer')
@endsection

@section('custom-script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @include('includes.event-invite')
@endsection
