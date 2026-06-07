@extends('layouts.master')

@section('content')
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">

                    <div class="card-header">
                        <h4 class="mb-0">Crea nuovo allergene</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('allergens.store') }}" method="POST">
                            @csrf

                            {{-- NAME --}}
                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- SLUG --}}
                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control bg-light"
                                    value="{{ old('slug') }}" readonly tabindex="-1">

                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="mb-3">
                                <label class="form-label">Descrizione</label>
                                <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- ICON --}}
                            <div class="mb-3">
                                <label class="form-label">Icona (URL)</label>
                                <input type="text" name="icon"
                                    class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon') }}"
                                    required>

                                @error('icon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- BUTTONS --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('allergens.index') }}" class="btn btn-secondary">
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
