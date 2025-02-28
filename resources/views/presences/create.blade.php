@extends('layouts.dashboard')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>New Presence</h3>
                <p class="text-subtitle text-muted">Monitor presences data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Presences</li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card">
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body">

                @if (session('role') == 'HR') 

                <form action="{{ route('presences.store') }}" method="POST">
                    @csrf
        
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select name="employee_id" class="form-control" id="employee_id" required>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check In</label>
                        <input type="datetime-local" name="check_in" class="form-control datetime" id="check_in" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check Out</label>
                        <input type="datetime-local" name="check_out" class="form-control datetime" id="check_out">
                    </div>
        
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                            <option value="leave">Leave</option>
                        </select>
                    </div>
        
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

                @else

                <!-- 
                Employee 
                
                Disini gak usah repot repot bikin field status dst, langsung aja input location.
                Nnt kita handle di backendnya, kalo locationnya sesuai dengan lokasi kantor, maka statusnya present, selain itu statusnya absent.
                -->
                <form action="{{ route('presences.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3 alert alert-warning"><b>Note</b> : Mohon izinkan akses lokasi, supaya presensi diterima.</div>
                    
                    <div class="mb-3">
                        <label class="form-label">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" required>
                    </div>

                    <div class="mb-3">
                        <iframe 
                            width="500" 
                            height="300" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0" 
                            marginwidth="0" 
                            src=""
                            >
                        </iframe>
                    </div>

                    <button type="submit" id="btn-present" class="btn btn-primary" disabled>Present</button>
                </form>

                @endif


            </div>
        </div>
    </section>
</div>

<script>
    const iframe = document.querySelector('iframe');
    // const officeLat = -6.200000; // Latitude for Jakarta
    // const officeLon = 106.816666; // Longitude for Jakarta
    // const threshold = 0.01; // Threshold for distance comparison

    // Latitude for Office.
    const officeLat = -6.8911104;
    const officeLon = 107.544576;
    const threshold = 0.01;

    navigator.geolocation.getCurrentPosition(function(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        iframe.src = `https://maps.google.com/maps?q=${lat},${lon}&hl=es&z=14&output=embed`;
    });

    document.addEventListener('DOMContentLoaded', (event) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lon;

                // Compare current location with office location
                const distance = Math.sqrt(Math.pow(lat - officeLat, 2) + Math.pow(lon - officeLon, 2));
                if (distance <= threshold) {
                    // User is at the office
                    alert("Kamu berada di kantor, selamat bekerja.");
                    document.getElementById('btn-present').removeAttribute('disabled');
                } else {
                    alert("Kamu tidak berada di kantor, presensi tidak diterima. Refresh ulang jendela ini / hubungi admin jika ada kesalahan");
                }
            }, function(error) {
                console.error("Error Code = " + error.code + " - " + error.message);
            });
        } else {
            console.error("Geolocation is not supported by this browser.");
        }
    });
</script>

@endsection