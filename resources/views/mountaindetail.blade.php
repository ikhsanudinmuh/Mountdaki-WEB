@include('layouts.header')
        <title> 
            @if ($data['success'] == false)
                {{ $data['message'] }} | Mountdaki
            @else
            {{ $data['data']['name'] }} | Mountdaki
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
                <div class="row mt-3">
                    <div class="col-8">
                        <img src="{{ URL::to('/') }}/assets/{{ $m['image'] }}" alt="" style="width: 50rem;">                        
                        <h3 class="mt-3">{{ $m['name'] }}</h3>
                        <p class="mt-2">{{ $m['description'] }}</p>
                    </div>
                    <div class="col">
                        <img src="{{ URL::to('/') }}/assets/location.png" alt="" style="width: 50px; height: 50px">
                        {{ $m['location'] }} <br><br>
                        <img src="{{ URL::to('/') }}/assets/height.png" alt="" style="width: 50px; height: 50px">
                        {{ $m['height'] }}&nbsp;mdpl <br><br>
                        <img src="{{ URL::to('/') }}/assets/range.png" alt="" style="width: 50px; height: 50px">
                        {{ $m['basecamp'] }}&nbsp;jalur pendakian <br><br>
                        <a href="/climbing_registrations/register/{{ $m['id'] }}" class="btn btn-secondary">Daftar Pendakian</a>
                    </div>
                </div>                    
                
            @endif
        </div>
    </body>
</html>