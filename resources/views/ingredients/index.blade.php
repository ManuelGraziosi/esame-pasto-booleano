@extends('layouts.master')

@section('title')
    Elenco Ingredienti - Pasto Booleano
@endsection

@section('content')
    <div class="container py-5">

        {{-- INTESTAZIONE PAGINA --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark m-0">
                <i class="bi bi-egg-fried text-primary me-2"></i> Archivio Ingredienti
            </h2>
            <a class="btn btn-primary fw-semibold shadow-sm" href="{{ route('ingredients.create') }}">
                <i class="bi bi-plus-lg me-1"></i> Aggiungi Ingrediente
            </a>
        </div>

        {{-- AREA FILTRI DI RICERCA AVANZATA --}}
        <div class="card shadow-sm border-0 mb-4 bg-light">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('ingredients.index') }}">
                    <div class="row g-3">

                        <div class="col-12 col-md-4 col-lg-3">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Cerca per nome</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i
                                        class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control border-start-0 ps-0"
                                    placeholder="Es. Farina..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-6 col-md-2 col-lg-2">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Kcal Min</label>
                            <input type="number" step="any" name="kcal_min" class="form-control" placeholder="0"
                                value="{{ request('kcal_min') }}">
                        </div>

                        <div class="col-6 col-md-2 col-lg-2">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Kcal Max</label>
                            <input type="number" step="any" name="kcal_max" class="form-control" placeholder="1000"
                                value="{{ request('kcal_max') }}">
                        </div>

                        <div class="col-12 col-sm-4 col-md-4 col-lg-1">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Mostra</label>
                            <select name="per_page" class="form-select">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </div>

                        <div class="col-6 col-sm-4 col-md-6 col-lg-2">
                            <label class="form-label small fw-bold text-secondary text-uppercase">Allergeni
                                Accettati</label>
                            <div class="dropdown">
                                <button
                                    class="btn btn-white border w-100 dropdown-toggle text-start d-flex justify-content-between align-items-center"
                                    type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <span class="text-truncate">Seleziona</span>
                                </button>
                                <div class="dropdown-menu p-3 w-100" style="max-height: 250px; overflow-y: auto;">
                                    @foreach ($allergens as $allergen)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="allergens_include[]"
                                                id="allergens_include-{{ $allergen->id }}" value="{{ $allergen->id }}"
                                                {{ in_array($allergen->id, request('allergens_include', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label text-capitalize small"
                                                for="allergens_include-{{ $allergen->id }}">{{ $allergen->name }}</label>
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
                                    <span class="text-truncate fw-semibold">Escludi</span>
                                </button>
                                <div class="dropdown-menu p-3 w-100" style="max-height: 250px; overflow-y: auto;">
                                    @foreach ($allergens as $allergen)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="allergens_exclude[]"
                                                id="allergens_exclude-{{ $allergen->id }}" value="{{ $allergen->id }}"
                                                {{ in_array($allergen->id, request('allergens_exclude', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label text-capitalize small text-danger"
                                                for="allergens_exclude-{{ $allergen->id }}">{{ $allergen->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end d-flex gap-2 justify-content-end align-items-end mt-3">
                            <a href="{{ route('ingredients.index') }}" class="btn btn-outline-secondary px-3">
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


        {{-- IMPAGINAZIONE PAGINATE (SOTTOSTANTE) --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $ingredients->appends(request()->query())->links() }}
        </div>

        {{-- TABELLA INGREDIENTI NUTRIZIONALI --}}
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark text-uppercase fs-7">
                        <tr>
                            <th scope="col" class="ps-4" style="width: 80px;">ID</th>
                            <th scope="col">Nome Ingrediente</th>
                            <th scope="col" class="text-center">Kcal <span
                                    class="text-muted lowercase small">(100g)</span></th>
                            <th scope="col" class="text-center">Proteine</th>
                            <th scope="col" class="text-center">Grassi</th>
                            <th scope="col" class="text-center">Carboidrati</th>
                            <th scope="col" class="text-center">Fibre</th>
                            <th scope="col" class="text-end pe-4" style="width: 160px;">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ingredients as $ingredient)
                            <tr>
                                <th scope="row" class="ps-4 text-secondary">#{{ $ingredient->id }}</th>
                                <td class="fw-semibold text-dark text-capitalize">{{ $ingredient->name }}</td>
                                <td class="text-center fw-bold text-primary">{{ $ingredient->energy_kcal }}</td>
                                <td class="text-center">{{ $ingredient->proteins }}g</td>
                                <td class="text-center">{{ $ingredient->lipids }}g</td>
                                <td class="text-center">{{ $ingredient->available_carbohydrates }}g</td>
                                <td class="text-center text-muted">{{ $ingredient->total_fiber }}g</td>
                                <td class="pe-4">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a class="btn btn-sm btn-outline-info"
                                            href="{{ route('ingredients.show', $ingredient) }}" title="Visualizza">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-outline-warning"
                                            href="{{ route('ingredients.edit', $ingredient) }}" title="Modifica">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        @auth
                                            @if (auth()->user()->role === 'admin')
                                                <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST"
                                                    onsubmit="return confirm('Sei sicuro di voler eliminare l\'ingrediente: {{ $ingredient->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Elimina">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-outline-danger" disabled
                                                    title="Azione riservata ad Admin">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @endif
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-exclamation-circle fs-3 d-block mb-2"></i>
                                    Nessun ingrediente corrisponde ai criteri di ricerca impostati.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- IMPAGINAZIONE PAGINATE (SOTTOSTANTE) --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $ingredients->appends(request()->query())->links() }}
        </div>

    </div>
@endsection
