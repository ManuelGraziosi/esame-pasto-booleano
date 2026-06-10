@extends('layouts.master')


@section('content')
    <div class="card-header d-flex justify-content-between align-items-center m-4">

        <div>
            <h3 class="mb-0">{{ $ingredient->name }}</h3>
            <small class="text-muted">{{ $ingredient->category->name ?? '' }}</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('ingredients.edit', $ingredient) }}" class="btn btn-warning">
                <i class="bi bi-pencil">Modifica</i>
            </a>

            @auth
                @if (auth()->user()->role === 'admin')
                    <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            <i class="bi bi-trash">Elimina</i>
                        </button>
                    </form>
                @endif
            @endauth
        </div>

    </div>
    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-3">
                <div class="border rounded p-2">
                    <strong>Kcal</strong>
                    <div>{{ $ingredient->energy_kcal ?? '-' }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="border rounded p-2">
                    <strong>Proteine</strong>
                    <div>{{ $ingredient->proteins ?? '-' }} g</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="border rounded p-2">
                    <strong>Grassi</strong>
                    <div>{{ $ingredient->lipids ?? '-' }} g</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="border rounded p-2">
                    <strong>Carboidrati</strong>
                    <div>{{ $ingredient->available_carbohydrates ?? '-' }} g</div>
                </div>
            </div>

        </div>

        <hr>

        ALLERGENI
        <div id="allergens">
            @foreach ($ingredient->allergens as $allergen)
                <span class="badge"
                    style="background: {{ $allergen->color }}; text : {{ $allergen->text }}">{{ $allergen->name }}</span>
            @endforeach
        </div>

        <hr>

        <button class="btn btn-outline-secondary mb-2" data-bs-toggle="collapse" data-bs-target="#nutrients">
            Mostra dettagli nutrizionali
        </button>

        <div class="collapse" id="nutrients">
            <div class="row">

                <div class="col-md-6">
                    <p><strong>Fibre:</strong> {{ $ingredient->total_fiber ?? '-' }}</p>
                    <p><strong>Sodio:</strong> {{ $ingredient->sodium ?? '-' }}</p>
                    <p><strong>Calcio:</strong> {{ $ingredient->calcium ?? '-' }}</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Ferro:</strong> {{ $ingredient->iron ?? '-' }}</p>
                    <p><strong>Potassio:</strong> {{ $ingredient->potassium ?? '-' }}</p>
                </div>

            </div>
        </div>
        <hr>

        <div class="small text-muted">
            <p><strong>Slug:</strong> {{ $ingredient->slug }}</p>
            <p><strong>Creato:</strong> {{ $ingredient->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Aggiornato:</strong> {{ $ingredient->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        {{-- BACK BUTTON --}}
        <div class="mt-3">
            <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">
                ← Torna alla lista
            </a>
        </div>

    </div>
@endsection
