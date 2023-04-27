@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Crea progetto</h1>
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input type="text" name="titolo" id="titolo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cliente">cliente</label>
                        <input type="text" name="cliente" id="cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="descrizione">descrizione</label>
                        <textarea name="descrizione" id="descrizione" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" name="url" id="url" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="technologies">Tecnologie:</label>
                        <div class="checkbox-group">
                            @foreach($technologies as $technology)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $technology->id }}" id="technology{{ $technology->id }}">
                                    <label class="form-check-label" for="technology{{ $technology->id }}">
                                        {{ $technology->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Crea</button>
                </form>
            </div>
        </div>
    </div>
@endsection
