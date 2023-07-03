@extends('layouts.head')

@section('title', 'Контакти')

@section('content')
    @include('includes.header')
    <section class="contacts__title">
        <h1 class="contacts__title-text">Контакти</h1>
    </section>
    <div class="wrapper">
        <main class="main">
            <div class="container">
                <section class="contacts__info">
                    <p class="contacts__info-text">Виникли запитання чи сумніви? Не соромтеся зв’язуватися з нашою командою.</p>
                    <p class="contacts__info-text">Наша служба підтримки доступна з понеділка по п’ятницю з 7:00 до 18:00 за київським часом. Ми робимо все можливе, щоб відповісти на всі запити служби підтримки протягом 24 годин.</p>
                    <p class="contacts__info-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquam asperiores ducimus ea explicabo nostrum, pariatur quas repellendus velit!</p>
                </section>
                <a href="mailto:bot.management.trx@gmail.com" class="contacts__info-button">Зв'язатись з компанією</a>
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
