@extends('layouts.head')

@section('title', 'Реєстрація')



@section('content')
    <div class="wrapper__auth">

        @include('includes.auth-header')

        <main class="main main__auth">
            <div class="main__container container">
                <h1 class="title title__auth-check">Будь ласка, перевірте свою електронну пошту</h1>
                <p class="subtitle subtitle-check">Щоб почати, підтвердьте свою електронну адресу. Якщо ви не отримали
                    електронний лист, перевірте папку зі спамом.</p>
                <section class="provider__auth">
                    <div class="provider__auth-box">
                        <a href="https://mail.google.com/mail/u/0/" target="_blank"
                           class="provider__auth-button provider__auth-button-verify provider__auth-button-verify-google">
                            <svg class="auth__button-img auth__button-img-gmail">
                                <use xlink:href="{{ asset('img/icons.svg#gmail') }}"></use>
                            </svg>
                            <span>Відкрити Gmail</span>
                        </a>
                    </div>
                    <div class="provider__auth-box">
                        <a href="https://www.microsoft.com/en-us/microsoft-365/outlook/email-and-calendar-software-microsoft-outlook" target="_blank"
                           class="provider__auth-button provider__auth-button-verify  provider__auth-button-verify-outlook">
                            <svg class="auth__button-img">
                                <use xlink:href="{{ asset('img/icons.svg#outlook') }}"></use>
                            </svg>
                            <span>Відкрити Outlook</span>
                        </a>
                    </div>
                    <div class="provider__auth-box">
                        <a href="https://login.yahoo.com/?.src=ym&pspid=2023538075&activity=ybar-mail&.lang=uk-UA&.intl=ua&.done=https%3A%2F%2Fmail.yahoo.com%2Fd%3Fpspid%3D2023538075%26activity%3Dybar-mail" target="_blank"
                           class="provider__auth-button provider__auth-button-verify provider__auth-button-verify-yahoo">
                            <svg class="auth__button-img">
                                <use xlink:href="{{ asset('img/icons.svg#yahoo') }}"></use>
                            </svg>
                            <span>Відкрити Yahoo</span>
                        </a>
                    </div>
                </section>
                <section class="auth__email-box">
                    @if(session('status'))
                        <p class="input__info input__info-verify">
                            <svg class="input__info-img">
                                <use xlink:href="{{ asset('img/icons.svg#info') }}"></use>
                            </svg>
                            <span class="input__info-text">{{ session('status') }}</span>
                        </p>
                    @endif
                    <form action="{{ route('verification.send') }}" method="post" class="auth__email-form">
                        @csrf
                        <button type="submit" class="resend__mail-button">
                            Надіслати листа повторно
                            <svg class="resend__mail-button-img">
                                <use xlink:href="{{ asset('img/icons.svg#fly') }}"></use>
                            </svg>
                        </button>
                    </form>
                    <div class="link__auth">
                        <form class="menu__link-auth" action="{{ route('logout') }}" method="post">
                            @csrf
                            <a class="menu__link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit()">Повернутись до авторизації
                            </a>
                        </form>
                    </div>
                    <div class="progress progress-check">
                        <div class="progress__fill"></div>
                        <span class="progress__text"></span>
                    </div>
                </section>
            </div>
        </main>
    </div>
@endsection


