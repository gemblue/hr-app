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

                <form action="{{ route('payrolls.store') }}" method="POST">
                    @csrf
            
                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control">
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="number" name="salary" id="salary" class="form-control" value="7000000" required>
                    </div>
            
                    <div class="form-group">
                        <label for="bonuses">Bonuses</label>
                        <input type="number" name="bonuses" id="bonuses" class="form-control" value="1000000">
                    </div>
            
                    <div class="form-group">
                        <label for="deductions">Deductions</label>
                        <input type="number" name="deductions" id="deductions" class="form-control" value="0">
                    </div>
            
                    <div class="form-group">
                        <label for="net_salary">Net Salary</label>
                        <input type="number" name="net_salary" id="net_salary" class="form-control" value="8000000" required>
                    </div>
            
                    <div class="form-group">
                        <label for="pay_date">Pay Date</label>
                        <input type="date" name="pay_date" class="form-control datetimefree" required>
                    </div>
            
                    <button type="submit" class="btn btn-primary mt-3">Save Payroll</button>
                </form>

            </div>
        </div>
    </section>
</div>

<script>
// Menghitung otomatis net salary dengan JS realtime.
document.getElementById('deductions').addEventListener('input', function() {
    var salary = document.getElementById('salary').value;
    var bonuses = document.getElementById('bonuses').value;
    var deductions = document.getElementById('deductions').value;
    var net_salary = parseInt(salary) + parseInt(bonuses) - parseInt(deductions);
    document.getElementById('net_salary').value = net_salary;
});
</script>

@endsection