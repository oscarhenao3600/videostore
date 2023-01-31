<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">VideoStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('home.index') }}">Inicio</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('films*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Películas
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ Request::is('films') ? 'active' : '' }}" href="{{ route('films.index') }}">Peliculas</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item {{ Request::is('films/films-type*') ? 'active' : '' }}" href="{{ route('films.films_type.films_type_list') }}">Tipos</a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ Request::is('films/films-genders*') ? 'active' : '' }}" href="{{ route('films.films_genders.films_genders_list') }}">Géneros</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('clients*') ? 'active' : '' }}" href="{{ route('clients.index') }}">Clientes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('rental*') ? 'active' : '' }}" href="{{ route('rental.rental_list') }}">Alquiler</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
