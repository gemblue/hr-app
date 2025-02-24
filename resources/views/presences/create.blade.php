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

                <form action="{{ route('presences.store') }}" method="POST">
                    @csrf
        
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" id="location" required>
                    </div>
        
                   <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                @endif


            </div>
        </div>
    </section>
</div>

<script>
    
</script>

@endsection