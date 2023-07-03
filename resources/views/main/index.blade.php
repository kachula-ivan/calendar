@extends('layouts.head')

@section('title', 'Головна сторінка')



@section('content')
    @include('includes.header')
    <main class="main">
        <div class="container">
            <section class="index__section index__login flex">
                <div class="index__login-box">
                    <h1 class="login__img-text">Calendar</h1>
                    <img src="{{ asset('img/index_login.png') }}" alt="login image" class="login__img">
                </div>
                @auth
                    <div class="response__card response__card-auth">
                        <div class="response__card-header">
                            <svg class="response__star">
                                <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                            </svg>
                            <svg class="response__star">
                                <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                            </svg>
                            <svg class="response__star">
                                <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                            </svg>
                            <svg class="response__star">
                                <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                            </svg>
                            <svg class="response__star">
                                <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                            </svg>
                        </div>
                        <div class="main__info__card">
                            <h4 class="main__info__card-title">Дякую за додаток!
                                <svg class="ukraine__map">
                                    <use xlink:href="{{ asset('img/icons.svg#ukraine_map') }}"></use>
                                </svg>
                            </h4>
                            <p class="main__info__card-text">"Дуже гарний додаток, сильно мені допоміг з плануванням дня
                                та нагадуваннями. З його допомогою я зміг організувати свої справи більш ефективно і
                                ефективніше виконувати задачі. Календарний інтерфейс дуже зручний і інтуїтивно
                                зрозумілий. 😁"</p>
                        </div>
                        <div class="response__card-footer">
                            <p class="response__card-name">Шевченко Максим
                                <svg class="response__flag">
                                    <use xlink:href="{{ asset('img/icons.svg#ukraine') }}"></use>
                                </svg>
                            </p>
                            <p class="response__card-platform">Freelance Writer</p>
                        </div>
                    </div>
                @endauth
                @guest
                    <div class="index__login-box index__login-box-form">
                        <p class="index__login-text">Увійдіть у свій аккаунт</p>
                        <section class="provider__auth">
                            <div class="provider__auth-box">
                                <a href="/auth/google/redirect">
                                    <button type="submit"
                                            class="provider__auth-button provider__auth-button-verify-google">
                                        <svg class="auth__button-img auth__button-img-google">
                                            <use xlink:href="{{ asset('img/icons.svg#google') }}"></use>
                                        </svg>
                                        Продовжити з Google
                                    </button>
                                </a>
                                <a href="/auth/github/redirect">
                                    <button type="submit"
                                            class="provider__auth-button provider__auth-button-verify-github">
                                        <svg class="auth__button-img auth__button-img-github">
                                            <use xlink:href="{{ asset('img/icons.svg#github') }}"></use>
                                        </svg>
                                        Продовжити з Github
                                    </button>
                                </a>
                            </div>
                        </section>
                        <p class="auth__email-text">Або ввійдійть за допомогою email:</p>
                        <section class="auth__email-box auth__email-box-index">
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
                                        <a href="{{route('password.request')}}" class="forgot__password">Забули
                                            пароль?</a>
                                    </label>
                                    <div class="checkbox__box subtitle">
                                        <label>
                                            <input type="checkbox" id="remember" name="remember" class="my-checkbox"
                                                   value="1"/>
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
                @endguest
            </section>
        </div>
        <section class="index__section-container index__business">
            <h2 class="index__business-text">Нам довіряють понад 8 000 компаній</h2>
            <img src="{{ asset('img/businesses.png') }}" alt="businesses" class="index__business-img">
        </section>
        <div class="container">
            <section class="index__section">
                <div class="index__wrapper">
                    <h2 class="index__title">Відгуки</h2>
                    <div class="slider multiple-items">
                        <div class="response__card">
                            <div class="response__card-header">
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                            </div>
                            <div class="main__info__card">
                                <h4 class="main__info__card-title">Швидкість і чіткість</h4>
                                <p class="main__info__card-text">"Обожнюю цей календар й тільки з ним можу розпланувати
                                    події та нічого не забути."</p>
                            </div>
                            <div class="response__card-footer">
                                <p class="response__card-name">Артем Мельник
                                    <svg class="response__flag">
                                        <use xlink:href="{{ asset('img/icons.svg#ukraine') }}"></use>
                                    </svg>
                                </p>
                                <p class="response__card-platform">TrustPilot</p>
                            </div>
                        </div>
                        <div class="response__card">
                            <div class="response__card-header">
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                            </div>
                            <div class="main__info__card">
                                <h4 class="main__info__card-title">Хороший дизайн</h4>
                                <p class="main__info__card-text">"Функціональний та зручний додаток з легким, не
                                    перевантаженим зайвим, інтерфейсом."</p>
                            </div>
                            <div class="response__card-footer">
                                <p class="response__card-name">Наталя Відлога
                                    <svg class="response__flag">
                                        <use xlink:href="{{ asset('img/icons.svg#poland') }}"></use>
                                    </svg>
                                </p>
                                <p class="response__card-platform">Freelance Writer</p>
                            </div>
                        </div>
                        <div class="response__card">
                            <div class="response__card-header">
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                            </div>
                            <div class="main__info__card">
                                <h4 class="main__info__card-title">Дякую за додаток! 🇺🇦</h4>
                                <p class="main__info__card-text">"Дуже гарний додаток, сильно мені допоміг з плануванням
                                    дня та нагадуваннями. З його допомогою я зміг організувати свої справи більш
                                    ефективно і ефективніше виконувати задачі.😁"</p>
                            </div>
                            <div class="response__card-footer">
                                <p class="response__card-name">Шевченко Максим
                                    <svg class="response__flag">
                                        <use xlink:href="{{ asset('img/icons.svg#ukraine') }}"></use>
                                    </svg>
                                </p>
                                <p class="response__card-platform">Freelance Writer</p>
                            </div>
                        </div>
                        <div class="response__card">
                            <div class="response__card-header">
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                            </div>
                            <div class="main__info__card">
                                <h4 class="main__info__card-title">Все супер</h4>
                                <p class="main__info__card-text">"Ну, як казав мій дід, нормально"</p>
                            </div>
                            <div class="response__card-footer">
                                <p class="response__card-name">Галина Пасічник
                                    <svg class="response__flag">
                                        <use xlink:href="{{ asset('img/icons.svg#ukraine') }}"></use>
                                    </svg>
                                </p>
                                <p class="response__card-platform">Freelance Writer</p>
                            </div>
                        </div>
                        <div class="response__card">
                            <div class="response__card-header">
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                            </div>
                            <div class="main__info__card">
                                <h4 class="main__info__card-title">Зручний календар, мені подобається 🔥</h4>
                                <p class="main__info__card-text">"просто найкращий додаток евер! планую тільки тут. Є
                                    завдання, події, нагадування, цілі. Просто мега зручно, естетично і просто."</p>
                            </div>
                            <div class="response__card-footer">
                                <p class="response__card-name">Назар Адамов
                                    <svg class="response__flag">
                                        <use xlink:href="{{ asset('img/icons.svg#poland') }}"></use>
                                    </svg>
                                </p>
                                <p class="response__card-platform">TrustPilot</p>
                            </div>
                        </div>
                        <div class="response__card">
                            <div class="response__card-header">
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                                <svg class="response__star">
                                    <use xlink:href="{{ asset('img/icons.svg#star') }}"></use>
                                </svg>
                            </div>
                            <div class="main__info__card">
                                <h4 class="main__info__card-title">Крутяк!</h4>
                                <p class="main__info__card-text">"Зручний простий календар, всі необхідні функції є в
                                    наявності. Дизайн без заморочок - простий і зручний."</p>
                            </div>
                            <div class="response__card-footer">
                                <p class="response__card-name">Єлизавета Райтер
                                    <svg class="response__flag">
                                        <use xlink:href="{{ asset('img/icons.svg#uk') }}"></use>
                                    </svg>
                                </p>
                                <p class="response__card-platform">TrustPilot</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <section class="index__section-container index__section index__section-work">
            <div class="index__wrapper">
                <h2 class="index__title index__title-work">Як ми працюємо</h2>
                <div class="work__box flex">
                    <div class="card__work">
                        <img src="{{ asset('img/create-time-slots.png') }}" alt="create time slots"
                             class="card__work-img">
                        <h4 class="card__work-title">Створіть часові проміжки.</h4>
                        <p class="card__work-text">Створіть часові проміжки для налаштованих шаблонів подій і
                            онлайн-зустрічей. Сторінки планування можна налаштувати. Ви вибираєте, які часові інтервали
                            відображатимуться.</p>
                    </div>
                    <div class="card__work">
                        <img src="{{ asset('img/share-custom-scheduling-link.png') }}"
                             alt="share custom scheduling link" class="card__work-img">
                        <h4 class="card__work-title">Поділіться своїм спеціальним посиланням.</h4>
                        <p class="card__work-text">Ви можете надсилати налаштовані посилання на календар будь-кому. Вони
                            зможуть призначити зустріч з вами залежно від вашої доступності онлайн.</p>
                    </div>
                    <div class="card__work">
                        <img src="{{ asset('img/free-scheduling-software.png') }}" alt="free scheduling software"
                             class="card__work-img">
                        <h4 class="card__work-title">Безкоштовне програмне забезпечення.</h4>
                        <p class="card__work-text">Зустрічі, заплановані через додаток, автоматично
                            відображатимуться у вашому календарі. Пропустіть клопоти, пов’язані з електронними
                            листами.</p>
                    </div>
                </div>
                <a href="{{ route('login') }}" class="work__button">@guest
                        Почати прямо зараз
                    @endguest @auth
                        Повернутись до календаря
                    @endauth</a>
            </div>
        </section>
        <section class="index__section-container index__section-tg">
            <div class="section__tg-article">
                <div class="index__wrapper index__wrapper-tg">
                    <div class="section__tg-info">
                        <div class="tg__card-not-active flex">
                            <div class="tg__card-not-active-info">
                                <h2 class="index__title-tg">Отримуйте сповіщення від календаря в telegram!</h2>
                                <p class="index__tg-text">Підпишіться на нашого телеграм-бота через застосунок
                                    telegram</p>
                                <a href="https://t.me/Calendar_its_bot" target="_blank" class="index__tg-button">
                                    Підписатися
                                </a>
                            </div>
                            <div class="tg__card-not-active-img">
                                <svg class="tg__card-image">
                                    <use xlink:href="{{ asset('img/icons.svg#telegram-full') }}"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="section__tg-channel">
                        <div class="section__tg-channel-header flex">
                            <div class="section__tg-header-img__box">
                                <img src="{{ asset('img/favicon/android-chrome-512x512.png') }}" alt="Телеграм бот"
                                     class="section__tg-header-img">
                            </div>
                            <div class="section__tg-header-title">
                                <h5 class="tg__title">Calendar Bot</h5>
                                <a href="https://t.me/Calendar_its_bot" class="tg__subtitle">@Calendar_its_bot</a>
                            </div>
                        </div>
                        <div class="section__tg_info-description">
                            <p class="tg__text">Календар-бот - зручний інструмент для планування та управління часом.
                                Створюйте події, встановлюйте нагадування та залишайтеся організованими з
                                легкістю.📅✨</p>
                            <p class="tg__text">Наш сайт: <a href="http://test-its.ua" class="tg__subtitle">http://test-its.ua</a>
                            </p>
                            <p class="tg__text">Наш telegram bot: <a href="https://t.me/Calendar_its_bot"
                                                                     class="tg__subtitle">https://t.me/Calendar_its_bot</a>
                            </p>
                            <a href="https://desktop.telegram.org/" target="_blank" class="tg__button">
                                Завантажити телеграм
                                <svg class="index__tg-button-image">
                                    <use xlink:href="{{ asset('img/icons.svg#telegram-full') }}"></use>
                                </svg>
                            </a>
                        </div>
                        <div class="section__tg-channel-header">
                            <ul class="telegram__footer-list">
                                <li class="telegram__footer-item"><a href="https://telegram.org/faq" target="_blank"
                                                                     class="telegram__footer-link">About</a></li>
                                <li class="telegram__footer-item"><a href="https://telegram.org/blog" target="_blank"
                                                                     class="telegram__footer-link">Blog</a></li>
                                <li class="telegram__footer-item"><a href="https://telegram.org/apps" target="_blank"
                                                                     class="telegram__footer-link">Apps</a></li>
                                <li class="telegram__footer-item"><a href="https://core.telegram.org/" target="_blank"
                                                                     class="telegram__footer-link">Platform</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <section class="index__section">
                <h2 class="index__title index__title-work">Поширені запитання щодо календаря</h2>
                <ul class="index__list">
                    <li class="index__item dropdown__menu">
                        <button type="button" class="trigger">Як програмне забезпечення календаря
                            економить мій час?<span class="index__title-sign"></span>
                        </button>
                        <div class="content">
                            <p class="index__content-text">Інтелектуальне програмне забезпечення Календаря для
                                планування посилань економить ваш час багатьма способами. Завдяки настроюваним
                                посиланням на часовий проміжок ви можете надіслати своє посилання або розмістити його
                                десь, і люди зможуть зареєструватися для зустрічі з вами. Після вибору часового
                                інтервалу зустріч перейде прямо на вашу інформаційну панель. Це усуває необхідність
                                пересилати електронні листи туди-сюди, щоб визначити час, коли кожен вільний.
                            <p class="index__content-text">Ці посилання також економлять ваш час, оскільки вони
                                показують вашу реальну доступність у всіх ваших календарях. Це відрізняється від іншого
                                програмного забезпечення для планування, наприклад календаря Google, де ви можете бачити
                                лише один календар за раз.</p>
                        </div>
                    </li>
                    <li class="index__item dropdown__menu">
                        <button type="button" class="trigger">Які обмеження має програма?</button>
                        <div class="content">
                            <p class="index__content-text">У Календарі ви знайдете дуже невеликі обмеження щодо
                                планування. Єдиним обмеженням є те, що наразі Календар синхронізується лише з Календарем
                                Google і Microsoft. Однак це не буде обмеженням дуже довго, оскільки Календар
                                знаходиться в процесі додавання Apple Calendar, Exchange on premise та багатьох інших
                                платформ календарів.</p>
                        </div>
                    </li>
                    <li class="index__item dropdown__menu">
                        <button type="button" class="trigger">Чи можу я записати подію?</button>
                        <div class="content">
                            <p class="index__content-text">Ви можете призначити для себе кілька різних способів:</p>
                            <p class="index__content-text">1. Ви можете скористатися функцією «Знайти час», щоб
                                дізнатися, коли ви та особа, з якою ви хочете зустрітися, вільні, і таким чином
                                забронювати зустріч.</p>
                            <p class="index__content-text">2. Якщо у вас є доступ до посилання на часовий проміжок цієї
                                людини, ви можете зайти та зареєструватися на час для зустрічі таким чином.</p>
                            <p class="index__content-text">3. Ви завжди можете створити зустріч і запросити на неї
                                потрібних людей.</p>
                            <p class="index__content-text">4. Ви можете зробити це старим способом і надіслати їм
                                електронний лист і повертатися туди-сюди 8 разів (так, у середньому це займає стільки
                                часу), щоб знайти зручний час зустрічі. Рекомендуємо один із перших трьох варіантів!</p>
                        </div>
                    </li>
                    <li class="index__item dropdown__menu">
                        <button type="button" class="trigger">Чи можу я використовувати події в Календарі для
                            програми-планувальника?
                        </button>
                        <div class="content">
                            <p class="index__content-text">Календар буде для вас програмою для планування! Це
                                універсальний інструмент для планування, тож ви зможете бачити все, що у вас
                                відбувається, прямо на інформаційній панелі. Календар також добре інтегрується з Zapier,
                                якщо вам потрібно інтегрувати обліковий запис Календаря на інші платформи.</p>
                            <p class="index__content-text">Календар — це уніфікований календар, який допоможе вам
                                спланувати свій день. Він діє як додаток для планування, щоб показати вам все в одному
                                централізованому місці.</p>
                        </div>
                    </li>
                    <li class="index__item dropdown__menu">
                        <button type="button" class="trigger">Чи можу я мати особистий календар і робочий календар?
                        </button>
                        <div class="content">
                            <p class="index__content-text">Хоча можна було б створити особистий обліковий запис
                                Календаря та робочий обліковий запис Календаря, наша мета — зменшити кількість
                                календарів, які вам потрібно відстежувати. За допомогою Календаря ви можете мати свій
                                робочий та особистий календарі в одному обліковому записі, дозволяючи вам бачити, що у
                                вас відбувається в обох, на одній зручній для читання інформаційній панелі з узгодженим
                                кольором.</p>
                            <p class="index__content-text">Чи є у вас більше одного особистого календаря? А як щодо
                                календаря вашої дружини? Тепер ви можете об’єднати їх усі в одному місці. З професійним
                                планом ви можете мати до 10 підключених календарів у своєму обліковому записі.</p>
                        </div>
                    </li>
                    <li class="index__item dropdown__menu">
                        <button type="button" class="trigger">Як працює ваш єдиний календар?</button>
                        <div class="content">
                            <p class="index__content-text">Програма дозволяє переглядати та отримувати доступ до кількох
                                календарів одночасно. Кожен має свій власний колір, тому ви можете швидко побачити, з
                                яким календарем пов’язана зустріч або наради. Календар дозволяє підключати до 10
                                календарів, які можна переглядати на інформаційній панелі, що робить його найкращим
                                програмним забезпеченням уніфікованого календаря в Інтернеті.</p>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
        @guest
            <section class="index__section-container index__section">
                <div class="index__wrapper">
                    <div class="index__login-box index__login-box-form index__login-box-footer">
                        <section class="provider__auth">
                            <div class="provider__auth-box">
                                <a href="/auth/google/redirect">
                                    <button type="submit"
                                            class="provider__auth-button provider__auth-button-verify-google">
                                        <svg class="auth__button-img auth__button-img-google">
                                            <use xlink:href="{{ asset('img/icons.svg#google') }}"></use>
                                        </svg>
                                        Продовжити з Google
                                    </button>
                                </a>
                                <a href="/auth/github/redirect">
                                    <button type="submit"
                                            class="provider__auth-button provider__auth-button-verify-github">
                                        <svg class="auth__button-img auth__button-img-github">
                                            <use xlink:href="{{ asset('img/icons.svg#github') }}"></use>
                                        </svg>
                                        Продовжити з Github
                                    </button>
                                </a>
                            </div>
                        </section>
                        <p class="auth__email-text">Або ввійдійть за допомогою email:</p>
                        <section class="auth__email-box auth__email-box-index">
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
                                        <a href="{{route('password.request')}}" class="forgot__password">Забули
                                            пароль?</a>
                                    </label>
                                    <div class="checkbox__box subtitle">
                                        <label>
                                            <input type="checkbox" id="remember" name="remember" class="my-checkbox"
                                                   value="1"/>
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
                </div>
            </section>
        @endguest
    </main>
    @include('includes.footer')
@endsection
