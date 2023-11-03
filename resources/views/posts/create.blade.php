@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Crear una nueva entrada</h1>
        <section class="mt-3">
            <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
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
                    <label for="Autor">Autor</label>
                    <span class="h5">{{ Auth::user()->name }}</span>
                    <label for="floatingInput">Titulo</label>
                    <input class="form-control" type="text" name="title" required>
                    <label for="floatingTextArea">Contenido</label>
                    <textarea class="form-control" name="content" id="floatingTextarea" cols="30" rows="10" required></textarea>
                </div>
                <button class="btn btn-secondary m-3">Guardar</button>
            </form>
        </section>
    </div>
@endsection
