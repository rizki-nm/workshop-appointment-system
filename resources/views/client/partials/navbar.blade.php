<header id="home">
    <nav class="navbar navbar-inverse navbar-expand-lg header-nav fixed-top navbar-blue">
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a class="nav-link text-blue" href="{{ route('get.register.poli') }}">Pendaftaran Poli</a></li>
                    <li>
                        @if (Auth::check())
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        @else
                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal" onclick="{{ route('login') }}">
                                Login
                            </button> --}}
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
