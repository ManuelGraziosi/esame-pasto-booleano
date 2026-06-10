@extends('layouts.master')

@section('content')
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card shadow-sm">

                    <div class="card-header">
                        <h4 class="mb-0">Modifica ingrediente</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('ingredients.update', $ingredient) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <h5 class="mb-3">Informazioni base</h5>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nome</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $ingredient->name }}" required>

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="col-md-6 mb-3">
                                    <label class="form-label">Categoria</label>
                                    <select name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror">

                                        <option value="">-- Seleziona --</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $ingredient->category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                            </div>


                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control bg-light"
                                    value="{{ $ingredient->slug }}" readonly>
                            </div>

                            <hr>

                            {{-- ALLERGENI --}}

                            <h5 class="mb-3">Allergeni</h5>

                            <div class="row">
                                @foreach ($allergens as $allergen)
                                    <div class="col-md-3 mb-3">
                                        <input class="form-check-input" type="checkbox" name="allergens[]"
                                            value="{{ $allergen->id }}" id="allergens-{{ $allergen->id }}"
                                            {{ $ingredient->allergens->contains($allergen->id) ? 'checked' : '' }}>
                                        <label class="form-label"
                                            for="allergens-{{ $allergen->id }}">{{ $allergen->name }}</label>
                                    </div>
                                @endforeach

                            </div>
                            <hr>


                            {{-- MACRONUTRIENTI --}}

                            <h5 class="mb-3">Valori nutrizionali principali</h5>

                            <div class="row">

                                <div class="col-md-3 mb-3">
                                    <label>Kcal</label>
                                    <input type="number" step="0.01" name="energy_kcal" class="form-control"
                                        value="{{ $ingredient->energy_kcal }}">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Proteine (g)</label>
                                    <input type="number" step="0.01" name="proteins" class="form-control"
                                        value="{{ $ingredient->proteins }}">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Grassi (g)</label>
                                    <input type="number" step="0.01" name="lipids" class="form-control"
                                        value="{{ $ingredient->lipids }}">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label>Carboidrati (g)</label>
                                    <input type="number" step="0.01" name="available_carbohydrates" class="form-control"
                                        value="{{ $ingredient->available_carbohydrates }}">
                                </div>

                            </div>

                            <hr>


                            {{-- DETTAGLI AVANZATI --}}

                            <button class="btn btn-outline-secondary mb-3" type="button" data-bs-toggle="collapse"
                                data-bs-target="#advanced">
                                Mostra dettagli avanzati
                            </button>

                            <div class="collapse" id="advanced">

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label>Fibre</label>
                                        <input type="number" step="0.01" name="total_fiber" class="form-control"
                                            value="{{ $ingredient->total_fiber }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Ferro</label>
                                        <input type="number" step="0.01" name="iron" class="form-control"
                                            value="{{ $ingredient->iron }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Sodio</label>
                                        <input type="number" step="0.01" name="sodium" class="form-control"
                                            value="{{ $ingredient->sodium }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Calcio</label>
                                        <input type="number" step="0.01" name="calcium" class="form-control"
                                            value="{{ $ingredient->calcium }}">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Potassio</label>
                                        <input type="number" step="0.01" name="potassium" class="form-control"
                                            value="{{ $ingredient->potassium }}">
                                    </div>
                                </div>

                            </div>

                            {{-- BOTTONI --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">
                                    ← Annulla
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    Salva
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
