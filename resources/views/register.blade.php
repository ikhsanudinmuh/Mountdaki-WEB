@include('layouts.header')

        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <title>Register | Mountdaki</title>
    </head>

    <body>
        <div class="container">
            <form action="register" method="POST" class="login-email">
                @csrf
                <div class="text-center">
                    <img src="assets/unknown.png" class="rounded" alt="...">
                </div>
                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Mountdaki</p>
                <p class="login-text" style="font-size: 2rem; font-weight: 600;">Daftar</p>
                @if (session('registerError'))
                    @if (is_array(session('registerError')))
                        @foreach (session('registerError') as $column=>$value)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ $value[0] }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endforeach                        
                    @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('registerError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                @endif
                <div class="input-group">
                    <input type="text" placeholder="Nama" name="name">
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Email" name="email">
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Kata Sandi" name="password">
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Ketik Ulang Sandi" name="confirm_password">
                </div>
                <div class="input-group">
                    <button name="submit" class="btn">Daftar</button>
                </div>
                <p class="login-register-text">sudah punya akun? <a href="login">Masuk</a></p>
            </form>
        </div>
    </body>

</html>