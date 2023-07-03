@extends('layouts.head')

@section('title', 'Зміна пошти')



@section('content')
    <div class="wrapper">
        @include('includes.header')
        <main class="main">
            <div class="container">
                <p class="subtitle subtitle-new-password">Введіть нову пошту</p>
                <p class="auth__input-error tac">УВАГА!!! Вам потрібно буде підтвердити нову пошту!</p>
                <section class="auth__email-box">
                        @if(session('error'))
                            <p class="input__info input__info-error">
                                <svg class="input__info-img">
                                    <use xlink:href="{{ asset('img/icons.svg#cancel') }}"></use>
                                </svg>
                                <span class="input__info-text">{{ session('error') }}</span>
                            </p>
                        @endif
                    <form action="{{ route('change_email') }}" method="post" class="auth__email-form">
                        @csrf
                        <label class="auth__input-box" for="email">
                            <span class="auth__input-title">Нова пошта</span>
                            <input name="email" id="email" type="email"
                                   class="auth__input-field {{ $errors->has('email') ? 'auth__input-field-error' : ''}}"
                                   required autofocus>
                            @error('email')
                            <p class="auth__input-error">{{ $message }}</p>
                            @enderror
                        </label>
                        <div class="auth__button-box">
                            <button class="auth__button-submit">Змінити пошту</button>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
