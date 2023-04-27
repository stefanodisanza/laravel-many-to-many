@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Progetti</h1>
                <div class="mb-3">
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">Crea nuovo progetto</a>
                </div>
                @if(count($projects) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Cliente</th>
                                <th>Descrizione</th>
                                <th>URL</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->titolo }}</td>
                                    <td>{{ $project->cliente }}</td>
                                    <td>{{ $project->descrizione }}</td>
                                    <td><a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a></td>
                                    <td>
                                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-primary">View</a>
                                        <a href="{{ route('projects.edit', $project->slug) }}" class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('projects.destroy', $project->slug) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Cancella</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Nessun progetto trovato.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
