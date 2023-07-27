@extends('layouts.app')

@section('content')

    <div>
        <h1>Users</h1>
        <ul>
            @foreach ($users as $user)
                <li>
                    <a href="{{ route('details', $user->id) }}"><h2>{{ $user->name}} {{ $user->surname }}</h2></a>
                </li>
            @endforeach
        </ul>
        {{--    {{ $users->links() }}--}}
    </div>
@endsection
