@extends('layouts.master')

@section('title')
    Elenco Ricette - Pasto Booleano
@endsection

@section('content')
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark m-0">Gestione Ricette</h2>
            <a class="btn btn-primary shadow-sm d-flex align-items-center gap-2" href="{{ route('recipes.create') }}">
                <i class="bi bi-plus-circle"></i> Aggiungi Ricetta
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-3 mb-4 bg-light">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('recipes.index') }}">
                    <div class="row g-3 align-items-end">

                        <div class="col-md-3">
                            <label class="form-label small fw-semibold text-secondary">Titolo</label>
                            <input type="text" name="search_title" class="form-control" placeholder="Cerca nel titolo..."
                                value="{{ request('search_title') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small fw-semibold text-secondary">Descrizione</label>
                            <input type="text" name="search_description" class="form-control"
                                placeholder="Cerca nella descrizione..." value="{{ request('search_description') }}">
                        </div>

                        <div class="col-md-1">
                            <label class="form-label small fw-semibold text-secondary">Righe</label>
                            <select name="per_page" class="form-select">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </div>

                        <div class="col-6 col-sm-4 col-md-6 col-lg-2">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Allergeni
                                Accettati</label>
                            <div class="dropdown">
                                <button
                                    class="btn btn-outline-secondary dropdown-toggle w-100 text-start d-flex justify-content-between align-items-center"
                                    type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <span>Accettati</span>
                                </button>
                                <div class="dropdown-menu p-3 shadow"
                                    style="max-height: 250px; overflow-y: auto; min-width: 220px;">
                                    @foreach ($allergens as $allergen)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" name="allergens_include[]"
                                                id="allergens_include-{{ $allergen->id }}" value="{{ $allergen->id }}"
                                                {{ in_array($allergen->id, request('allergens_include', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label text-capitalize small"
                                                for="allergens_include-{{ $allergen->id }}">
                                                {{ $allergen->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-sm-4 col-md-6 col-lg-2">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Da Escludere</label>
                            <div class="dropdown">
                                <button
                                    class="btn btn-white border w-100 dropdown-toggle text-start d-flex justify-content-between align-items-center text-danger"
                                    type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <span>Esclusi</span>
                                </button>
                                <div class="dropdown-menu p-3 shadow"
                                    style="max-height: 250px; overflow-y: auto; min-width: 220px;">
                                    @foreach ($allergens as $allergen)
                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" name="allergens_exclude[]"
                                                id="allergens_exclude-{{ $allergen->id }}" value="{{ $allergen->id }}"
                                                {{ in_array($allergen->id, request('allergens_exclude', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label text-capitalize small text-danger"
                                                for="allergens_exclude-{{ $allergen->id }}">
                                                {{ $allergen->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end d-flex gap-2 justify-content-end align-items-end mt-3">
                            <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary px-3">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </a>
                            <button type="submit" class="btn btn-dark px-4 shadow-sm">
                                <i class="bi bi-funnel"></i> Applica Filtri
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-center mb-3">
            {{ $recipes->links() }}
        </div>

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 80px;">ID</th>
                            <th scope="col" style="width: 250px;">Titolo</th>
                            <th scope="col">Descrizione</th>
                            <th scope="col" style="width: 140px;" class="text-center">Kcal totali</th>
                            <th scope="col" style="width: 180px;" class="text-end px-4">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recipes as $recipe)
                            <tr>
                                <th scope="row" class="text-muted">#{{ $recipe->id }}</th>
                                <td class="fw-semibold text-dark">{{ $recipe->title }}</td>
                                <td class="text-muted text-truncate" style="max-width: 350px;">{{ $recipe->description }}
                                </td>
                                <td class="text-center fw-medium text-secondary">
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
                                        {{ $recipe->total_kcal }} kcal
                                    </span>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a class="btn btn-sm btn-outline-info" href="{{ route('recipes.show', $recipe) }}"
                                            title="Visualizza">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-outline-warning"
                                            href="{{ route('recipes.edit', $recipe) }}" title="Modifica">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        @auth
                                            @if (auth()->user()->role === 'admin')
                                                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST"
                                                    onsubmit="return confirm('Sei sicuro di voler eliminare questa ricetta?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Elimina">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-outline-danger" disabled
                                                    title="Azione riservata all'amministratore">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @endif
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Nessuna ricetta corrisponde ai criteri di ricerca cercati.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {{ $recipes->links() }}
        </div>

    </div>
@endsection
