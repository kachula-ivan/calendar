@extends('layouts.head')

@section('title', 'Зміна паролю')



@section('content')
    <div class="wrapper">
        @include('includes.header')
        <main class="main">
            <div class="container">
                <p class="subtitle subtitle-new-password">Для даної дії необхідно підтвердити пароль</p>
                <section class="auth__email-box">
                        @if(session('error'))
                            <p class="input__info input__info-error">
                                <svg class="input__info-img">
                                    <use xlink:href="{{ asset('img/icons.svg#cancel') }}"></use>
                                </svg>
                                <span class="input__info-text">{{ session('error') }}</span>
                            </p>
                        @endif
                    <form action="{{ route('password.confirm') }}" method="post" class="auth__email-form">
                        @csrf
                        <label class="auth__input-box" for="password">
                            <span class="auth__input-title">Пароль</span>
                            <input name="password" id="password" type="password"
                                   class="auth__input-field {{ $errors->has('password') ? 'auth__input-field-error' : ''}}"
                                   required autofocus>
                            @error('password')
                            <p class="auth__input-error">{{ $message }}</p>
                            @enderror
                        </label>
                        <div class="auth__button-box">
                            <button class="auth__button-submit">Підтвердити пароль</button>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
