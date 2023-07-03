@extends('layouts.head')

@section('title', 'Друзі')

@section('content')
    @include('includes.header')
    <div class="wrapper">
        <main class="main">
            <div class="container friends__box flex">
                <div class="friends__container">
                    @if(!$user->friends()->count())
                        <span class="friends__import-text">У вас немає друзів</span>
                    @else
                        @foreach($user->friends() as $user_block)
                            @include('includes.user-block')
                        @endforeach
                    @endif
                </div>
                @include('includes.friends-aside')
            </div>
        </main>
    </div>
    @include('includes.footer')
@endsection
