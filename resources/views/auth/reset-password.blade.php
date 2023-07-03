@extends('layouts.head')

@section('title', 'Відновлення паролю')



@section('content')
    <div class="wrapper__auth">

        @include('includes.auth-header')
        <main class="main main__auth">
            <div class="main__container container">
                <h1 class="title title__auth title__auth-forgot">Відновлення паролю</h1>
                <p class="subtitle">Придумайте новий пароль</p>
                <section class="auth__email-box">
                    <form action="{{ route('password.update') }}" method="post" class="auth__email-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->token }}">
                        <label class="auth__input-box" for="email">
                            <span class="auth__input-title">Email</span>
                            <input name="email" id="email" type="email"
                                   class="auth__input-field {{ $errors->has('email') ? 'auth__input-field-error' : ''}}"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <p class="auth__input-error">{{ $message }}</p>
                            @enderror
                        </label>
                        <div class="auth__input-area">
                            <label class="auth__input-box" for="password">
                            <span
                                class="auth__input-title">Пароль</span>
                                <input name="password" id="password" type="password" required
                                       class="auth__input-field auth__input-field-password {{ $errors->has('password') ? 'auth__input-field-error' : ''}}">
                                @error('password')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="auth__input-box" for="password_confirmation">
                            <span
                                class="auth__input-title">Підтвердження паролю</span>
                                <input name="password_confirmation" id="password_confirmation" type="password" required
                                       class="auth__input-field auth__input-field-confirm {{ $errors->has('password') ? 'auth__input-field-error' : ''}}">
                                @error('password')
                                <p class="auth__input-error">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                        <div class="auth__button-box">
                            <button class="auth__button-submit">Відновити пароль</button>
                        </div>
                    </form>
                    <div class="link__auth">
                        <span><a href="{{route('login')}}">Повернутись до авторизації</a></span>
                    </div>
                </section>
            </div>
        </main>
    </div>
@endsection
