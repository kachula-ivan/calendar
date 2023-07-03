@extends('layouts.head')

@section('title', 'Запрошення на події')

@section('content')
    @include('includes.header')
    <div class="wrapper">
        <main class="main">
            <div class="container friends__box flex">
                <div class="friends__container">
                    @if(session('status'))
                        <p class="input__info input__info-edit">
                            <svg class="input__info-img">
                                <use xlink:href="{{ asset('img/icons.svg#info') }}"></use>
                            </svg>
                            <span class="input__info-text">{{ session('status') }}</span>
                        </p>
                    @endif
                    @if(!$invites->count())
                        <span class="friends__import-text">Список запитів пустий.</span>
                    @else
                        @foreach ($invites as $invite)
                            <div class="user__block flex">
                                <div class="user__block-avatar">
                                    <a href="{{ route('profile', ['user_id' => $invite->user->id]) }}">
                                        <img src="{{ $invite->user->avatar }}" alt="avatar" class="user__block-img">
                                    </a>
                                </div>
                                <div class="user__block-info">
                                    <a href="{{ route('profile', ['user_id' => $invite->user->id]) }}">
                                        <div class="user__block-text">
                                            <p class="user__block-main">{{ $invite->user->name }} {{ $invite->user->surname }}</p>
                                            <p class="user__block-second">{{ $invite->user->email }}</p>
                                        </div>
                                        <div class="user__block-button flex">
                                            <form action="{{ route('events-invites-accept', ['invite_id' => $invite->id]) }}" method="POST" class="move-form">
                                                @csrf
                                                <button type="submit" class="accepted__button accepted__button-block">Погодитись</button>
                                            </form>
                                            <form action="{{ route('events-invites-decline', ['invite_id' => $invite->id]) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="accepted__button accepted__button-delete accepted__button-block">Відхилити</button>
                                            </form>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="invite">
                                <p class="invite__title">Подія: <span class="invite__info">{{ $invite->title }}</span></p>
                                <p class="invite__title">Початкова дата: <span class="invite__info">{{ $invite->start_date }}</span></p>
                                <p class="invite__title">Кінцева дата: <span class="invite__info">{{ $invite->end_date }}</span></p>
                                <p class="invite__title">Колір: <span class="invite__info">{{ $invite->color }}</span></p>
                                <p class="invite__title">Група: <span class="invite__info">{{ $invite->group }}</span></p>
                            </div>
                        @endforeach
{{--                        <div class="pagination">--}}
{{--                            {{ $user->friendsRequests()->links() }}--}}
{{--                        </div>--}}
                    @endif
                </div>
                @include('includes.friends-aside')
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
