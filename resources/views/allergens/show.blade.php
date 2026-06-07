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


                    <div class="card-header d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center">

                            <img src="{{ $allergen->icon }}" alt="{{ $allergen->name }}" width="40">

                            <h4 class="mb-0">{{ $allergen->name }}</h4>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                <!-- EDIT -->
                                <a href="{{ route('allergens.edit', $allergen) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Modifica
                                </a>

                                <!-- DELETE 1 -->
                                <form action="{{ route('allergens.destroy', $allergen) }}" method="POST"
                                    onsubmit="return confirm('Sei sicuro di voler eliminare questo allergene?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Elimina
                                    </button>
                                </form>

                                {{-- <!-- DELETE 2 -->
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Elimina
                                </button> --}}
                            </div>
                        </div>
                    </div>




                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex gap-2">
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Conferma eliminazione</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Sei sicuro di voler eliminare questo progetto?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                    <form action="{{ route('allergens.destroy', $allergen) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina definitivamente</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
