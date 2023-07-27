@extends('layouts.app')

@section('content')
    <h1>{{ auth()->user()->name }}'s personal page</h1><br>
    <div>
        <h2>My posts</h2>
        <ul>
        @foreach($posts as $post)
            <li>
                <h3>{{ $post->content }}</h3>
                <p>{{ $post->created_at }}</p>
            </li>
        @endforeach
        </ul>
    </div>

    <div>
        <form method="POST" action="{{ route('create_post')}}">
            @csrf
            <div>
                <label for="content">Post Content:</label><br>
                <textarea id="content" name="content" rows="4" required></textarea>
            </div>
            <button type="submit">Create post</button>
        </form>
    </div>

    <a href="{{ route('index') }}">BACK TO USERS</a><br>
@endsection
