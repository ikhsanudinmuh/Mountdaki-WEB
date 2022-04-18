@include('layouts.header')
        <title> 
            @if ($data['success'] == false)
                {{ $data['message'] }} | Mountdaki
            @else
                Pendakian {{ $data['data']['name'] }} | Mountdaki
            @endif
        </title>
    </head>
    <body>
        @include('layouts.navbar')
        <div class="container">         
            @if ($data['success'] == false)
                <center><h3>{{ $data['message'] }}</h3></center>
            @else
                @php
                    $m = $data['data']
                @endphp
                <div class="row">
                    <img src="{{ URL::to('/') }}/assets/bg wide.jpg">
                </div>
                <h3>Pendaftaran Pendakian {{ $m['name'] }}</h3>
                <form action="/climbing_registrations/register/{{ $m['id'] }}" method="post" class="mt-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="mountain_id" value="{{ $m['id'] }}">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama : </label>
                        <input type="text" name="" id="" value="{{ session('userName') }}" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Pendakian : </label>
                        <input type="date" name="schedule" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kartu Identitas : </label>
                        <input type="file" name="kartu" id="" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Surat Sehat : </label>
                        <input type="file" name="surat" id="" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-secondary">Daftar</button>
                    </div>
                </form>
            @endif
        </div>

        
    </body>
</html>