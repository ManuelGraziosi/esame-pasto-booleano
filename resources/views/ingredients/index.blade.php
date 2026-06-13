@extends('layouts.master')


@section('title')
    Elenco Ingredienti
@endsection

@section('content')
    <div>
        <a class="btn btn-primary" href="{{ route('ingredients.create') }}">Aggiungi Ingrediente</a>
    </div>

    {{-- blocco del form dei filtri --}}
    <form method="GET" action="{{ route('ingredients.index') }}" class="mb-4">

        <div class="row g-2">

            <!-- search -->
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Cerca ingrediente..."
                    value="{{ request('search') }}">
            </div>

            <!-- kcal min -->
            <div class="col">
                <input type="number" step=any name="kcal_min" class="form-control" placeholder="Kcal min"
                    value="{{ request('kcal_min') }}">
            </div>

            <!-- kcal max -->
            <div class="col">
                <input type="number" step=any name="kcal_max" class="form-control" placeholder="Kcal max"
                    value="{{ request('kcal_max') }}">
            </div>

            <!-- per page -->
            <div class="col">
                <select name="per_page" class="form-select">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
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
                <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">
                    Reset
                </a>
            </div>

        </div>
    </form>
    <div class="container">
        {{-- blocco per mostrare la navigazione della paginazione --}}
        <div class="col">
            {{ $ingredients->links() }}
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Kcal</th>
                    <th scope="col">Proteine</th>
                    <th scope="col">Grassi</th>
                    <th scope="col">Carbidrati</th>
                    <th scope="col">Fibre</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($ingredients as $ingredient)
                    <tr>
                        <th scope="row">{{ $ingredient->id }}</th>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->energy_kcal }}</td>
                        <td>{{ $ingredient->proteins }}</td>
                        <td>{{ $ingredient->lipids }}</td>
                        <td>{{ $ingredient->available_carbohydrates }}</td>
                        <td>{{ $ingredient->total_fiber }}</td>

                        <td class="d-flex">
                            <a class="btn btn-info" href="{{ route('ingredients.show', $ingredient) }}">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a class="btn btn-warning" href="{{ route('ingredients.edit', $ingredient) }}">
                                <i class="bi bi-pencil"></i>
                            </a>

                            @auth
                                @if (auth()->user()->role === 'admin')
                                    <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST"
                                        onsubmit="return confirm('Sei sicuro di voler eliminare questo ingrediente?')">
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


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- blocco per mostrare la navigazione della paginazione --}}
    <div class="col">
        {{ $ingredients->links() }}
    </div>
@endsection
