@extends('layouts.head')

@section('title', 'Відновлення паролю')



@section('content')
    <div class="wrapper__auth">

        @include('includes.auth-header')
        <main class="main main__auth">
            <div class="main__container container">
                <h1 class="title title__auth title__auth-forgot">Відновлення паролю</h1>
                <p class="subtitle">Введіть ваш Email</p>
                <section class="auth__email-box">
                    <form action="{{ route('password.request') }}" method="post" class="auth__email-form">
                        @csrf
                        <div class="auth__input-area">
                            <label class="auth__input-box" for="email">
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
                                <span class="auth__input-title">Email</span>
                                <input name="email" id="email" type="email"
                                       class="auth__input-field {{ $errors->has('email') ? 'auth__input-field-error' : ''}}"
                                       value="{{ old('email') }}" required autofocus>
                                @error('email')
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
