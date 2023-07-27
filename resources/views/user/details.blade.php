@extends('layouts.app')

@section('content')
    <div>
        <h1>User details</h1><br>

        <h2 data-id="{{ $user->id}}" id="userDetails">{{ $user->name}} {{ $user->surname }} </h2>
        <p>Phone: {{ $user->phone }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Address: {{ $user->address }}</p>
    </div>

    <div>
        <h1>User posts</h1><br>

        <ul>
            @foreach ($user->posts as $post)
                <li>
                    <p>{{ $post->content}}</p>
                    <p id="likesCount">likes: {{ $post->likes->count()}}</p>
                @foreach ($post->likes as $like)
                    <p id="likedUsers">users who like: {{ $like->name }}</p>
                @endforeach
                <button data-id="{{$post->id}}" id="updateLikes{{$post->id}}">Like</button>
                </li>
            @endforeach
        </ul>
    </div>

    <a href="{{ route('index')}}">BACK</a><br>
    <a href="{{ route('get_messages', $user->id)}}">CHAT</a>
@endsection

<script>
    import axios from 'axios';


    document.getElementById('updateLikes').addEventListener('click', function () {
        console.log('im hereeeee');
        let likesElement = document.querySelector("#updateLikes");
        let userElement = document.querySelector("#userDetails");
        let userId = userElement.dataset.id;
        axios.post(`/users/${userId}/details`, {
            post_id : likesElement.dataset.id,
            user_id : {{ Auth::user()->id }}
        })
            .then(response => {
                let data = response.data;
                document.getElementById('likesCount').innerHTML = data.count;
                document.getElementById('likedUsers').innerHTML = data.users;
            })
            .catch(error => {
                console.log('error');
            });
    });
</script>
