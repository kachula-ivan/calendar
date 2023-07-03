@extends('layouts.head')

@section('title', 'Правила')

@section('content')
    @include('includes.header')
    <div class="wrapper">
        <main class="main">
            <div class="container">
                <h1 class="terms__title">Умови використання календаря</h1>
                <p class="nav__terms-text"><a href="{{ route('index') }}" class="nav__terms-link">Home</a> » Terms of
                    Service</p>
                <section class="terms__section">
                    <div class="terms__box">
                        <h3 class="terms__subtitle">1. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque,
                            molestias.</h3>
                        <p class="terms__text"><strong class="terms__text-number">1.1</strong> Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit. Aliquid, animi consectetur cum dicta excepturi fugit
                            repellat! Accusantium aperiam at beatae cumque minima odio optio, quam quasi quo sed.
                            Accusamus accusantium animi aspernatur assumenda at cupiditate ducimus et facere id iusto
                            maxime modi nam nihil nisi, officiis, possimus quae totam, vero.</p>
                        <p class="terms__text"><strong class="terms__text-number">1.2</strong> Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit. Cupiditate distinctio id magni minima obcaecati
                            perspiciatis repellendus sint, suscipit voluptates voluptatum?</p>
                    </div>
                    <div class="terms__box">
                        <h3 class="terms__subtitle">2. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h3>
                        <p class="terms__text"><strong class="terms__text-number">2.1</strong>Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit. Dolorem earum magni molestias odit quaerat quidem
                            ratione tempora tenetur voluptate! Debitis ea illo ipsa, maxime omnis quae ut vitae
                            voluptas. Assumenda, eaque eos maxime officia repudiandae saepe suscipit tenetur. Aperiam,
                            unde!</p>
                        <p class="terms__text"><strong class="terms__text-number">2.2</strong>Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit. Amet aperiam architecto at aut consequatur dicta, error
                            est fuga illum in magni modi molestiae nobis nostrum nulla possimus quae rem reprehenderit
                            sapiente totam unde voluptates voluptatum? Ad atque, corporis excepturi exercitationem,
                            laudantium maxime necessitatibus nisi perspiciatis quaerat quos reprehenderit ullam
                            veritatis.</p>
                        <p class="terms__text"><strong class="terms__text-number">2.3</strong>Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit. Aliquid, amet autem blanditiis eos esse est expedita
                            iste molestias nemo neque nulla obcaecati porro provident quia, recusandae sapiente sunt,
                            ullam vel! Impedit ipsa laudantium perspiciatis placeat quo? Ad alias aperiam consectetur
                            cumque debitis deleniti doloremque ducimus enim et excepturi facilis fugit harum iure labore
                            molestiae nemo nesciunt nihil, nisi non nostrum perferendis quae, quam quod recusandae
                            repellendus suscipit voluptatem voluptates? Earum eveniet exercitationem fuga ipsa
                            similique! Dolor expedita perferendis quidem tenetur.</p>
                        <p class="terms__text"><strong class="terms__text-number">2.4</strong>Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit. Amet dolorum eligendi ex excepturi exercitationem
                            facilis fugiat incidunt molestiae, nobis numquam quia similique ut veniam. Illum magni non
                            nostrum quis voluptatibus?</p>
                    </div>
                    <div class="terms__box">
                        <h3 class="terms__subtitle">3. Lorem ipsum dolor.</h3>
                        <p class="terms__text"><strong class="terms__text-number">3.1</strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aperiam consectetur molestias porro quibusdam totam.</p>
                        <ul class="terms-list terms__text">
                            <li class="terms-item">Lorem ipsum dolor sit amet, consectetur.</li>
                            <li class="terms-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos expedita labore laborum nam nobis non quisquam sit temporibus voluptate?</li>
                            <li class="terms-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, vero.</li>
                            <li class="terms-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente?</li>
                            <li class="terms-item">Lorem ipsum dolor sit amet, consectetur.</li>
                            <li class="terms-item">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et hic nisi voluptatem?</li>
                        </ul>
                        <p class="terms__text"><strong class="terms__text-number">3.2</strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aperiam consectetur molestias porro quibusdam totam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias aut dolore eius eligendi esse, ipsum itaque labore maiores molestiae natus nemo praesentium quae quam reprehenderit repudiandae unde veniam vero.</p>
                        <p class="terms__text"><strong class="terms__text-number">3.3</strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aperiam consectetur molestias porro quibusdam totam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias aut dolore eius eligendi.</p>
                    </div>
                    <div class="terms__box">
                        <h3 class="terms__subtitle">4. Lorem ipsum dolor sit amet, consectetur adipisicing elit Lorem ipsum.</h3>
                        <p class="terms__text"><strong class="terms__text-number">4.1</strong>Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit. Dolorem earum magni molestias odit quaerat quidem
                            ratione tempora tenetur voluptate! Debitis ea illo ipsa, maxime omnis quae ut vitae
                            voluptas. Assumenda, eaque eos maxime officia repudiandae saepe suscipit tenetur. Aperiam,
                            unde!</p>
                        <p class="terms__text"><strong class="terms__text-number">4.2</strong>Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit. Amet aperiam architecto at aut consequatur dicta, error
                            est fuga illum in magni modi molestiae nobis nostrum nulla possimus quae rem reprehenderit
                            sapiente totam unde voluptates voluptatum? Ad atque, corporis excepturi exercitationem,
                            laudantium maxime necessitatibus nisi perspiciatis quaerat quos reprehenderit ullam
                            veritatis.</p>
                        <p class="terms__text"><strong class="terms__text-number">2.4</strong>Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit. Amet dolorum eligendi ex excepturi exercitationem
                            facilis fugiat incidunt molestiae, nobis numquam quia similique ut veniam. Illum magni non
                            nostrum quis voluptatibus?</p>
                    </div>
                    <p class="terms__text">
                        Останнє оновлення березень 1, 2023
                    </p>
                </section>
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
