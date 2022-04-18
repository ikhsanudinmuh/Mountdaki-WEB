<div class="container">
<nav class="navbar-light bg-light pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <a class="navbar-brand" href="/">
                    <img src="{{ URL::to('/') }}/assets/Ellipse 1.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    Mountdaki
                </a>
            </div>
            <div class="col"></div>
            <div class="col-3"><a href="/informasi" style="text-decoration: none; color: black; font-weight: 700">Informasi</a></div>
            <div class="col"></div>
            <div class="col d-flex">
                @if (session('login') == TRUE)
                    @if (session('role') == 'admin')
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ session('userName') }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/admin/mountains">Kelola Data Gunung</a></li>
                                <li><a class="dropdown-item" href="/admin/climbing_registrations">Kelola Data Pendakian</a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ session('userName') }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/climbing_registrations/users/{{ session('userId') }}">Data Pendakian</a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    @endif
                @else 
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        masuk/daftar
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/login">Masuk</a></li>
                            <li><a class="dropdown-item" href="/register">Daftar</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
</div>