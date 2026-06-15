@extends('layouts.master')

@section('title')
    Modifica Allergene: {{ $allergen->name }}
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-dark text-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-pencil-square me-2"></i>Modifica Allergene
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('allergens.update', $allergen) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- SEZIONE 1: ANAGRAFICA --}}
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-medium">Nome Allergene</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $allergen->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="slug" class="form-label fw-medium text-muted">Slug (Generato
                                        automaticamente)</label>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control bg-light @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $allergen->slug) }}" readonly tabindex="-1">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- SEZIONE 2: PERSONALIZZAZIONE ESTETICA --}}
                            <div class="card bg-light border-0 rounded-3 p-3 mb-4">
                                <h6 class="fw-bold text-secondary text-uppercase small tracking-wider mb-3">Aspetto del
                                    Badge</h6>

                                <div class="row g-3 align-items-center">
                                    <div class="col-6 col-sm-4">
                                        <label for="color" class="form-label small fw-medium">Colore Sfondo</label>
                                        <input type="color" name="color" id="color"
                                            class="form-control form-control-color w-100 @error('color') is-invalid @enderror"
                                            value="{{ old('color', $allergen->color ?? '#6c757d') }}" required>
                                        @error('color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-6 col-sm-4">
                                        <label for="text" class="form-label small fw-medium">Colore Testo</label>
                                        <input type="color" name="text" id="text"
                                            class="form-control form-control-color w-100 @error('text') is-invalid @enderror"
                                            value="{{ old('text', $allergen->text ?? '#ffffff') }}" required>
                                        @error('text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Box Anteprima in tempo reale --}}
                                    <div class="col-12 col-sm-4 text-center">
                                        <span class="small d-block text-muted mb-2">Anteprima Tag:</span>
                                        <span id="badge-preview"
                                            class="badge px-3 py-2 fw-semibold text-capitalize shadow-2xs rounded-3"
                                            style="background-color: {{ old('color', $allergen->color ?? '#6c757d') }}; color: {{ old('text', $allergen->text ?? '#ffffff') }}; border: 1px solid rgba(0,0,0,0.1)">
                                            {{ old('name', $allergen->name ?? 'Esempio') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- SEZIONE 3: DESCRIZIONE --}}
                            <div class="mb-4">
                                <label for="description" class="form-label fw-medium">Descrizione / Note informative</label>
                                <textarea name="description" id="description" rows="3"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Inserisci informazioni utili o riferimenti clinici relativi all'allergene...">{{ old('description', $allergen->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SEZIONE 4: ICONA UPLOAD --}}
                            <div class="mb-4 p-3 border rounded-3 bg-white">
                                <label for="icon" class="form-label fw-medium">Icona Identificativa</label>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-grow-1">
                                        <input type="file" name="icon" id="icon" accept="image/*"
                                            class="form-control @error('icon') is-invalid @enderror">
                                        <div class="form-text small text-muted">Carica un'immagine quadrata (PNG/SVG
                                            consigliati) con sfondo trasparente.</div>
                                        @error('icon')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Visualizzazione Icona Attuale --}}
                                    <div class="flex-shrink-0 text-center">
                                        @if ($allergen->icon)
                                            <div class="position-relative p-1 border rounded bg-light">
                                                <img class="img-fluid rounded"
                                                    src="{{ asset('storage/' . $allergen->icon) }}"
                                                    alt="Icona {{ $allergen->name }}"
                                                    style="width: 50px; height: 50px; object-fit: contain;">
                                            </div>
                                            <span class="fs-7 text-muted d-block mt-1">Attuale</span>
                                        @else
                                            <div class="d-flex align-items-center justify-content-center border border-dashed rounded bg-light text-muted"
                                                style="width: 55px; height: 55px;">
                                                <i class="bi bi-image fs-4"></i>
                                            </div>
                                            <span class="fs-7 text-muted d-block mt-1">Nessuna</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- PULSANTI DI NAVIGAZIONE --}}
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                                <a href="{{ route('allergens.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-arrow-left me-1"></i> Annulla
                                </a>
                                <button type="submit" class="btn btn-warning px-4 fw-bold shadow-sm text-dark">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Aggiorna Allergene
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- PICCOLO SCRIPT COMPLEMENTARE PER AGGIORNARE L'ANTEPRIMA DEL BADGE IN REAL-TIME --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const colorInput = document.getElementById('color');
            const textInput = document.getElementById('text');
            const preview = document.getElementById('badge-preview');

            function updatePreview() {
                preview.textContent = nameInput.value.trim() || 'Esempio';
                preview.style.backgroundColor = colorInput.value;
                preview.style.color = textInput.value;
            }

            nameInput.addEventListener('input', updatePreview);
            colorInput.addEventListener('input', updatePreview);
            textInput.addEventListener('input', updatePreview);
        });
    </script>
@endsection
