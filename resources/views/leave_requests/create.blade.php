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
                <h3>Leave Requests</h3>
                <p class="text-subtitle text-muted">Manage leave data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Leave Requests</li>
                        <li class="breadcrumb-item active" aria-current="page">New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card">
            
            <div class="card-body">
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
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

                @if (session('role') == 'HR')
                
                <form action="{{ route('leave-requests.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select class="form-select @error('employee_id') is-invalid @enderror" name="employee_id" required>
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" 
                                    @if(old('employee_id') == $employee->id) selected @endif>
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="leave_type" class="form-label">Leave Type</label>
                        <select class="form-control @error('leave_type') is-invalid @enderror" name="leave_type" required>
                            <option value="" disabled selected>Choose ..</option>
                            <option value="Cuti Tahunan" {{ old('leave_type') == 'Cuti Tahunan' ? 'selected' : '' }}>Cuti Tahunan</option>
                            <option value="Cuti Sakit" {{ old('leave_type') == 'Cuti Sakit' ? 'selected' : '' }}>Cuti Sakit</option>
                            <option value="Cuti Bersama" {{ old('leave_type') == 'Cuti Bersama' ? 'selected' : '' }}>Cuti Bersama</option>
                            <option value="Cuti Melahirkan" {{ old('leave_type') == 'Cuti Melahirkan' ? 'selected' : '' }}>Cuti Melahirkan</option>
                            <option value="Cuti Ayah" {{ old('leave_type') == 'Cuti Ayah' ? 'selected' : '' }}>Cuti Ayah</option>
                            <option value="Cuti Tanpa Gaji" {{ old('leave_type') == 'Cuti Tanpa Gaji' ? 'selected' : '' }}>Cuti Tanpa Gaji</option>
                        </select>
                        @error('leave_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror datetimeleave" name="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror datetimeleave" name="end_date" value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('leave-requests.index') }}" class="btn btn-secondary">Back to Leave Requests</a>
                </form>

                @else
                
                <form action="{{ route('leave-requests.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="leave_type" class="form-label">Leave Type</label>
                        <select class="form-control @error('leave_type') is-invalid @enderror" name="leave_type" required>
                            <option value="" disabled selected>Choose ..</option>
                            <option value="Cuti Tahunan" {{ old('leave_type') == 'Cuti Tahunan' ? 'selected' : '' }}>Cuti Tahunan</option>
                            <option value="Cuti Sakit" {{ old('leave_type') == 'Cuti Sakit' ? 'selected' : '' }}>Cuti Sakit</option>
                            <option value="Cuti Bersama" {{ old('leave_type') == 'Cuti Bersama' ? 'selected' : '' }}>Cuti Bersama</option>
                            <option value="Cuti Melahirkan" {{ old('leave_type') == 'Cuti Melahirkan' ? 'selected' : '' }}>Cuti Melahirkan</option>
                            <option value="Cuti Ayah" {{ old('leave_type') == 'Cuti Ayah' ? 'selected' : '' }}>Cuti Ayah</option>
                            <option value="Cuti Tanpa Gaji" {{ old('leave_type') == 'Cuti Tanpa Gaji' ? 'selected' : '' }}>Cuti Tanpa Gaji</option>
                        </select>
                        @error('leave_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror datetimeleave" name="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror datetimeleave" name="end_date" value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                    <a href="{{ route('leave-requests.index') }}" class="btn btn-secondary">Back to List</a>
                </form>
            
                @endif
            </div>
        </div>
    </section>
</div>

@endsection