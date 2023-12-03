@extends('components.layout')

@section("content")
    @foreach ($posts as $post)
        <article>
            <a href="/posts/{{$post->slug}}"><h1 class="{{$loop->even ? "mb-2":""}}"> {{$post->title}}</h1></a>

            <p><a href="/categories/{{$post->category->slug}}">
                    {{ $post->category->name }}
                </a>
            </p>
            <div> {{$post->excerpt}}</div>
            <br>
            <hr>




        </article>

    @endforeach

@endsection
