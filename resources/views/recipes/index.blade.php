@extends('layouts.master')


@section('title')
    Elenco Allergeni
@endsection

@section('content')
    <div>
        <a class="btn btn-primary" href="{{ route('recipes.create') }}">Aggiungi Ricetta</a>
    </div>
    <div class="container">
        {{-- blocco del form dei filtri --}}
        <form method="GET" action="{{ route('recipes.index') }}" class="mb-4">

            <div class="row g-2">

                <!-- search nel titolo -->
                <div class="col">
                    <input type="text" name="search_title" class="form-control" placeholder="Cerca nel titolo..."
                        value="{{ request('search_title') }}">
                </div>

                <!-- search nella descrizione -->
                <div class="col">
                    <input type="text" name="search_description" class="form-control"
                        placeholder="Cerca nella descrizione..." value="{{ request('search_description') }}">
                </div>

                <!-- per page -->
                <div class="col">
                    <select name="per_page" class="form-select">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>

                <!-- ALLERGENI -->
                <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside">
                            Allergeni Accettati
                        </button>

                        <div class="dropdown-menu p-3" style="max-height: 300px; overflow-y: auto;">
                            @foreach ($allergens as $allergen)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergens_include[]"
                                        id="allergens_include-{{ $allergen->id }}" value="{{ $allergen->id }}"
                                        {{ in_array($allergen->id, request('allergens_include', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="allergens_include-{{ $allergen->id }}">
                                        {{ $allergen->name }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside">
                            Allergeni Da Escludere
                        </button>

                        <div class="dropdown-menu p-3" style="max-height: 300px; overflow-y: auto;">
                            @foreach ($allergens as $allergen)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergens_exclude[]"
                                        id="allergens_exclude-{{ $allergen->id }}" value="{{ $allergen->id }}"
                                        {{ in_array($allergen->id, request('allergens_exclude', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="allergens_exclude-{{ $allergen->id }}">
                                        {{ $allergen->name }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col">
                    <button class="btn btn-primary">Filtra</button>
                    <a href="{{ route('recipes.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>
        </form>

        {{-- blocco per mostrare la navigazione della paginazione --}}
        <div class="col">
            {{ $recipes->links() }}
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Kcal totali</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($recipes as $recipe)
                    <tr>
                        <th scope="row">{{ $recipe->id }}</th>
                        <td>{{ $recipe->title }}</td>
                        <td>{{ $recipe->description }}</td>
                        <td>{{ $recipe->total_kcal }}</td>
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
    <div class="col">
        {{ $recipes->links() }}
    </div>
@endsection
