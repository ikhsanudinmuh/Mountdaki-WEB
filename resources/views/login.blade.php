@include('layouts.header')
        
    <link rel="stylesheet" type="text/css" href="/css/style.css">
        <title>Login | Mountdaki</title>
    </head>

    <body>
        <div class="container">
            <div class="text-center">
                <img src="{{ URL::to('/') }}/assets/unknown.png" class="rounded" alt="...">
              </div>
            <form action="/login" method="post" class="login-email">
                @csrf
                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Mountdaki</p>
                <p class="login-text" style="font-size: 2rem; font-weight: 600;">Masuk</p>
                @if (session('registerSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('registerSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('loginError'))
                    @if (is_array(session('loginError')))
                        @foreach (session('loginError') as $column=>$value)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ $value[0] }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endforeach                        
                    @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                @endif
                <div class="input-group">
                    <input type="email" placeholder="Email" name="email">
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Kata Sandi" name="password">
                </div>
                <div class="input-group">
                    <button name="submit" class="btn">Masuk</button>
                </div>
                <p class="login-register-text">belum punya akun? <a href="register">Daftar</a></p>
                <p class="login-register-text">Masuk sebagai admin? <a href="/admin/login">Masuk</a></p>
            </form>
          </div>
    </body>

</html>