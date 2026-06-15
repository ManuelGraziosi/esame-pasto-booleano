@extends('layouts.master')

@section('title')
    {{ $recipe->title }} - Pasto Booleano
@endsection

@section('content')
    <div class="container py-5">

        {{-- HERO CARD PRINCIPALE --}}
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4">

            {{-- Immagine di Copertina --}}
            @if ($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="Immagine di {{ $recipe->title }}" class="w-100"
                    style="max-height: 400px; object-fit: cover;">
            @endif

            <div class="card-body p-4">
                {{-- Intestazione con Titolo e Azioni Rapide --}}
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
                    <h2 class="fw-bold text-dark m-0">{{ $recipe->title }}</h2>

                    <div class="d-flex gap-2">
                        <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning fw-semibold shadow-sm">
                            <i class="bi bi-pencil me-1"></i> Modifica
                        </a>

                        @auth
                            @if (auth()->user()->role === 'admin')
                                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST"
                                    onsubmit="return confirm('Sei sicuro di voler eliminare definitivamente questa ricetta?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger shadow-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>

                <hr class="text-muted opacity-25">

                {{-- Descrizione Breve --}}
                @if ($recipe->description)
                    <div class="mb-3">
                        <h6 class="fw-bold text-secondary text-uppercase small tracking-wider mb-2">Descrizione</h6>
                        <p class="text-secondary lead fs-6 mb-0">{{ $recipe->description }}</p>
                    </div>
                @endif

                {{-- Sezione Allergeni --}}
                @if ($recipe->allergens && $recipe->allergens->count() > 0)
                    <div class="mt-4">
                        <h6 class="fw-bold text-secondary text-uppercase small tracking-wider mb-2">Allergeni Presenti</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($recipe->allergens as $allergen)
                                <span
                                    class="badge rounded-pill px-3 py-2 fw-semibold text-capitalize shadow-sm d-inline-flex align-items-center gap-2"
                                    style="background-color: {{ $allergen->color }}; color: {{ $allergen->text ?? '#ffffff' }};">

                                    @if ($allergen->icon)
                                        <img src="{{ asset('storage/' . $allergen->icon) }}"
                                            alt="Icona {{ $allergen->name }}"
                                            style="width: 18px; height: 18px; object-fit: contain;">
                                    @else
                                        <span>⚠️</span>
                                    @endif

                                    {{ $allergen->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- DETTAGLI: PREPARAZIONE E INGREDIENTI --}}
        <div class="row g-4">

            {{-- PROCESSO DI PREPARAZIONE --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-dark text-white fw-bold py-3">
                        <i class="bi bi-journal-text me-2"></i> Istruzioni di Preparazione
                    </div>
                    <div class="card-body p-4">
                        <p class="text-secondary lh-lg mb-0" style="white-space: pre-line; font-size: 1.05rem;">
                            {{ $recipe->preparation }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- LISTA INGREDIENTI --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-dark text-white fw-bold py-3">
                        <i class="bi bi-egg-fried me-2"></i> Ingredienti e Dosaggi
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-bottom-3">
                            @forelse ($recipe->ingredients as $ingredient)
                                <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                                    <span class="fw-medium text-dark text-capitalize">{{ $ingredient->name }}</span>
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2 fw-bold">
                                        {{ $ingredient->pivot->quantity }} g
                                    </span>
                                </li>
                            @empty
                                <li class="list-group-item text-muted text-center py-4">
                                    Nessun ingrediente associato a questa ricetta.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        {{-- FOOTER DI NAVIGAZIONE E METADATI --}}
        <div
            class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mt-4 pt-3 border-top text-muted small">
            <div>
                <i class="bi bi-calendar-plus me-1"></i> Creato il: {{ $recipe->created_at->format('d/m/Y H:i') }}
                <span class="mx-2 d-none d-sm-inline">|</span>
                <br class="d-block d-sm-none">
                <i class="bi bi-calendar-check me-1"></i> Ultima modifica: {{ $recipe->updated_at->format('d/m/Y H:i') }}
            </div>

            <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary px-4 fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Torna all'elenco
            </a>
        </div>

    </div>
@endsection
