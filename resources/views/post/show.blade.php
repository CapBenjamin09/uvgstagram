@extends('layout.app')

@section('title', $post->title)

@section('title-h1', $post->title)

@section('content')
    <div class="container bg-white mx-auto md:flex">
        <div class="md:w-1/2">
            <img class="md:" src="{{asset('uploads/'. $post->image)}}" alt="Imagen del post {{$post->title}}">

        </div>

        <div class="md:w-1/2 flex-col flex-none mt-5">
            <div class="px-5 pt-1 mb-5">
                <div class="flex flex-nowrap pt-2">
                    <p class="py-0.5"> 0  </p>
                    <p class="pl-1">
                        <svg class="inline-flex w-4 h-4 text-red-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z"/>
                        </svg>
                    </p>

                </div>

                <div>
                    <p class="font-bold">{{$post->user->username}}</p>
                    <p class="text-sm text-gray-500">
                        {{$post->created_at->diffForHumans()}}
                    </p>
                    <p class="mt-2 mb-3">
                        {{$post->description}}
                    </p>
                </div>

                @auth
                    @if($post->user_id === auth()->user()->id)
                        <form action="{{ route('post.destroy', $post) }}" method="post">
                            @method('DELETE') @csrf

                            <input type="submit" value="Eliminar Publicación" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold">

                        </form>

                    @endif
                @endauth

                {{--                cajita de comentarios--}}
                <div class="flex-none sm:h-96 md:h-32 xl:h-96 lg:h-64 2xl:h-128">
                    <div class="flex mb-5">
                        <h5 class="text-xl font-bold leading-none text-gray-900 ">
                            Comentarios
                            <span class="font-normal text-gray-400 truncate">
                                 ({{$comments->count()}})
                            </span>
                        </h5>

                    </div>
                    <div class="flow-root overflow-y-auto sm:h-80 xl:h-80 md:h-20 lg:h-52 2xl:h-[29rem]">
                        <ul role="list" class="divide-y divide-gray-200">

                            @foreach($comments as $comment)
                            <li class="py-3 sm:py-4 shadow">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{asset('storage/usuario.svg')}}" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate">
                                            {{$comment->user->username}}
                                            <span class="font-normal text-sm text-gray-900 truncate">
                                                {{$comment->description}}
                                            </span>
                                        </p>
                                        <p class="text-xs text-gray-500 truncate">
                                            {{$comment->created_at->diffForHumans()}}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                {{-- Agregar comentarios --}}

                <form method="post" action="{{ route('comment.store', ['user' => auth()->user()->id, 'post' => $post->id]) }}">
                    @csrf
                    <div class="py-2 grid grid-cols-7 gap-2">

                        <div class="col-span-6">
                            <input
                                id="description"
                                name="description"
                                placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg  @error('description') border-red-500" @enderror value="{{ old('description') }}">
                        </div>

                        <input type="submit"
                               value="Comentar"
                               class="text-sky-700 text-xs cursor-pointer hover:text-sky-700 transition-colors">

                        @error('comment')
                        <p class=" text-red-700 my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
