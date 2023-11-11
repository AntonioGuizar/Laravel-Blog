@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form mb-5 d-lg-none d-md-block">
            <form class="d-flex w-100" role="search" action="{{ route('post.search') }}" method="GET">
                <input type="text" name="search" class="form-control"
                    placeholder="Buscar una publicación por titulo, contenido o autor" value="{{ request()->search ?? '' }}">
                <div class="ms-3">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
                @if (request()->has('search'))
                    <a href="{{ route('post.index') }}" class="btn btn-outline-secondary ms-1">Limpiar</a>
                @endif
            </form>
        </div>
        <h1 class="mb-5">Publicaciones</h1>
        <div class="row justify-content-center">
            <div class="col-md-9" id="posts">
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                        <div class="post">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <div class="image pb-3">
                                <img src="{{ asset('storage/' . $post->image_path) }}" class="post-img img-fluid"
                                    alt="Post Image">
                            </div>
                            <div class="pb-3">
                                <p class="post-summary">{{ $post->summary }}</p>
                                <p><small class="text-muted">Autor: {{ $post->author->name }},
                                        {{ $post->created_at->format('Y-m-d') }}</small></p>
                            </div>
                            <div class="actions pb-5">
                                <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-primary">Leer más</a>
                                @if (Auth::check() && Auth::user()->id == $post->author->id)
                                    <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-secondary">Editar</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @elseif (request()->has('search') && count($posts) == 0)
                    <h2>No hay publicaciones que coincidan con tu búsqueda</h2>
                @else
                    <h2>No hay publicaciones</h2>
                @endif
            </div>
            <aside class="col-md-3">
                <div class="card search d-none d-lg-block">
                    <div class="card-header">
                        <h3>Buscar</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('post.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar">
                                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Last posts -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Últimas publicaciones</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($lastPosts as $lastPost)
                            <div class="mb-3">
                                <a href="{{ route('post.show', ['id' => $lastPost->id]) }}"
                                    class="text-decoration-none text-dark">
                                    <h4>{{ $lastPost->title }}</h4>
                                </a>
                                <p class="card-text"><small class="text-muted">Autor:
                                        {{ $lastPost->author->name }},
                                        {{ $lastPost->created_at->format('Y-m-d') }}</small></p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Categories -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Categorías</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($categories as $category)
                            <div class="mb-3">
                                <a href="{{ route('post.category', ['id' => $category->id]) }}"
                                    class="text-decoration-none text-dark">
                                    <h4>{{ $category->name }}</h4>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        @endsection
