@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica progetto</h1>
        <hr>
        <form action="{{ route('projects.update', $project->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titolo">Titolo</label>
                <input type="text" name="titolo" class="form-control" value="{{ $project->titolo }}">
            </div>
            <div class="form-group">
                <label for="cliente">Cliente</label>
                <input type="text" name="cliente" class="form-control" value="{{ $project->cliente }}">
            </div>
            <div class="form-group">
                <label for="descrizione">descrizione</label>
                <textarea name="descrizione" class="form-control">{{ $project->descrizione }}</textarea>
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" name="url" class="form-control" value="{{ $project->url }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Aggiorna</button>
            </div>
        </form>
    </div>
@endsection
