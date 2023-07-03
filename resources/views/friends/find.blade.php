@extends('layouts.head')

@section('title', 'Знайти друзів')

@section('content')
    @include('includes.header')
    <div class="wrapper">
        <main class="main">
            <div class="container friends__box flex">
                <div class="friends__container">
                    <div class="friends__import-header">
                        <span class="friends__import-text">Пошук друзів</span>
                    </div>
                    <div class="friends__search-input">
                        <form method="GET" action="{{ route('search-results') }}" class="search__form">
                            <input type="search" name="query" class="auth__input-field friends__search-field">
                            <button type="submit" class="friends__search-button">
                                <svg class="friends__search-img">
                                    <use xlink:href="{{ asset('img/icons.svg#search') }}"></use>
                                </svg>
                            </button>
                        </form>
                    </div>
                    @if(!$users->count())
                        <p class="search__info">Ваш запит не дав результатів</p>
                    @else
                        @foreach($users as $user_block)
                            @include('includes.user-block')
                        @endforeach
                            <div class="pagination">
                                {{ $users->links() }}
                            </div>
                    @endif
                </div>
                @include('includes.friends-aside')
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
