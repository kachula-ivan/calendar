@extends('layouts.head')

@section('title', 'Запити на дружбу')

@section('content')
    @include('includes.header')
    <div class="wrapper">
        <main class="main">
            <div class="container friends__box flex">
                <div class="friends__container">
                @if(!$requests->count())
                    <span class="friends__import-text">Список запитів пустий.</span>
                @else
                    @foreach($requests as $user_block)
                            @include('includes.user-block')
                    @endforeach
                        <div class="pagination">
                            {{ $user->friendsRequests()->links() }}
                        </div>
                @endif
                </div>
                @include('includes.friends-aside')
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
