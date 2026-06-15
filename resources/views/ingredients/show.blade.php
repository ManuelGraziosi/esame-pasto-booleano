@extends('layouts.master')

@section('title')
    {{ $ingredient->name }} - Dettaglio Ingrediente
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                {{-- SCHEDA INGREDIENTE PRINCIPALE --}}
                <div class="card shadow-sm border-0 rounded-3 overflow-hidden">

                    {{-- INTESTAZIONE SCHEDA --}}
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3 px-4">
                        <div>
                            <h3 class="mb-0 fw-bold text-capitalize">{{ $ingredient->name }}</h3>
                            @if ($ingredient->category)
                                <span class="badge bg-primary mt-1">{{ $ingredient->category->name }}</span>
                            @else
                                <small class="text-muted-light fs-7">Nessuna categoria assegnata</small>
                            @endif
                        </div>

                        {{-- PULSANTI DI AZIONE --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('ingredients.edit', $ingredient) }}"
                                class="btn btn-sm btn-warning fw-semibold shadow-sm">
                                <i class="bi bi-pencil me-1"></i> Modifica
                            </a>

                            @auth
                                @if (auth()->user()->role === 'admin')
                                    <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST"
                                        onsubmit="return confirm('Sei sicuro di voler eliminare definitivamente questo ingrediente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                            <i class="bi bi-trash me-1"></i> Elimina
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>

                    {{-- CORPO DELLA SCHEDA --}}
                    <div class="card-body p-4">

                        {{-- GRIGLIA MACRONUTRIENTI (Su base 100g) --}}
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold text-secondary text-uppercase small tracking-wider m-0">Profilo Nutrizionale
                                Principale</h6>
                            <span class="badge bg-secondary-subtle text-secondary fw-semibold">Valori medi per 100g</span>
                        </div>

                        <div class="row g-3 text-center mb-4">
                            <div class="col-6 col-md-3">
                                <div class="bg-light border border-light rounded-3 p-3 h-100 shadow-2xs">
                                    <span class="text-uppercase small fw-bold text-muted d-block mb-1">Energia</span>
                                    <span class="fs-4 fw-bold text-primary">{{ $ingredient->energy_kcal ?? '0' }}</span>
                                    <span class="text-secondary small d-block">Kcal</span>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="bg-light border border-light rounded-3 p-3 h-100 shadow-2xs">
                                    <span class="text-uppercase small fw-bold text-muted d-block mb-1">Proteine</span>
                                    <span class="fs-4 fw-bold text-dark">{{ $ingredient->proteins ?? '0' }}</span>
                                    <span class="text-secondary small d-block">grammi (g)</span>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="bg-light border border-light rounded-3 p-3 h-100 shadow-2xs">
                                    <span class="text-uppercase small fw-bold text-muted d-block mb-1">Grassi</span>
                                    <span class="fs-4 fw-bold text-dark">{{ $ingredient->lipids ?? '0' }}</span>
                                    <span class="text-secondary small d-block">grammi (g)</span>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="bg-light border border-light rounded-3 p-3 h-100 shadow-2xs">
                                    <span class="text-uppercase small fw-bold text-muted d-block mb-1">Carboidrati</span>
                                    <span
                                        class="fs-4 fw-bold text-dark">{{ $ingredient->available_carbohydrates ?? '0' }}</span>
                                    <span class="text-secondary small d-block">grammi (g)</span>
                                </div>
                            </div>
                        </div>

                        {{-- SEZIONE ALLERGENI ASSOCIATI --}}
                        @if ($ingredient->allergens && $ingredient->allergens->count() > 0)
                            <div class="mb-4">
                                <h6 class="fw-bold text-secondary text-uppercase small tracking-wider mb-2">Allergeni
                                    Collegati</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($ingredient->allergens as $allergen)
                                        <span
                                            class="badge rounded-pill px-3 py-2 fw-semibold text-capitalize shadow-sm d-inline-flex align-items-center gap-2"
                                            style="background-color: {{ $allergen->color }}; color: {{ $allergen->text ?? '#ffffff' }};">
                                            @if ($allergen->icon)
                                                <img src="{{ asset('storage/' . $allergen->icon) }}"
                                                    alt="Icona {{ $allergen->name }}"
                                                    style="width: 16px; height: 16px; object-fit: contain;">
                                            @else
                                                <span>⚠️</span>
                                            @endif
                                            {{ $allergen->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <hr class="text-muted opacity-25">

                        {{-- SEZIONE DETTAGLI NUTRIZIONALI AVANZATI (COLLAPSE) --}}
                        <div class="mb-4">
                            <button class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-2 mb-3"
                                type="button" data-bs-toggle="collapse" data-bs-target="#advancedNutrients"
                                aria-expanded="false">
                                <i class="bi bi-grid-3x3-gap"></i> Mostra Micronutrienti e Fibre
                            </button>

                            <div class="collapse" id="advancedNutrients">
                                <div class="bg-light rounded-3 p-4">
                                    <div class="row g-3">
                                        <div class="col-sm-6 col-md-4">
                                            <div class="d-flex justify-content-between border-bottom pb-2">
                                                <span class="text-secondary fw-medium">Fibre totali:</span>
                                                <span class="fw-bold text-dark">{{ $ingredient->total_fiber ?? '0' }}
                                                    g</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="d-flex justify-content-between border-bottom pb-2">
                                                <span class="text-secondary fw-medium">Sodio:</span>
                                                <span class="fw-bold text-dark">{{ $ingredient->sodium ?? '0' }} mg</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="d-flex justify-content-between border-bottom pb-2">
                                                <span class="text-secondary fw-medium">Calcio:</span>
                                                <span class="fw-bold text-dark">{{ $ingredient->calcium ?? '0' }} mg</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="d-flex justify-content-between border-bottom pb-2">
                                                <span class="text-secondary fw-medium">Ferro:</span>
                                                <span class="fw-bold text-dark">{{ $ingredient->iron ?? '0' }} mg</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="d-flex justify-content-between border-bottom pb-2">
                                                <span class="text-secondary fw-medium">Potassio:</span>
                                                <span class="fw-bold text-dark">{{ $ingredient->potassium ?? '0' }}
                                                    mg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="text-muted opacity-25">

                        {{-- DETTAGLI DI SISTEMA (METADATI) --}}
                        <div class="row g-2 text-muted small bg-light rounded p-3 mb-3 fs-7">
                            <div class="col-md-4">
                                <strong><i class="bi bi-link-45deg"></i> Slug:</strong> <code
                                    class="text-dark">{{ $ingredient->slug }}</code>
                            </div>
                            <div class="col-md-4">
                                <strong><i class="bi bi-calendar-plus"></i> Creato il:</strong>
                                {{ $ingredient->created_at->format('d/m/Y H:i') }}
                            </div>
                            <div class="col-md-4">
                                <strong><i class="bi bi-calendar-check"></i> Modificato il:</strong>
                                {{ $ingredient->updated_at->format('d/m/Y H:i') }}
                            </div>
                        </div>

                        {{-- PULSANTE DI RITORNO --}}
                        <div class="mt-4 pt-2 border-top">
                            <a href="{{ route('ingredients.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Torna all'elenco ingredienti
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
