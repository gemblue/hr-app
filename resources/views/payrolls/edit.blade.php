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
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card">
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body">

                <form action="{{ route('payrolls.update', $payroll->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control">
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" @if($employee->id == $payroll->employee_id) selected @endif>
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="number" name="salary" id="salary" class="form-control" value="{{ $payroll->salary }}" required>
                    </div>

                    <div class="form-group">
                        <label for="bonuses">Bonuses</label>
                        <input type="number" name="bonuses" id="bonuses" class="form-control" value="{{ $payroll->bonuses }}" required>
                    </div>

                    <div class="form-group">
                        <label for="deductions">Deductions</label>
                        <input type="number" name="deductions" id="deductions" class="form-control" value="{{ $payroll->deductions }}" required>
                    </div>

                    <div class="form-group">
                        <label for="net_salary">Net Salary</label>
                        <input type="number" name="net_salary" id="net_salary" class="form-control" value="{{ $payroll->net_salary }}" required>
                    </div>

                    <div class="form-group">
                        <label for="pay_date">Pay Date</label>
                        <input type="date" name="pay_date" class="form-control datetimefree" value="{{ $payroll->pay_date }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Payroll</button>
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