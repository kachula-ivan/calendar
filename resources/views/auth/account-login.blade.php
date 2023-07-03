@extends('layouts.head')

@section('title', 'Авторизація')



@section('content')
    <div class="wrapper__auth">

        @include('includes.auth-header')

        <main class="main main__auth">
            <div class="main__container container">
                <h1 class="title title__auth">Вхід</h1>
                <p class="subtitle">Увійдіть у свій обліковий запис</p>
                <section class="provider__auth">
                    <div class="provider__auth-box">
                        <a href="/auth/google/redirect">
                            <button type="submit" class="provider__auth-button provider__auth-button-verify-google">
                                <svg class="auth__button-img auth__button-img-google">
                                    <use xlink:href="{{ asset('img/icons.svg#google') }}"></use>
                                </svg>
                                Продовжити з Google
                            </button>
                        </a>
                        <a href="/auth/github/redirect">
                            <button type="submit" class="provider__auth-button provider__auth-button-verify-github">
                                <svg class="auth__button-img auth__button-img-github">
                                    <use xlink:href="{{ asset('img/icons.svg#github') }}"></use>
                                </svg>
                                Продовжити з Github
                            </button>
                        </a>
                    </div>
                </section>
                <p class="auth__email-text">Або ввійдійть за допомогою email:</p>
                <section class="auth__email-box">
                    <form action="{{ route('login') }}" method="post" class="auth__email-form">
                        @csrf
                        <div class="auth__input-area auth__input-area-login">
                            @error('all')
                            <p class="auth__input-error">{{ $message }}</p>
                            @enderror
                            @if(session('status'))
                                <p class="input__info">
                                    <svg class="input__info-img">
                                        <use xlink:href="{{ asset('img/icons.svg#info') }}"></use>
                                    </svg>
                                    <span class="input__info-text">
                                        {{ session('status') }}
                                    </span>
                                </p>
                            @endif
                            <label class="auth__input-box" for="email">
                                <span class="auth__input-title">Email</span>
                                <input name="email" id="email" type="email" value="{{ old('email') }}"
                                       class="auth__input-field {{ $errors->has('email') ? 'auth__input-field-error' : ''}}"
                                       required autofocus>
                            </label>
                            <label class="auth__input-box" for="password">
                                <span class="auth__input-title">Пароль</span>
                                <input name="password" id="password" type="password"
                                       class="auth__input-field {{ $errors->has('email') ? 'auth__input-field-error' : ''}}"
                                       required>
                                <a href="{{route('password.request')}}" class="forgot__password">Забули пароль?</a>
                            </label>
                            <div class="checkbox__box subtitle">
                                <label>
                                    <input type="checkbox" id="remember" name="remember" class="my-checkbox" value="1"/>
                                    Запам'ятати мене
                                </label>
                            </div>
                        </div>
                        <div class="auth__button-box">
                            <button class="auth__button-submit">Ввійти</button>
                        </div>
                    </form>
                    <div class="link__auth">
                        <span>Не маєте аккаунта? <a href="{{route('register')}}">Створити аккаунт</a></span>
                    </div>
                </section>
            </div>
        </main>
    </div>
@endsection


