@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Editar una entrada</h1>
        <section class="mt-3">
            <form method="post" action="{{ route('post.update', ['id' => $post->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card p-3">
                    <label for="floatingInput">Titulo</label>
                    <input class="form-control" type="text" name="title" value="{{ $post->title }}" required>
                    <label for="floatingTextArea">Contenido</label>
                    <textarea class="form-control" name="content" id="floatingTextarea" cols="30" rows="10" required>{{ $post->content }}</textarea>
                </div>
                <button class="btn btn-secondary m-3">Guardar</button>
                <button type="button" class="btn btn-danger"
                    onclick="confirmDeletePost({{ $post->id }})">Eliminar</button>
            </form>
        </section>
    </div>
    @extends('modals.delete')
@endsection
