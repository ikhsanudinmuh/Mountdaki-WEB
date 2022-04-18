@include('layouts.header')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <title> 
            @if ($data['success'] == false)
                {{ $data['message'] }} | Mountdaki
            @else
                Data Pendakian | Mountdaki
            @endif
        </title>
    </head>
    <body>
        @include('layouts.navbar')
        <div class="container">         
            @if (session('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('updateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('updateError'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('updateError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($data['success'] == false)
                <center><h3>{{ $data['message'] }}</h3></center>
            @else
                @php
                    $m = $data['data']
                @endphp
                <h2>Data Pendakian</h2>
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Gunung</th>
                            <th>Jadwal</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($m > 1)
                            @foreach ($m as $d)
                                <tr>
                                    <td>{{ $d['mountain_name'] }}</td>
                                    <td>{{ $d['schedule'] }}</td>
                                    <td>
                                        @if ($d['status'] == 'pending')
                                            <span class="badge bg-warning">{{ $d['status'] }}</span>     
                                        @elseif ($d['status'] == 'approved')
                                            <span class="badge bg-success">{{ $d['status'] }}</span>  
                                        @elseif ($d['status'] == 'declined')
                                            <span class="badge bg-danger">{{ $d['status'] }}</span>  
                                        @elseif ($d['status'] == 'climbing')
                                            <span class="badge bg-primary">{{ $d['status'] }}</span>  
                                        @elseif ($d['status'] == 'done')
                                            <span class="badge bg-secondary">{{ $d['status'] }}</span>  
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detail{{ $d['id'] }}">
                                            Lihat Detail
                                        </button>
                                    </td>
                                    <td>                                          
                                        @if ($d['status'] == 'approved')
                                            <button class="btn btn-dark"><a style="text-decoration: none; color:white" href="/climbing_registrations/climb/{{ $d['id'] }}">Mendaki</a></button>
                                        @elseif ($d['status'] == 'climbing')
                                            <button class="btn btn-dark"><a style="text-decoration: none; color:white" href="/climbing_registrations/done/{{ $d['id'] }}">Selesai</a></button>                                         
                                        @endif
                                    </td>
                                </tr>                            
                            @endforeach                            
                        @else
                            <tr>
                                <td>{{ $m['mountain_name'] }}</td>
                                <td>{{ $m['schedule'] }}</td>
                                <td>
                                    @if ($m['status'] == 'pending')
                                        <span class="badge bg-warning">{{ $m['status'] }}</span>     
                                    @elseif ($m['status'] == 'approved')
                                        <span class="badge bg-success">{{ $m['status'] }}</span>  
                                    @elseif ($m['status'] == 'declined')
                                        <span class="badge bg-danger">{{ $m['status'] }}</span>  
                                    @elseif ($m['status'] == 'climbing')
                                        <span class="badge bg-primary">{{ $m['status'] }}</span>  
                                    @elseif ($m['status'] == 'done')
                                        <span class="badge bg-secondary">{{ $m['status'] }}</span>  
                                    @endif
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail{{ $m['id'] }}">
                                        Lihat Detail
                                    </button>
                                </td>
                                <td>
                                    @if ($m['status'] == 'approved')
                                        <button class="btn btn-dark"><a style="text-decoration: none; color:white" href="/climbing_registrations/climb/{{ $m['id'] }}">Mendaki</a></button>
                                    @elseif ($m['status'] == 'climbing')
                                        <button class="btn btn-dark"><a style="text-decoration: none; color:white" href="/climbing_registrations/done/{{ $m['id'] }}">Selesai</a></button>                                         
                                    @endif
                                </td>
                            </tr>       
                        @endif
                    </tbody>
                </table>
            @endif
        </div>
              
        <!-- Modal -->
        @foreach ($m as $d)
            <div class="modal fade" id="detail{{ $d['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Pendakian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Foto Kartu Identitas</h4>
                        <center><img src="/assets/{{ $d['identity_card'] }}" alt="" style="width: 25rem"></center> <br>
                        <h4>Foto Surat Kesehatan</h4>
                        <center><img src="/assets/{{ $d['healthy_letter'] }}" alt="" style="width: 25rem"></center>
                    </div>
                </div>
                </div>
            </div>
        @endforeach

        <script>
            $(document).ready( function () {
                $('#table_id').DataTable();
            } );
        </script>
    </body>
</html>