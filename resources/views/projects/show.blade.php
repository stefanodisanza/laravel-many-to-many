@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $project->titolo }}</h1>
        <p>Cliente: {{ $project->cliente }}</p>
        <p>Descrizione: {{ $project->descrizione }}</p>
        <p>URL: <a href="{{ $project->url }}">{{ $project->url }}</a></p>
        <div class="btn-group" role="group">
            <a href="{{ route('projects.edit', $project->slug) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('projects.destroy', $project->slug) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Cancella</button>
            </form>
        </div>
    </div>
@endsection
