@extends('layouts.master')


@section('title')
    Elenco Allergeni
@endsection

@section('content')
    <div>
        <a class="btn btn-primary" href="{{ route('recipes.create') }}">Aggiungi Ricetta</a>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($recipes as $recipe)
                    <tr>
                        <th scope="row">{{ $recipe->id }}</th>
                        <td>{{ $recipe->title }}</td>
                        <td>{{ $recipe->description }}</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-info" href="{{ route('recipes.show', $recipe) }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a class="btn btn-warning" href="{{ route('recipes.edit', $recipe) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                @auth
                                    @if (auth()->user()->role === 'admin')
                                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST"
                                            onsubmit="return confirm('Sei sicuro di voler eliminare questo allergene?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-danger" disabled>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
