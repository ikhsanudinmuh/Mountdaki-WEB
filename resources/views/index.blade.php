@include('layouts.header')
        <title>Home | Mountdaki</title>
    </head>
    <body>
        @include('layouts.navbar')
        <div class="container">
            @if (session('role') == 'admin')
                <center><h3 class="mt-3">Halo {{ session('userName') }}</h3></center>
            @else
                <div class="row">
                    <img src="{{ URL::to('/') }}/assets/bg wide.jpg">
                </div>
                <div class="row mt-3">
                    <div class="col"></div>
                    <div class="col">
                    </div>
                    <div class="col"></div>
                </div>

                <div class="row mt-3">
                    <div class="col"></div>
                    <div class="col">
                        @if (session('loginSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('loginSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col"></div>
                </div>

                <h3 class="">Destinasi Pendakian</h3>
                <div class="row">
                    @foreach ($data['data'] as $m)
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="/assets/{{ $m['image'] }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$m['name'] }}</h5>
                                    <p class="card-text">{{ $m['height'] }} mdpl</p>
                                    <p class="card-text">{{ $m['location'] }}</p>
                                    <a href="/mountains/{{ $m['id'] }}" class="btn btn-secondary">Detail</a>
                                </div>
                            </div>
                        </div>                    
                    @endforeach
                </div>       
            @endif
        </div>
    </body>
</html>