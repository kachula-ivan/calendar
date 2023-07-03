@extends('layouts.head')

@section('title', 'Редагування даних')



@section('content')
    <div class="wrapper">
        @include('includes.header')
        <main class="main">
            <div class="user__info-header user__edit-header">
                <h1 class="user__info-title user__edit-title">Редагування профілю</h1>
            </div>
            <div class="container">
                <section class="user__info user__edit">
                    @if(session('status'))
                        <p class="input__info input__info-edit">
                            <svg class="input__info-img">
                                <use xlink:href="{{ asset('img/icons.svg#info') }}"></use>
                            </svg>
                            <span class="input__info-text">{{ session('status') }}</span>
                        </p>
                    @endif
                    <div class="user__edit-body">
                        <form method="post" action="{{route('account-update')}}" class="user__edit-form" enctype="multipart/form-data">
                            @csrf
                            <div class="edit__info">
                                <h3 class="info__item-title info__item-title-edit">Особотиста інформація</h3>
                                <ul class="user__edit-list">
                                    <li class="user__edit-item">
                                        <label for="name" class="user__input-title">Ім'я
                                            <input name="name" id="name" type="text" required
                                                   class="user__edit-input auth__input-field" value="{{ $user->name }}">
                                            @error('name')
                                            <p class="auth__input-error">{{ $message }}</p>
                                            @enderror
                                        </label>
                                    </li>
                                    <li class="user__edit-item">
                                        <label for="surname" class="user__input-title">Прізвище
                                            <input name="surname" id="surname" type="text" required
                                                   class="user__edit-input auth__input-field"
                                                   value="{{ $user->surname }}">
                                            @error('surname')
                                            <p class="auth__input-error">{{ $message }}</p>
                                            @enderror
                                        </label>
                                    </li>
                                    <li class="user__edit-item">
                                        <label for="gender" class="user__input-title">Стать
                                            <select name="gender" id="gender"
                                                    class="user__edit-input auth__input-field gender__select">
                                                <option value="">--</option>
                                                <option
                                                    value="Чоловік" {{ $user->gender == 'Чоловік' ? 'selected' : '' }}>
                                                    Чоловік
                                                </option>
                                                <option value="Жінка" {{ $user->gender == 'Жінка' ? 'selected' : '' }}>
                                                    Жінка
                                                </option>
                                            </select>

                                            @error('gender')
                                            <p class="auth__input-error">{{ $message }}</p>
                                            @enderror
                                        </label>
                                    </li>
                                    <li class="user__edit-item">
                                        <label for="birthday" class="user__input-title ">Дата народження
                                            <input name="birthday" id="birthday" type="date"
                                                   class="user__edit-input auth__input-field"
                                                   value="{{ $user->birthday ? $user->birthday : 'дд.мм.рррр' }}">
                                            @error('birthday')
                                            <p class="auth__input-error">{{ $message }}</p>
                                            @enderror
                                        </label>
                                    </li>
                                </ul>
                                <h3 class="info__item-title info__item-title-edit">Контактна інформація</h3>
                                <ul class="user__edit-list">
                                    <li class="user__edit-item">
                                        <label for="phone" class="user__input-title">Номер телефону
                                            <input name="phone" id="phone" type="text" required
                                                   class="user__edit-input auth__input-field"
                                                   value="{{ $user->phone ? $user->phone : '--' }}">
                                            @error('phone')
                                            <p class="auth__input-error">{{ $message }}</p>
                                            @enderror
                                        </label>
                                    </li>
                                    <li class="user__edit-item user__edit-item-last">
                                        <label for="address" class="user__input-title">Місто
                                            <input name="address" id="address" type="text" required
                                                   class="user__edit-input auth__input-field"
                                                   value="{{ $user->address ? $user->address : '--' }}">
                                            @error('address')
                                            <p class="auth__input-error">{{ $message }}</p>
                                            @enderror
                                        </label>
                                    </li>
                                    <li class="user__edit-item user__edit-item-last user__edit-item-main">
                                        <a href="{{route('change_email')}}" class="forgot__password user__edit-item-main-text">Змінити пошту</a>
                                        <a href="{{route('change_password')}}" class="forgot__password user__edit-item-main-text">Змінити пароль</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="edit__avatar">
                                <h3 class="info__item-title info__item-title-edit">Фото профілю</h3>
                                <div class="avatar avatar-edit">
                                    <img src="{{ $user->avatar }}" alt="avatar" class="user__avatar-image user__avatar-image-edit">
                                    <label class="edit edit__account-avatar" for="avatar">
                                        <svg class="edit__img">
                                            <use xlink:href="{{ asset('img/icons.svg#pencil') }}"></use>
                                        </svg>
                                        @error('avatar')
                                        <p class="auth__input-error">{{ $message }}</p>
                                        @enderror
                                    </label>
                                </div>
                                <div class="edit__avatar-button">
                                    <label for="avatar" class="edit-avatar-box">
                                        <svg class="edit__img-button">
                                            <use xlink:href="{{ asset('img/icons.svg#photograph') }}"></use>
                                        </svg>
                                        <span class="load__avatar-text">
                                            Завантажити
                                        </span>
                                        <input name="avatar" id="avatar" type="file" class="load__avatar">
                                    </label>
                                    <button class="avatar-delete">
                                        <svg class="edit__img-button">
                                            <use xlink:href="{{ asset('img/icons.svg#cancel') }}"></use>
                                        </svg>

                                        <span class="load__avatar-text">Видалити</span>
                                    </button>
                                </div>
                                <button class="save__button">Зберегти зміни</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
