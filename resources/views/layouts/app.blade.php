<style>
    .text-tjlb {
  color: #003C6E !important;
}

    
</style>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <!-- Scripts -->

    @livewireStyles
    
</head>
<body>
    <div id="app">
        <div  align="center">
            <img name="index_r1_c1" src="header/head_1.png" width="1960" height="200" border="0" alt="">
          </div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
					@auth()
                    <ul class="navbar-nav mr-auto">
						<!--Nav Bar Hooks - Do not delete!!-->
						<li class="nav-item">
                            <a href="{{ url('/reports') }}" class="nav-link"><i class="fa-sharp fa-solid fa-list-check text-tjlb "></i> Reportes</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/timetables') }}" class="nav-link"><i class="fa-solid fa-calendar-check text-tjlb "></i> Registro de checadas</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/types') }}" class="nav-link"><i class="fa-solid fa-filter text-tjlb "></i> Tipos de registro</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/checks') }}" class="nav-link"><i class="fa-solid fa-square-check text-tjlb "></i> Checadas </a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/usershifts') }}" class="nav-link"><i class="fa-solid fa-user-plus text-tjlb "></i> Horarios asignados</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/schedules') }}" class="nav-link"><i class="fa-solid fa-clock text-tjlb "></i> Horarios</a> 
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/employees') }}" class="nav-link"><i class="fa-solid fa-users text-tjlb "></i> Empleados</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/sservices') }}" class="nav-link"><i class="fa-sharp fa-solid fa-child text-tjlb"></i> Servicio Social</a> 
                        </li>
                    </ul>
					@endauth()

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    <script type="module">
        const addModal = new bootstrap.Modal('#createDataModal');
        const editModal = new bootstrap.Modal('#updateDataModal');
        window.addEventListener('closeModal', () => {
           addModal.hide();
           editModal.hide();
        })
    </script>
</body>
</html>