@extends('layouts.app')

@section('content')
    <h1>Chat with {{ $user->name}} {{ $user->surname }}</h1><br>
    <div>
        <ul>
        @foreach($messages as $message)
            <li>
                <h2>{{ $message->content }}</h2>
                <p>{{ $message->receiver_id === $user->id ? auth()->user()->name : $user->name }} {{ $message->created_at }} </p>
            </li>
        @endforeach
        </ul>
    </div>

    <div>
        <form method="POST" action="{{ route('send_messages', $user->id) }}">
            @csrf
            <div>
                <label for="content">Message Content:</label><br>
                <textarea id="content" name="content" rows="4" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <a href="{{ route('details', $user->id) }}">BACK</a><br>
@endsection
