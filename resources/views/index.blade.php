@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{route('logOut')}}">
        @auth()
            @csrf
            @method('DELETE')

            <button type="submit">Выйти</button>
        @endauth
    </form>
@endsection
