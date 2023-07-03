@extends('layouts.head')

@section('title', 'Реєстрація')



@section('content')
    <div class="wrapper__auth">

        @include('includes.auth-header')

        <main class="main main__auth">
            <div class="main__container container">
                <h1 class="title title__auth">Реєстрація Аккаунту із email</h1>
                <p class="subtitle">Лише кілька деталей, і все готово.</p>
                <section class="auth__email-box">
                    <form action="{{route('register-email')}}" method="post" class="auth__email-form">
                        @csrf
                        <div class="auth__input-area">
                            <label class="auth__input-box" for="name">
                                <span class="auth__input-title">Ім'я<span class="required"> *</span></span>
                                <input name="name" id="name" type="text" value="{{ old('name') }}" required
                                       class="auth__input-field auth__input-field-email {{ $errors->has('name') ? 'auth__input-field-error' : ''}}" autofocus>
                                @error('name')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="auth__input-box" for="surname">
                                <span class="auth__input-title">Прізвище</span>
                                <input name="surname" id="surname" type="text" value="{{ old('surname') }}"
                                       class="auth__input-field auth__input-field-email {{ $errors->has('surname') ? 'auth__input-field-error' : ''}}">
                                @error('surname')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="auth__input-box" for="email">
                                <span class="auth__input-title">Email<span class="required"> *</span></span>
                                <input name="email" id="email" type="email" value="{{ old('email') }}" required
                                       class="auth__input-field auth__input-field-email {{ $errors->has('email') ? 'auth__input-field-error' : ''}}">
                                @error('email')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="auth__input-box" for="password">
                            <span
                                class="auth__input-title">Пароль<span class="required"> *</span></span>
                                <input name="password" id="password" type="password" required
                                       class="auth__input-field auth__input-field-password {{ $errors->has('password') ? 'auth__input-field-error' : ''}}">
                                @error('password')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="auth__input-box" for="password_confirmation">
                            <span
                                class="auth__input-title">Підтвердження паролю<span class="required"> *</span></span>
                                <input name="password_confirmation" id="password_confirmation" type="password" required
                                       class="auth__input-field auth__input-field-confirm {{ $errors->has('password') ? 'auth__input-field-error' : ''}}">
                                @error('password')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                        <div class="auth__button-box">
                            <button type="submit" class="auth__button-submit">Зареєструватись</button>
                        </div>
                    </form>
                    <section class="auth__email-box">
                        <div class="link__auth link__auth-register">
                            <span>Хочете створити аккаунт із Google або Github?</span>
                            <a href="{{route('register')}}">Створити аккаунт із Google або Github</a>
                        </div>
                        <div class="link__auth">
                            <span>Вже маєте аккаунт?<a href="{{route('login')}}"> Ввійти в аккаунт</a></span>
                            <span class="terms__text">Реєструючись, ви погоджуєтеся з нашими <a class="terms__link"
                                                                                                href="{{route('terms')}}">Умовами</a></span>
                        </div>
                    </section>
                </section>
            </div>
        </main>
    </div>
@endsection


