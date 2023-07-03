@extends('layouts.head')

@section('title', 'Зміна паролю')



@section('content')
    <div class="wrapper">
        @include('includes.header')
        <main class="main">
            <div class="container">
                <p class="subtitle subtitle-new-password">Придумайте новий пароль</p>
                <section class="auth__email-box">
                        @if(session('error'))
                            <p class="input__info input__info-error">
                                <svg class="input__info-img">
                                    <use xlink:href="{{ asset('img/icons.svg#cancel') }}"></use>
                                </svg>
                                <span class="input__info-text">{{ session('error') }}</span>
                            </p>
                        @endif
                    <form action="{{ route('change_password') }}" method="post" class="auth__email-form">
                        @csrf
                        <label class="auth__input-box" for="old_password">
                            <span class="auth__input-title">Старий пароль</span>
                            <input name="old_password" id="old_password" type="password"
                                   class="auth__input-field {{ $errors->has('password') ? 'auth__input-field-error' : ''}}"
                                   required autofocus>
                            @error('old_password')
                            <p class="auth__input-error">{{ $message }}</p>
                            @enderror
                        </label>
                        <div class="auth__input-area">
                            <label class="auth__input-box" for="new_password">
                            <span
                                class="auth__input-title">Новий пароль</span>
                                <input name="new_password" id="new_password" type="password" required
                                       class="auth__input-field auth__input-field-password {{ $errors->has('password') ? 'auth__input-field-error' : ''}}">
                                @error('new_password')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="auth__input-box" for="new_password_confirmation">
                            <span
                                class="auth__input-title">Підтвердження паролю</span>
                                <input name="new_password_confirmation" id="new_password_confirmation" type="password" required
                                       class="auth__input-field auth__input-field-confirm {{ $errors->has('password') ? 'auth__input-field-error' : ''}}">
                                @error('new_password')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                        <div class="auth__button-box">
                            <button class="auth__button-submit">Змінити пароль</button>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
