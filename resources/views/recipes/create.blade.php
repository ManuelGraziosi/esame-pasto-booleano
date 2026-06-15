@extends('layouts.master')

@section('title')
    Nuova Ricetta - Pasto Booleano
@endsection

@section('content')
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark m-0">Crea Nuova Ricetta</h2>
            <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle"></i> Annulla
            </a>
        </div>

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                {{-- COLONNA SINISTRA: DATI BASE --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-dark text-white fw-bold py-3">
                            <i class="bi bi-file-earmark-text me-2"></i> Informazioni Principali
                        </div>
                        <div class="card-body p-4">

                            {{-- Titolo --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary">Titolo Ricetta</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Es. Spaghetti alla Carbonara" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Immagine Copertina --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary" for="image">Immagine di
                                    Copertina</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                <small class="text-muted d-block mt-1">Formati accettati: JPG, PNG, WEBP.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Descrizione Breve --}}
                            <div class="mb-0">
                                <label class="form-label fw-semibold text-secondary">Presentazione / Descrizione
                                    Breve</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4"
                                    placeholder="Una breve introduzione al piatto...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- COLONNA DESTRA: INGREDIENTI DINAMICI --}}
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

                                {{-- RIGA BASE --}}
                                <div class="ingredient-row mb-3 d-flex gap-2 align-items-center">
                                    <div class="flex-grow-1">
                                        <select name="ingredients[0][id]" class="form-select">
                                            @foreach ($ingredients as $ingredient)
                                                <option value="{{ $ingredient->id }}">
                                                    {{ $ingredient->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div style="width: 260px;">
                                        <div class="input-group">
                                            <input type="number" name="ingredients[0][quantity]" class="form-control"
                                                placeholder="Dosaggio" min="1" required>
                                            <span class="input-group-text">g</span>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-outline-danger remove-ingredient">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                            </div>
                            @error('ingredients')
                                <small class="text-danger d-block mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- RIGHE SOTTOSTANTI: PREPARAZIONE COMPLETA --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white fw-bold py-3">
                            <i class="bi bi-journal-text me-2"></i> Processo di Preparazione
                        </div>
                        <div class="card-body p-4">
                            <textarea name="preparation" class="form-control @error('preparation') is-invalid @enderror" rows="6"
                                placeholder="Fase 1...&#10;Fase 2..." required>{{ old('preparation') }}</textarea>
                            @error('preparation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- PULSANTIERA DI SALVATAGGIO --}}
                <div class="col-12 text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm fw-semibold">
                        <i class="bi bi-check-lg me-2"></i> Salva Ricetta
                    </button>
                </div>

            </div>
        </form>
    </div>


    <script>
        let index = 1;

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
                <div style="width: 140px;">
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

        // Intercettazione click eliminazione con controllo di salvaguardia
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-ingredient');
            if (btn) {
                const totalRows = document.querySelectorAll('.ingredient-row').length;
                if (totalRows > 1) {
                    btn.closest('.ingredient-row').remove();
                } else {
                    alert('Una ricetta valida deve contenere almeno un ingrediente.');
                }
            }
        });
    </script>
@endsection
