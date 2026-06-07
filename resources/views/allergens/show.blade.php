@extends('layouts.master')


@section('title')
    {{ $allergen->name }}
@endsection

@section('content')
@section('content')
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">

                    {{-- HEADER --}}
                    <div class="card-header d-flex align-items-center gap-3">

                        <img src="{{ $allergen->icon }}" alt="{{ $allergen->name }}" width="40">

                        <h4 class="mb-0">{{ $allergen->name }}</h4>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Slug:</strong>
                                <div class="text-secondary">
                                    {{ $allergen->slug }}
                                </div>
                            </div>
                        </div>


                        <hr>
                        <p class="text-muted">
                            Descrizione:
                            {{ $allergen->description }}
                        </p>


                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer text-muted small">
                        Creato: {{ $allergen->created_at->format('d/m/Y H:i') }} <br>
                        Aggiornato: {{ $allergen->updated_at->format('d/m/Y H:i') }}
                    </div>

                </div>

                {{-- BACK BUTTON --}}
                <div class="mt-3">
                    <a href="{{ route('allergens.index') }}" class="btn btn-secondary">
                        ← Torna alla lista
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection
