@extends('layouts.head')

@section('title', 'Реєстрація')



@section('content')
    <div class="wrapper__auth">
        @include('includes.auth-header')
        <main class="main main__auth">
            <div class="main__container container">
                <h1 class="title title__auth">Реєстрація</h1>
                <p class="subtitle">Зареєструйте аккаунт щоб розпочати</p>
                <section class="provider__auth">
                    <div class="provider__auth-box">
                        <a href="/auth/google/redirect">
                            <button type="submit" class="provider__auth-button provider__auth-button-verify-google">
                                <svg class="auth__button-img auth__button-img-google">
                                    <use xlink:href="{{ asset('img/icons.svg#google') }}"></use>
                                </svg>
                                Зареєструватись з Google
                            </button>
                        </a>
                        <a href="/auth/github/redirect">
                            <button type="submit" class="provider__auth-button provider__auth-button-verify-github">
                                <svg class="auth__button-img auth__button-img-github">
                                    <use xlink:href="{{ asset('img/icons.svg#github') }}"></use>
                                </svg>
                                Зареєструватись з Github
                            </button>
                        </a>
                    </div>
                </section>
                <section class="auth__email-box">
                    <div class="link__auth link__auth-register">
                        <span>Хочете створити аккаунт із паролем?</span>
                        <a href="{{route('register-email')}}">Створити аккаунт із Email</a>
                    </div>
                    <div class="link__auth">
                        <span>Вже маєте аккаунт? <a href="{{route('login')}}">Ввійти в аккаунт</a></span>
                        <span class="terms__text">Реєструючись, ви погоджуєтеся з нашими <a class="terms__link" href="{{route('terms')}}">Умовами</a></span>
                    </div>
                </section>
            </div>
        </main>
    </div>
@endsection


