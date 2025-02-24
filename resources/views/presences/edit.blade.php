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
                <h3>Edit Presence</h3>
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
                <form action="{{ route('presences.update', $presence->id) }}" method="POST">
                    @csrf
                    @method('PUT')
        
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select name="employee_id" class="form-control" id="employee_id" required>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $presence->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check-in Time</label>
                        <input type="datetime-local" name="check_in" class="form-control datetime" id="check_in" value="{{ old('check_in', $presence->check_in) }}" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check-out Time</label>
                        <input type="datetime-local" name="check_out" class="form-control datetime" id="check_out" value="{{ old('check_out', $presence->check_out ? $presence->check_out : '') }}">
                    </div>
        
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="present" {{ $presence->status == 'present' ? 'selected' : '' }}>Present</option>
                            <option value="absent" {{ $presence->status == 'absent' ? 'selected' : '' }}>Absent</option>
                            <option value="leave" {{ $presence->status == 'leave' ? 'selected' : '' }}>Leave</option>
                        </select>
                    </div>
        
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection