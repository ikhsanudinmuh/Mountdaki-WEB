@include('layouts.header')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <title> 
            @if ($data['success'] == false)
                {{ $data['message'] }} | Mountdaki
            @else
                (Admin) Data Gunung  | Mountdaki
            @endif
        </title>
    </head>
    <body>
        @include('layouts.navbar')
        <div class="container">         
            @if (session('createError'))
                @if (is_array(session('createError')))
                    @foreach (session('createError') as $column=>$value)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ $value[0] }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach                        
                @else
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('createError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            @elseif (session('createSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('createSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($data['success'] == false)
                <center><h3>{{ $data['message'] }}</h3></center>
            @else
                @php
                    $m = $data['data']
                @endphp
                <center><h2 class="mt-3">Data Gunung</h2></center>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahdata">
                    Tambah
                </button>
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Nama Gunung</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Lokasi</th>
                            <th>Ketinggian</th>
                            <th>Jalur Pendakian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($m > 1)
                            @foreach ($m as $d)
                                <tr>
                                    <td>{{ $d['name'] }}</td>
                                    <td><img src="/assets/{{ $d['image'] }}" alt="" style="width:100px; height:50px"></td>
                                    <td>{{ $d['description'] }}</td>
                                    <td>{{ $d['location'] }}</td>
                                    <td>{{ $d['height'] }}</td>
                                    <td>{{ $d['basecamp'] }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit{{ $d['id'] }}">
                                            Edit
                                        </button>
                                        {{-- <button class="btn btn-danger">
                                            <a style="text-decoration: none; color:white" href="/admin/mountains/delete{{ $d['id'] }}">Hapus</a>
                                        </button> --}}
                                    </td>
                                </tr>                            
                            @endforeach                            
                        @else
                            <tr>
                                <td>{{ $m['name'] }}</td>
                                <td><img src="/assets/{{ $m['image'] }}" alt="" style="width:100px; height:50px"></td>
                                <td>{{ $m['description'] }}</td>
                                <td>{{ $m['location'] }}</td>
                                <td>{{ $m['height'] }}</td>
                                <td>{{ $m['basecamp'] }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit{{ $m['id'] }}">
                                        Edit
                                    </button>
                                    {{-- <button class="btn btn-danger">
                                        <a style="text-decoration: none; color:white" href="/admin/mountains/delete{{ $m['id'] }}">Hapus</a>
                                    </button> --}}
                                </td>
                            </tr>       
                        @endif
                    </tbody>
                </table>
            @endif
        </div>
              
        <!-- Modal -->
        @foreach ($m as $d)
            <div class="modal fade" id="edit{{ $d['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Gunung</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/admin/mountains/{{ $d['id'] }}" method="POST" class="" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Gunung</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ $d['name'] }}">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1" name="gambar" required>
                            </div> --}}
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description">{{ $d['description'] }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="location" value="{{ $d['location'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Ketinggian</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="height" value="{{ $d['height'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Jalur Pendakian</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="basecamp" value="{{ $d['basecamp'] }}">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        @endforeach

        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Gunung</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/mountains" method="POST" class="" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Gunung</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="exampleFormControlInput1" name="gambar" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="location">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Ketinggian</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="height">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Jalur Pendakian</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="basecamp">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

        <script>
            $(document).ready( function () {
                $('#table_id').DataTable();
            } );
        </script>
    </body>
</html>