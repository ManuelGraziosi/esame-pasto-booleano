@extends('layouts.master')

@section('title')
    Pasto Booleano - Home Backoffice
@endsection

@section('content')
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold text-primary mb-3">Pasto Booleano</h1>
                <p class="lead text-muted mb-4">
                    Pannello di Gestione Dati per l'applicazione React.
                </p>

                <hr class="my-4">

                @auth
                    <div class="card shadow-sm border-0 bg-light p-4 mb-4">
                        <h4 class="mb-3">Bentornato, <strong>{{ Auth::user()->name }}</strong>!</h4>
                        <p class="text-secondary mb-4">
                            Sei autenticato correttamente. Seleziona una delle sezioni qui sotto per iniziare a gestire le
                            risorse del database:
                        </p>

                        <div class="row g-3 justify-content-center">
                            <div class="col-sm-4">
                                <a href="{{ route('recipes.index') }}" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm">
                                    🍝 Ricette
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('ingredients.index') }}"
                                    class="btn btn-outline-primary w-100 py-2 fw-semibold shadow-sm">
                                    🥦 Ingredienti
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="{{ route('allergens.index') }}"
                                    class="btn btn-outline-primary w-100 py-2 fw-semibold shadow-sm">
                                    ⚠️ Allergeni
                                </a>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top text-start d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Hai bisogno di modificare il tuo account?</span>
                            <a href="{{ route('profile.edit') }}"
                                class="btn btn-link btn-sm text-decoration-none text-secondary p-0">
                                Gestisci Profilo ⚙️
                            </a>
                        </div>
                    </div>
                @endauth

                @guest
                    <div class="p-5 bg-white border rounded-4 shadow-sm">
                        <div class="fs-1 mb-3">🔒</div>
                        <h3 class="fw-bold mb-3">Area Gestionale Riservata</h3>
                        <p class="text-muted mb-4">
                            Per poter inserire o modificare le ricette, i loro ingredienti e gli allergeni associati, è
                            necessario effettuare l'accesso al pannello di controllo.
                        </p>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('login') }}" class="btn btn-primary px-4 fw-semibold shadow-sm">
                                Accedi
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-warning px-4 fw-semibold shadow-sm">
                                Registrati
                            </a>
                        </div>
                    </div>
                @endguest

            </div>
        </div>
    </div>
@endsection
