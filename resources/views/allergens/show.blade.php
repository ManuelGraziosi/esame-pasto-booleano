@extends('layouts.master')

@section('title')
    Allergene: {{ $allergen->name }}
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- SCHEDA INFORMATIVA DELL'ALLERGENE --}}
                <div class="card shadow-sm border-0 rounded-3 overflow-hidden">

                    {{-- INTESTAZIONE DELLA CARD --}}
                    <div class="card-header bg-dark text-white d-flex align-items-center justify-content-between py-3 px-4">
                        <div class="d-flex align-items-center gap-3">
                            @if ($allergen->icon)
                                <div class="p-1 bg-white rounded shadow-2xs d-flex align-items-center justify-content-center"
                                    style="width: 42px; height: 42px;">
                                    <img src="{{ asset('storage/' . $allergen->icon) }}" alt="Icona {{ $allergen->name }}"
                                        class="img-fluid" style="max-height: 100%; object-fit: contain;">
                                </div>
                            @else
                                <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center fs-5 shadow-2xs"
                                    style="width: 42px; height: 42px;">
                                    <i class="bi bi-shield-exclamation"></i>
                                </div>
                            @endif
                            <h4 class="mb-0 fw-bold">{{ $allergen->name }}</h4>
                        </div>

                        {{-- AZIONI RAPIDE (EDIT / MODAL TRIGGER) --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('allergens.edit', $allergen) }}"
                                class="btn btn-sm btn-warning fw-semibold text-dark px-3 shadow-2xs">
                                <i class="bi bi-pencil me-1"></i> Modifica
                            </a>

                            @auth
                                @if (auth()->user()->role === 'admin')
                                    <button type="button" class="btn btn-sm btn-danger fw-semibold px-3 shadow-2xs"
                                        data-bs-toggle="modal" data-bs-target="#deleteAllergenModal">
                                        <i class="bi bi-trash me-1"></i> Elimina
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-danger px-3" disabled
                                        title="Azione riservata agli amministratori">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endif
                            @else
                                <button class="btn btn-sm btn-danger px-3" disabled
                                    title="Effettua il login come admin per eliminare">
                                    <i class="bi bi-trash"></i>
                                </button>
                            @endauth
                        </div>
                    </div>

                    {{-- CORPO DEI DETTAGLI --}}
                    <div class="card-body p-4 bg-white">
                        <div class="row g-4 mb-4">
                            {{-- SLUG GENERATO --}}
                            <div class="col-sm-6">
                                <label
                                    class="text-uppercase text-secondary fw-bold small d-block mb-1 tracking-wider">Identificativo
                                    URL (Slug)</label>
                                <div class="p-2 border rounded bg-light">
                                    <code class="text-dark font-monospace fs-6">{{ $allergen->slug }}</code>
                                </div>
                            </div>

                            {{-- ANTEPRIMA GRAFICA DEL BADGE --}}
                            <div class="col-sm-6">
                                <label
                                    class="text-uppercase text-secondary fw-bold small d-block mb-1 tracking-wider">Anteprima
                                    Etichetta Grafica</label>
                                <div
                                    class="p-2 border rounded bg-light d-flex align-items-center justify-content-start gap-2">
                                    <span class="badge px-3 py-2 fw-semibold text-capitalize shadow-3xs rounded-3 fs-6"
                                        style="background-color: {{ $allergen->color ?? '#6c757d' }}; color: {{ $allergen->text ?? '#ffffff' }}; border: 1px solid rgba(0,0,0,0.1)">
                                        {{ $allergen->name }}
                                    </span>
                                    <span class="text-muted small">Hex: <code>{{ $allergen->color }}</code></span>
                                </div>
                            </div>
                        </div>

                        <hr class="text-muted opacity-25 my-4">

                        {{-- DESCRIZIONE TESTUALE --}}
                        <div class="mb-2">
                            <label
                                class="text-uppercase text-secondary fw-bold small d-block mb-2 tracking-wider">Descrizione
                                Clinico-Alimentare</label>
                            <div class="p-3 border rounded bg-white text-muted shadow-3xs" style="line-height: 1.6;">
                                {{ $allergen->description ?? 'Nessuna descrizione o nota informativa inserita per questo specifico allergene.' }}
                            </div>
                        </div>
                    </div>

                    {{-- PIÈ DI PAGINA CRONOLOGIA --}}
                    <div
                        class="card-footer bg-light border-top text-muted py-2.5 px-4 d-flex justify-content-between fs-7 font-monospace">
                        <div><i class="bi bi-calendar-plus me-1"></i>Inserito:
                            {{ $allergen->created_at->format('d/m/Y H:i') }}</div>
                        <div><i class="bi bi-calendar-check me-1"></i>Ultima modifica:
                            {{ $allergen->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>

                {{-- PULSANTE DI RITORNO --}}
                <div class="mt-4">
                    <a href="{{ route('allergens.index') }}" class="btn btn-outline-secondary px-4 fw-medium shadow-2xs">
                        <i class="bi bi-arrow-left me-1"></i> Torna al registro allergeni
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL DI CONFERMA ELIMINAZIONE BOOTSTRAP (SOLO PER ADMIN) --}}
    @auth
        @if (auth()->user()->role === 'admin')
            <div class="modal fade" id="deleteAllergenModal" tabindex="-1" aria-labelledby="deleteAllergenModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">

                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title fw-bold" id="deleteAllergenModalLabel">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>Conferma Eliminazione
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body p-4 text-center">
                            <i class="bi bi-trash text-danger fs-1 d-block mb-3"></i>
                            <p class="fs-5 fw-medium text-dark mb-1">Stai eliminando l'allergene:
                                <strong>{{ $allergen->name }}</strong></p>
                            <p class="text-muted small mb-0">Sei sicuro di voler procedere? L'azione rimuoverà questa
                                associazione da tutti gli ingredienti correlati e non potrà essere annullata.</p>
                        </div>

                        <div class="modal-footer bg-light border-top">
                            <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Annulla</button>

                            <form action="{{ route('allergens.destroy', $allergen) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4 fw-bold">Elimina definitivamente</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection
