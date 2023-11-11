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
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="Autor">Autor</label>
                            <span class="h5">{{ Auth::user()->name }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="floatingInput">Titulo</label>
                            <input class="form-control" type="text" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingInput">Categoria</label>
                            <select class="form-select" name="category_id" required>
                                <option value="">Selecciona una categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="floatingTextArea">Resumen</label>
                            <textarea class="form-control" name="summary" id="floatingTextarea" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="floatingTextArea">Contenido</label>
                            <textarea class="form-control" name="content" id="floatingTextarea" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="floatingInput">Imagen</label>
                            <input class="form-control" type="file" name="image" required>
                        </div>
                            <button class="btn btn-secondary m-3">Guardar</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
