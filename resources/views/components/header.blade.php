<header class="sticky-top shadow-sm">
    <nav class="navbar navbar-expand-md navbar-light bg-white py-3">
        <div class="container">

            {{-- BRAND LOGO --}}
            <a class="navbar-brand d-flex align-items-center fw-bold text-primary tracking-wide"
                href="{{ url('/') }}">
                <i class="bi bi-egg-fried me-2 fs-4"></i> LOGO
            </a>

            {{-- TOGGLE BUTTON PER DISPOSITIVI MOBILI --}}
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- ELEMENTI DI NAVIGAZIONE --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-md-0 gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-dark' : '' }}"
                            href="{{ url('/') }}">
                            {{ __('Home') }}
                        </a>
                    </li>

                    {{-- Sostituito il doppio controllo con un solo ed efficiente @auth --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('allergens*') ? 'active fw-bold text-dark' : '' }}"
                                href="{{ url('/allergens') }}">
                                {{ __('Allergeni') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('ingredients*') ? 'active fw-bold text-dark' : '' }}"
                                href="{{ url('/ingredients') }}">
                                {{ __('Ingredienti') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('recipes*') ? 'active fw-bold text-dark' : '' }}"
                                href="{{ url('/recipes') }}">
                                {{ __('Ricette') }}
                            </a>
                        </li>
                    @endauth
                </ul>

                {{-- Corretto 'ml-auto' con 'ms-auto' per l'allineamento a destra in Bootstrap 5 --}}
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-primary btn-sm px-3 rounded-pill fw-medium"
                                href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('Login') }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown"
                                class="nav-link dropdown-toggle d-flex align-items-center gap-1.5 fw-medium" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi bi-user-circle fs-5 text-secondary"></i>
                                {{ Auth::user()->name }}
                            </a>

                            {{-- Allineamento dropdown a destra --}}
                            <div class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                    href="{{ url('dashboard') }}">
                                    <i class="bi bi-speedometer2 text-muted"></i> {{ __('Dashboard') }}
                                </a>
                                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('profile') }}">
                                    <i class="bi bi-person text-muted"></i> {{ __('Profile') }}
                                </a>

                                <hr class="dropdown-divider opacity-10">

                                <a class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>
</header>
