@extends('layouts.master')

@section('title')
    {{ $recipe->title }}
@endsection

@section('content')
    <div class="container py-4">

        {{-- HERO --}}
        <div class="card shadow-sm mb-4 overflow-hidden">

            {{-- immagine --}}
            @if ($recipe->image)
                {{-- <img src="{{ asset('storage/' . $recipe->image) }}" class="w-100"
                    style="max-height: 350px; object-fit: cover;"> --}}
                <img src="{{ $recipe->image }}" class="w-100" style="max-height: 500px; object-fit: cover;">
            @endif

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h2 class="mb-0">{{ $recipe->title }}</h2>

                    <div class="d-flex gap-2">

                        <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>

                        @auth
                            @if (auth()->user()->role === 'admin')
                                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST"
                                    onsubmit="return confirm('Sei sicuro?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth

                    </div>
                </div>

                {{-- descrizione --}}
                @if ($recipe->description)
                    <p class="text-muted">
                        {{ $recipe->description }}
                    </p>
                @endif

            </div>
        </div>

        <div class="row">

            {{-- INGREDIENTI --}}
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <strong>Ingredienti</strong>
                    </div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">

                            @foreach ($recipe->ingredients as $ingredient)
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ $ingredient->name }}:</span>
                                    <span class="text-muted">
                                        {{ $ingredient->pivot->quantity }}g
                                    </span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            {{-- PREPARAZIONE --}}
            <div class="col-md-8">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <strong>Preparazione</strong>
                    </div>

                    <div class="card-body">
                        <p style="white-space: pre-line;">
                            {{ $recipe->preparation }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- META --}}
        <div class="mt-4 text-muted small">
            Creato: {{ $recipe->created_at->format('d/m/Y H:i') }} |
            Aggiornato: {{ $recipe->updated_at->format('d/m/Y H:i') }}
        </div>

        {{-- BACK --}}
        <div class="mt-3">
            <a href="{{ route('recipes.index') }}" class="btn btn-secondary">
                ← Torna alla lista
            </a>
        </div>

    </div>
@endsection
