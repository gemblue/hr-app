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
                <h3>Presences</h3>
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
            
            <div class="card-body">

                <div class="d-flex">
                    <a href="{{ route('presences.create') }}" class="btn btn-primary mb-3 ms-auto">New Presence</a>
                </div>

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

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->employee->fullname }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->check_in)->format('d, M Y H:i:s') }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->check_out)->format('d, M Y H:i:s') }}</td>
                                
                                <td>
                                    @if($attendance->status == 'leave')
                                        <span class="text-warning">{{ ucfirst($attendance->status) }}</span>
                                    @elseif($attendance->status == 'present')
                                        <span class="text-success">{{ ucfirst($attendance->status) }}</span>
                                    @elseif($attendance->status == 'absent')
                                        <span class="text-danger">{{ ucfirst($attendance->status) }}</span>
                                    @endif
                                </td>

                                <td>
                                    @if(session('role') == 'HR')
                                    
                                    <a href="{{ route('presences.edit', $attendance->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('presences.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection