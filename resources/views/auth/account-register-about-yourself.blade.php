@extends('layouts.head')

@section('title', 'Реєстрація')



@section('content')
    <div class="wrapper__auth">

        @include('includes.auth-header')

        <main class="main main__auth">
            <div class="main__container container">
                <h1 class="title title__auth-check">Привіт! Розкажи нам про себе.</h1>
                <p class="subtitle">Введіть свою особисту інформацію, і ви зможете завантажити аватар нижче.</p>
                <section class="auth__email-box">
                    <form action="{{route('check-email')}}" class="auth__email-form">
                        <div class="input__data-box">
                            <div class="select__avatar">
                                <div class="avatar">
                                    <label class="edit" for="edit">
                                        <svg class="edit__img">
                                            <use xlink:href="{{ asset('img/icons.svg#pencil') }}"></use>
                                        </svg>
                                        <input type="file" name="edit" id="edit">
                                    </label>
                                </div>
                            </div>
                            <div class="input__auth-field">
                                <label class="auth__input-box" for="name">
                                    <span class="auth__input-title">Ім'я</span>
                                    <input name="name" id="name" type="text"
                                           class="auth__input-field auth__input-field-email auth__input-field-name"
                                           required autofocus>
                                </label>
                                <label class="auth__input-box" for="surname">
                                    <span class="auth__input-title">Прізвище</span>
                                    <input name="surname" id="surname" type="text" required
                                           class="auth__input-field-about auth__input-field auth__input-field-password">
                                </label>
                            </div>
                        </div>
                        <div class="auth__button-box">
                            <button class="auth__button-submit">Завершити</button>
                        </div>
                        <div class="progress progress-about">
                            <div class="progress__fill"></div>
                            <span class="progress__text"></span>
                        </div>
                    </form>
                </section>
            </div>
        </main>

    </div>
@endsection


