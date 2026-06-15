@extends('layouts.master')

@section('title')
    Elenco Allergeni - Gestione Cucina
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">

                {{-- CONTENITORE PRINCIPALE SCHEDA --}}
                <div class="card shadow-sm border-0 rounded-3">

                    {{-- INTESTAZIONE TABELLA --}}
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3 px-4">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-shield-exclamation me-2"></i>Registro Allergeni
                        </h5>
                        <a class="btn btn-sm btn-primary fw-bold shadow-sm d-inline-flex align-items-center gap-2"
                            href="{{ route('allergens.create') }}">
                            <i class="bi bi-plus-lg"></i> Aggiungi Allergene
                        </a>
                    </div>

                    {{-- CORPO TABELLA --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle mb-0">
                                <thead class="table-light text-uppercase fs-7 tracking-wider text-secondary">
                                    <tr>
                                        <th scope="col" class="ps-4" style="width: 80px;">ID</th>
                                        <th scope="col" style="width: 180px;">Nome / Tag</th>
                                        <th scope="col" style="width: 180px;">Slug</th>
                                        <th scope="col">Descrizione</th>
                                        <th scope="col" class="text-center" style="width: 100px;">Icona</th>
                                        <th scope="col" class="text-end pe-4" style="width: 160px;">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($allergens as $allergen)
                                        <tr>
                                            {{-- ID --}}
                                            <th scope="row" class="ps-4 text-secondary fw-medium">#{{ $allergen->id }}
                                            </th>

                                            {{-- NOME (Rappresentato come badge colorato coerente) --}}
                                            <td>
                                                <span
                                                    class="badge px-2.5 py-2 fw-semibold text-capitalize shadow-2xs rounded-3"
                                                    style="background-color: {{ $allergen->color ?? '#6c757d' }}; color: {{ $allergen->text ?? '#ffffff' }}; border: 1px solid rgba(0,0,0,0.1)">
                                                    {{ $allergen->name }}
                                                </span>
                                            </td>

                                            {{-- SLUG --}}
                                            <td><code class="text-muted small">{{ $allergen->slug }}</code></td>

                                            {{-- DESCRIZIONE --}}
                                            <td>
                                                <span class="text-muted small text-truncate d-inline-block"
                                                    style="max-width: 350px;" title="{{ $allergen->description }}">
                                                    {{ $allergen->description ?? 'Nessuna descrizione inserita.' }}
                                                </span>
                                            </td>

                                            {{-- ICONA GRAFICA --}}
                                            <td class="text-center">
                                                @if ($allergen->icon)
                                                    <img class="img-fluid rounded border p-1 bg-white shadow-2xs"
                                                        src="{{ asset('storage/' . $allergen->icon) }}"
                                                        alt="Icona {{ $allergen->name }}"
                                                        style="width: 36px; height: 36px; object-fit: contain;">
                                                @else
                                                    <span class="fs-5 text-muted" title="Nessuna icona caricata">--</span>
                                                @endif
                                            </td>

                                            {{-- AZIONI IN LINEA --}}
                                            <td class="text-end pe-4">
                                                <div class="d-inline-flex gap-1.5">
                                                    {{-- Mostra --}}
                                                    <a class="btn btn-sm btn-outline-info"
                                                        href="{{ route('allergens.show', $allergen) }}"
                                                        title="Visualizza dettagli">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    {{-- Modifica --}}
                                                    <a class="btn btn-sm btn-outline-warning"
                                                        href="{{ route('allergens.edit', $allergen) }}" title="Modifica">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    {{-- Elimina (con autorizzazione e fallback visivo universale) --}}
                                                    @auth
                                                        @if (auth()->user()->role === 'admin')
                                                            <form action="{{ route('allergens.destroy', $allergen) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Sei sicuro di voler eliminare definitivamente l\'allergene: {{ $allergen->name }}?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                    title="Elimina">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-sm btn-outline-danger" disabled
                                                                title="Azione riservata agli amministratori">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button class="btn btn-sm btn-outline-danger" disabled
                                                            title="Accedi come admin per eliminare">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endauth
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="bi bi-info-circle fs-2 d-block mb-2"></i>
                                                Nessun allergene censito nel database.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
