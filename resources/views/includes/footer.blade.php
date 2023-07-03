<footer class="footer">
    <div class="footer__container">
        <div class="footer__main">
            <div class="footer__logo">
                <a href="{{ route('index') }}" class="footer__logo-box">
                    <img src="{{ asset('img/full_logo.svg') }}" class="footer__logo-img" alt="Logo"/>
                </a>
            </div>
            <ul class="footer__list">
                <li class="footer__item">
                    <a href="https://t.me/Calendar_its_bot" target="_blank" class="footer__link">Телеграм бот</a>
                </li>
                <li class="footer__item">
                    <a href="{{ route('about-us') }}" class="footer__link">Про нас</a>
                </li>
                <li class="footer__item">
                    <a href="{{ route('terms') }}" class="footer__link">Правила</a>
                </li>
                <li class="footer__item">
                    <a href="{{ route('dashboard') }}" class="footer__link">Календар</a>
                </li>
                <li class="footer__item">
                    <a href="{{ route('account') }}" class="footer__link">Аккаунт</a>
                </li>
            </ul>
        </div>
        <div class="footer__bottom">
            <span class="footer__text">
                © 2023
                <a
                    href="https://github.com/kachula-ivan" class="footer__github">Kachula Ivan™
                </a>
                . All Rights Reserved
            .</span>
        </div>
    </div>
</footer>

