@extends('layouts.master')


@section('title')
    Elenco Allergeni
@endsection

@section('content')
    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf

        <div class="container py-4">

            <div class="row">

                {{-- COLONNA SINISTRA --}}
                <div class="col-md-6">

                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <strong>Dati base</strong>
                        </div>

                        <div class="card-body">

                            {{-- titolo --}}
                            <div class="mb-3">
                                <label class="form-label">Titolo</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            {{-- immagine (temporaneo URL) --}}
                            <div class="mb-3">
                                <label class="form-label">Immagine (URL)</label>
                                <input type="text" name="image" class="form-control">
                            </div>

                            {{-- descrizione --}}
                            <div class="mb-3">
                                <label class="form-label">Descrizione</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                        </div>
                    </div>

                </div>

                {{-- COLONNA DESTRA --}}
                <div class="col-md-6">

                    {{-- INGREDIENTI --}}
                    <div class="card shadow-sm mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <strong>Ingredienti</strong>

                            <button type="button" id="add-ingredient" class="btn btn-sm btn-primary">
                                + Aggiungi
                            </button>
                        </div>

                        <div class="card-body" id="ingredients-container">

                            {{-- RIGA BASE --}}
                            <div class="ingredient-row mb-3 d-flex gap-2">

                                <select name="ingredients[0][id]" class="form-select">
                                    @foreach ($ingredients as $ingredient)
                                        <option value="{{ $ingredient->id }}">
                                            {{ $ingredient->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <input type="text" name="ingredients[0][quantity]" class="form-control"
                                    placeholder="Quantità">

                                <button type="button" class="btn btn-danger remove-ingredient">
                                    ✕
                                </button>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            {{-- PREPARAZIONE --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <strong>Preparazione</strong>
                </div>

                <div class="card-body">
                    <textarea name="preparation" class="form-control" rows="6"></textarea>
                </div>
            </div>

            {{-- SUBMIT --}}
            <button class="btn btn-success">
                Salva ricetta
            </button>

        </div>
    </form>

    <script>
        let index = 1;

        document.getElementById('add-ingredient').addEventListener('click', function() {

            const container = document.getElementById('ingredients-container');

            const row = document.createElement('div');
            row.classList.add('ingredient-row', 'mb-3', 'd-flex', 'gap-2');

            row.innerHTML = `
        <select name="ingredients[${index}][id]" class="form-select">
            @foreach ($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}">
                    {{ $ingredient->name }}
                </option>
            @endforeach
        </select>

        <input type="text" 
               name="ingredients[${index}][quantity]" 
               class="form-control" 
               placeholder="Quantità">

        <button type="button" class="btn btn-danger remove-ingredient">✕</button>
    `;

            container.appendChild(row);

            index++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-ingredient')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection
