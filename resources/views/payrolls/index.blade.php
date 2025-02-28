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
                <h3>Payrolls</h3>
                <p class="text-subtitle text-muted">Manage payroll data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Payrolls</li>
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
                    @if (session('role') == 'HR')
                        <a href="{{ route('payrolls.create') }}" class="btn btn-primary mb-3 ms-auto">New Payroll</a>
                    @endif
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Salary</th>
                            <th>Bonuses</th>
                            <th>Deductions</th>
                            <th>Net Salary</th>
                            <th>Pay Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payrolls as $payroll)

                            <tr>
                                <td>{{ $payroll->employee->fullname }}</td>
                                <td>{{ 'Rp ' . number_format($payroll->salary, 0, ',', '.') }}</td>
                                <td>{{ 'Rp ' . number_format($payroll->bonuses ?? 0, 0, ',', '.') }}</td>
                                <td>{{ 'Rp ' . number_format($payroll->deductions ?? 0, 0, ',', '.') }}</td>
                                <td>{{ 'Rp ' . number_format($payroll->salary + $payroll->bonuses - $payroll->deductions, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($payroll->pay_date)->format('d, M Y') }}</td>
                                <td>
                                    <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-info btn-sm">Salary Slip</a>
                                    
                                    @if (session('role') == 'HR')
                                        <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Sure?');" type="submit" class="btn btn-danger btn-sm">Delete</button>
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