@extends('layouts.master')

@section('title')
    Nuovo Ingrediente - Pasto Booleano
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-dark text-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-plus-circle me-2"></i>Crea Nuovo Ingrediente
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('ingredients.store') }}" method="POST">
                            @csrf

                            {{-- SEZIONE: DATI BASE --}}
                            <div class="mb-4">
                                <h6 class="fw-bold text-secondary text-uppercase small tracking-wider mb-3">Informazioni
                                    Base</h6>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-medium">Nome Ingrediente</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Es. Olio Extravergine" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="slug" class="form-label fw-medium text-muted">Slug URL (Generato
                                            Automaticamente)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-muted"><i
                                                    class="bi bi-link-45deg"></i></span>
                                            <input type="text" name="slug" id="slug"
                                                class="form-control bg-light @error('slug') is-invalid @enderror"
                                                value="{{ old('slug') }}" readonly>
                                        </div>
                                        @error('slug')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="text-muted opacity-25">

                            {{-- SEZIONE: MACRONUTRIENTI (Su 100g) --}}
                            <div class="mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="fw-bold text-secondary text-uppercase small tracking-wider m-0">Valori
                                        Nutrizionali Principali</h6>
                                    <span class="badge bg-secondary-subtle text-secondary fw-semibold">Riferimento su
                                        100g</span>
                                </div>

                                <div class="row g-3">
                                    <div class="col-6 col-md-3">
                                        <label for="energy_kcal" class="form-label fw-medium">Energia (Kcal)</label>
                                        <input type="number" step="0.01" min="0" name="energy_kcal"
                                            id="energy_kcal" class="form-control @error('energy_kcal') is-invalid @enderror"
                                            value="{{ old('energy_kcal', 0) }}">
                                        @error('energy_kcal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-6 col-md-3">
                                        <label for="proteins" class="form-label fw-medium">Proteine (g)</label>
                                        <input type="number" step="0.01" min="0" name="proteins" id="proteins"
                                            class="form-control @error('proteins') is-invalid @enderror"
                                            value="{{ old('proteins', 0) }}">
                                        @error('proteins')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-6 col-md-3">
                                        <label for="lipids" class="form-label fw-medium">Grassi (g)</label>
                                        <input type="number" step="0.01" min="0" name="lipids" id="lipids"
                                            class="form-control @error('lipids') is-invalid @enderror"
                                            value="{{ old('lipids', 0) }}">
                                        @error('lipids')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-6 col-md-3">
                                        <label for="available_carbohydrates" class="form-label fw-medium">Carboidrati
                                            (g)</label>
                                        <input type="number" step="0.01" min="0" name="available_carbohydrates"
                                            id="available_carbohydrates"
                                            class="form-control @error('available_carbohydrates') is-invalid @enderror"
                                            value="{{ old('available_carbohydrates', 0) }}">
                                        @error('available_carbohydrates')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="text-muted opacity-25">

                            {{-- SEZIONE: DETTAGLI AVANZATI (COLLAPSE) --}}
                            <div class="mb-4">
                                <button class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2 mb-3"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#advancedNutrition"
                                    aria-expanded="false">
                                    <i class="bi bi-sliders"></i> Mostra Micronutrienti e Fibre
                                </button>

                                <div class="collapse @if ($errors->hasAny(['total_fiber', 'iron', 'sodium', 'calcium', 'potassium'])) show @endif" id="advancedNutrition">
                                    <div class="card card-body border-0 bg-light p-3 rounded-3">
                                        <div class="row g-3">
                                            <div class="col-6 col-md-4">
                                                <label for="total_fiber" class="form-label small fw-medium">Fibre
                                                    (g)</label>
                                                <input type="number" step="0.01" min="0" name="total_fiber"
                                                    id="total_fiber"
                                                    class="form-control @error('total_fiber') is-invalid @enderror"
                                                    value="{{ old('total_fiber') }}">
                                                @error('total_fiber')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-6 col-md-4">
                                                <label for="iron" class="form-label small fw-medium">Ferro
                                                    (mg)</label>
                                                <input type="number" step="0.01" min="0" name="iron"
                                                    id="iron"
                                                    class="form-control @error('iron') is-invalid @enderror"
                                                    value="{{ old('iron') }}">
                                                @error('iron')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-6 col-md-4">
                                                <label for="sodium" class="form-label small fw-medium">Sodio
                                                    (mg)</label>
                                                <input type="number" step="0.01" min="0" name="sodium"
                                                    id="sodium"
                                                    class="form-control @error('sodium') is-invalid @enderror"
                                                    value="{{ old('sodium') }}">
                                                @error('sodium')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-6 col-md-4">
                                                <label for="calcium" class="form-label small fw-medium">Calcio
                                                    (mg)</label>
                                                <input type="number" step="0.01" min="0" name="calcium"
                                                    id="calcium"
                                                    class="form-control @error('calcium') is-invalid @enderror"
                                                    value="{{ old('calcium') }}">
                                                @error('calcium')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-6 col-md-4">
                                                <label for="potassium" class="form-label small fw-medium">Potassio
                                                    (mg)</label>
                                                <input type="number" step="0.01" min="0" name="potassium"
                                                    id="potassium"
                                                    class="form-control @error('potassium') is-invalid @enderror"
                                                    value="{{ old('potassium') }}">
                                                @error('potassium')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- BOTTONI DI SALVATAGGIO / ANNULLAMENTO --}}
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                                <a href="{{ route('ingredients.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-arrow-left me-1"></i> Annulla
                                </a>
                                <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                                    <i class="bi bi-check-lg me-1"></i> Salva Ingrediente
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
