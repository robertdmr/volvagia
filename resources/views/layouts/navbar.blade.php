<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse row" id="navbarSupportedContent" id="navbarScroll">
            <!-- Left Side Of Navbar -->
            <div class="mx-auto col-12 col-md-4 col-lg-4">
                <form action="{{ route('home') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar" aria-label="Buscar" name="search" value="{{ request()->query('search') ?? "" }}"
                            aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
                    </div>
                </form>
            </div>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav justify-content-end my-2 my-lg-0 col-12 col-md-8 col-lg-8" style="--bs-scroll-height: 100px;">
                <!-- Authentication Links -->
                <ul class="nav justify-content-center justify-content-md-end justify-content-lg-end border-end">

                    <li class="nav-item border-end me-1 pe-2">
                        <button class="btn btn-sm btn-success mt-1" onclick="openModalDatos()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                    </li>
                    @if(auth()->user()->role=='admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Usuarios</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects.index') }}">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('utils') }}">Utiles</a>
                    </li>
                </ul>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

