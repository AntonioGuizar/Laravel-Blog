@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('post.search') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control"
                    placeholder="Buscar una publicación por titulo, contenido o autor">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
                @if (request()->has('search'))
                    <a href="{{ route('post.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                @endif
            </div>
        </form>
        @if (count($posts) > 0)
            <h1>Publicaciones</h1>

            <div class="row justify-content-center">
                @foreach ($posts as $post)
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <img src="{{ $post->image_path }}" class="card-img-top w-75 mx-auto" alt="Post Image">
                            <div class="card-body">
                                <h4>Titulo</h4>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text"><b>Contenido: </b>{{ Str::substr($post->content, 0, 70) }}...</p>
                                <p class="card-text"><small class="text-muted">Autor: {{ $post->author->name }}</small></p>
                                <p class="card-text"><small class="text-muted">Fecha:
                                        {{ $post->created_at->format('Y-m-d') }}</small></p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-primary">Leer más</a>
                                @if (Auth::check() && Auth::user()->id == $post->author->id)
                                    <a href="{{ route('post.edit', ['id' => $post->id]) }}"
                                        class="btn btn-secondary">Editar</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif (request()->has('search') && count($posts) == 0)
                <h2>No hay publicaciones que coincidan con tu búsqueda</h2>
            @else
                <h2>No hay publicaciones</h2>
        @endif
    </div>
@endsection
