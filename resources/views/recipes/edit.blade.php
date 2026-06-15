@extends('layouts.master')

@section('title')
    Modifica Ricetta - {{ $recipe->title }}
@endsection

@section('content')
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="text-muted text-uppercase small fw-bold">Pannello Modifica</span>
                <h2 class="fw-bold text-dark m-0">{{ $recipe->title }}</h2>
            </div>
            <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Torna all'elenco
            </a>
        </div>

        <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- COLONNA SINISTRA: DATI BASE & ANTEPRIMA MEDIA --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-dark text-white fw-bold py-3">
                            <i class="bi bi-file-earmark-text me-2"></i> Informazioni Principali
                        </div>
                        <div class="card-body p-4">

                            {{-- Titolo --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary">Titolo Ricetta</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $recipe->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Sezione Immagine --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary" for="image">Aggiorna
                                    Immagine</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($recipe->image)
                                    <div class="mt-3 p-3 bg-light border rounded-3 text-center position-relative">
                                        <p class="small text-secondary fw-semibold text-start mb-2">Immagine Attuale:</p>
                                        <img src="{{ asset('storage/' . $recipe->image) }}"
                                            alt="Immagine {{ $recipe->title }}" class="img-thumbnail shadow-sm mb-2"
                                            style="max-height: 180px;">

                                        <div class="form-check d-flex justify-content-center align-items-center gap-2 mt-1">
                                            <input type="checkbox" name="remove_image" value="1"
                                                class="form-check-input mt-0" id="removeImage">
                                            <label for="removeImage" class="form-check-label text-danger fw-semibold small">
                                                ❌ Rimuovi questa immagine definitivamente
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Descrizione --}}
                            <div class="mb-0">
                                <label class="form-label fw-semibold text-secondary">Presentazione / Descrizione
                                    Breve</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $recipe->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- COLONNA DESTRA: INGREDIENTI ASSOCIATI --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                            <span class="fw-bold"><i class="bi bi-egg-fried me-2"></i> Composizione Ingredienti</span>
                            <button type="button" id="add-ingredient" class="btn btn-sm btn-light fw-bold px-3">
                                <i class="bi bi-plus"></i> Aggiungi
                            </button>
                        </div>

                        <div class="card-body p-4">
                            <div id="ingredients-container">

                                {{-- CICLO DELLE RIGHE SALVATE NEL DATABASE --}}
                                @foreach ($recipe->ingredients as $index => $ingredient)
                                    <div class="ingredient-row mb-3 d-flex gap-2 align-items-center">

                                        <div class="flex-grow-1">
                                            <select name="ingredients[{{ $index }}][id]" class="form-select">
                                                @foreach ($ingredients as $ing)
                                                    <option value="{{ $ing->id }}"
                                                        {{ $ing->id == $ingredient->id ? 'selected' : '' }}>
                                                        {{ $ing->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="width: 260px;">
                                            <div class="input-group">
                                                <input type="number" name="ingredients[{{ $index }}][quantity]"
                                                    class="form-control" value="{{ $ingredient->pivot->quantity }}"
                                                    placeholder="Dosaggio" min="1" required>
                                                <span class="input-group-text">g</span>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-outline-danger remove-ingredient">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                @endforeach

                            </div>
                            @error('ingredients')
                                <small class="text-danger d-block mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- RIGHE SOTTOSTANTI: PREPARAZIONE --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white fw-bold py-3">
                            <i class="bi bi-journal-text me-2"></i> Processo di Preparazione
                        </div>
                        <div class="card-body p-4">
                            <textarea name="preparation" class="form-control @error('preparation') is-invalid @enderror" rows="6" required>{{ old('preparation', $recipe->preparation) }}</textarea>
                            @error('preparation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="col-12 text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm fw-semibold">
                        <i class="bi bi-arrow-repeat me-2"></i> Aggiorna Ricetta
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- SCRIPT COMPATIBILE ED EVOLUTO --}}
    <script>
        // Sincronizziamo l'indice di partenza con il numero reale di ingredienti già stampati a schermo
        let index = {{ $recipe->ingredients->count() }};

        document.getElementById('add-ingredient').addEventListener('click', function() {
            const container = document.getElementById('ingredients-container');

            const row = document.createElement('div');
            row.classList.add('ingredient-row', 'mb-3', 'd-flex', 'gap-2', 'align-items-center');

            row.innerHTML = `
                <div class="flex-grow-1">
                    <select name="ingredients[${index}][id]" class="form-select">
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="width: 260px;">
                    <div class="input-group">
                        <input type="number" name="ingredients[${index}][quantity]" class="form-control" placeholder="Dosaggio" min="1" required>
                        <span class="input-group-text">g</span>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-danger remove-ingredient">
                    <i class="bi bi-trash"></i>
                </button>
            `;

            container.appendChild(row);
            index++;
        });

        // Rimozione intercettata in sicurezza
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-ingredient');
            if (btn) {
                const totalRows = document.querySelectorAll('.ingredient-row').length;
                if (totalRows > 1) {
                    btn.closest('.ingredient-row').remove();
                } else {
                    alert('Una ricetta non può essere privata di tutti gli ingredienti.');
                }
            }
        });
    </script>
@endsection
