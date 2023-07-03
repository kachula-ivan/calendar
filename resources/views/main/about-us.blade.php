@extends('layouts.head')

@section('title', 'Про Календар')

@section('content')
    @include('includes.header')
    <section class="about_us__title">
    </section>
    <main class="main">
        <div class="container">
            <h1 class="user__info-title about_us-title">Про Календар</h1>
            <section class="about_us-section about_us__intro">
                <img src="{{ asset('img/about_us_intro.png') }}" alt="about us intro" class="about_us__intro-img">
                <p class="about_us__intro-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus
                    aliquam asperiores ducimus ea explicabo nostrum, pariatur quas repellendus velit!</p>
            </section>
        </div>

        <section class="about_us-section about_us-section-light">
            <div class="about_us-section-wrapper about_us-section-column flex">
                <div class="calendar_change-text">
                    <h3 class="about_us__subtitle">
                        Lorem ipsum dolor sit
                    </h3>
                    <p class="about_us__text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam dolor dolore dolorem est
                        ex
                        expedita explicabo facere, fuga iure nam natus nobis nostrum officia quae repellat repellendus
                        soluta tempora temporibus ut velit veniam vero vitae? Atque blanditiis corporis culpa doloremque
                        magni, molestiae neque quia, quos sequi tenetur voluptas voluptatem.
                    </p>
                </div>
                <div class="calendar_change-img">
                    <img src="{{ asset('img/calendar_change.png') }}" alt="calendar change" class="about_us__intro-img">
                </div>
            </div>
        </section>

        <div class="container">
            <section class="about_us-section">
                <h3 class="about_us__subtitle about_us-title">
                    Командні ціності
                </h3>
                <ul class="about__values-list flex">
                    <li class="about__values-item">
                        <img src="{{ asset('img/productivity.png') }}" alt="productivity" class="about__values-img">
                        <h4 class="about_us__subtitle about__values-title">Продуктивність</h4>
                        <p class="about_us__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa
                            dolores eum fugit nemo perspiciatis possimus?</p>
                    </li>
                    <li class="about__values-item">
                        <img src="{{ asset('img/agility.png') }}" alt="agility" class="about__values-img">
                        <h4 class="about_us__subtitle about__values-title">Швидкість</h4>
                        <p class="about_us__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Consequuntur, rerum?</p>
                    </li>
                    <li class="about__values-item">
                        <img src="{{ asset('img/professionalism.png') }}" alt="professionalism"
                             class="about__values-img">
                        <h4 class="about_us__subtitle about__values-title">Професіоналізм</h4>
                        <p class="about_us__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor id,
                            tenetur.</p>
                    </li>
                </ul>
            </section>
        </div>

        <section class="about_us-section about_us-section-light">
            <ul class="about__innovation-list about_us-section-wrapper flex">
                <li class="about__innovation-item">
                    <img src="{{ asset('img/innovation.png') }}" alt="innovation" class="about__innovation-img">
                </li>
                <li class="about__innovation-item">
                    <h4 class="about_us__subtitle">Lorem ipsum dolor sit.</h4>
                    <p class="about_us__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam
                        autem consequuntur dicta nobis odit quia repellat, sit tempore vitae. lorem40</p>
                    <p class="about_us__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam
                        autem consequuntur dicta nobis odit quia repellat, sit tempore vitae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad assumenda autem dicta dignissimos ducimus, eius harum id maiores, nemo odio ratione sunt, vero. Aliquam doloribus labore quasi tenetur veritatis. Ab at ex illum incidunt mollitia quam repellat similique tenetur voluptatem.</p>
                </li>
            </ul>
        </section>

        <div class="container">
            <section class="about_us-section">
                <img src="{{ asset('img/about_us_end.png') }}" alt="about_us_end" class="about_us__end-img">
            </section>
        </div>
    </main>
    @include('includes.footer')
@endsection
