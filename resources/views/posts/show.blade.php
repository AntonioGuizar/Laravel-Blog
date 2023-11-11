@extends('layouts.app')

@section('content')
    <div class="container">
        <h1><b>Titulo:</b> {{ $post->title }}</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top img-fluid w-75 d-block mx-auto py-5" alt="Post Image">
            </div>
            <div class="col-md-8">
                <h2>Contenido</h2>
                <p class="card-text">{{ $post->content, 0, 70 }}</p>
                <p class="card-text h3"><small class="text-muted"><b>Autor:</b> {{ $post->author->name }}</small></p>
                <p class="card-text h4"><small class="text-muted"><b>Fecha:</b>
                        {{ $post->created_at->format('Y-m-d') }}</small></p>
                @if (Auth::check() && Auth::user()->id == $post->author->id)
                    <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-secondary">Editar</a>
                    <button type="button" class="btn btn-danger"
                        onclick="confirmDeletePost({{ $post->id }})">Eliminar</button>
                @endif
            </div>
        </div>
    </div>
    @extends('modals.delete')
@endsection
