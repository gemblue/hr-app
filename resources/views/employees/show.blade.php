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
                <h3>Detail Employees</h3>
                <p class="text-subtitle text-muted">Manage tasks data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Employees</li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Fullname</label>
                            <p>{{ $employee->fullname }}</p>
                        </div>
                
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <p>{{ $employee->email }}</p>
                        </div>
                
                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <p>{{ $employee->role->title }}</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Department</label>
                            <p>{{ $employee->department->name }}</p>
                        </div>
                
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <p>{{ ucfirst($employee->status) }}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Salary</label>
                            <p>{{ 'Rp ' . number_format($employee->salary, 0, ',', '.') }}</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Present</label>
                            <p>{{ $present }}</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Leave</label>
                            <p>{{ $absent }}</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Absence</label>
                            <p>{{ $leave }}</p>
                        </div>

                    </div>
                </div>
        
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </section>
</div>

@endsection