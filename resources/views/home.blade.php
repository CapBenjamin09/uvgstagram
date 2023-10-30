@extends('layout.app')

@section('title', 'Home')

<h1>
    @section('title-h1')
        HOME
    @endsection
</h1>

@section('content')

    @foreach($posts as $post)
    <div class="container justify-center items-center flex py-2 ">
        <div class="max-w-3xl rounded overflow-hidden shadow-lg bg-white rounded-xl">
            <div class="flex items-center px-2 py-2">
                <a href="{{ route('post.index', $post->user->username) }}">
                    <img class="cursor-pointer" width="40" height="40" src="{{ asset('storage/usuario.svg') }}" alt="Imagen Usuario">
                </a>
                <div class="pl-2 font-bold text-xl mb-2 pt-2"><a href="{{ route('post.index', $post->user->username) }}">{{ $post->user->username }}</a></div>
            </div>
            <a href="{{route('post.show', [ $post->user->username, $post])}}">
                <img class="w-full" src="{{asset('uploads/'. $post->image)}}" alt="Sunset in the mountains">
            </a>
            <div class="flex-none px-4 py-4 ">
                <div class="flex flex-nowrap">
                    <p class="py-0.5">0</p>
                    <p class="pl-1 pt-2">
                        <svg class="inline w-4 h-4 text-red-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z"/>
                        </svg>
                    </p>
                </div>

                <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
                <p class="text-gray-700 text-base">
                    {{ $post->description }}
                </p>
                <p class="text-gray-700 text-base">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
    </div>

    @endforeach


@endsection

