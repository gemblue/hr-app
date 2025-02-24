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
                <h3>Detail Slip</h3>
                <p class="text-subtitle text-muted">Payrolls management.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Payrolls</li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section">
        <div class="card">
            <div class="card-body" >
                <div id="print-area">
                    <div>
                        <h5>PT. Codepolitan Integrasi Indonesia</h5>
                        <p>Jl. Jend. Sudirman No. 55, Jakarta Pusat</p>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Employee</label>
                                <p>{{ $payroll->employee->fullname }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Salary</label>
                                <p>{{ 'Rp ' . number_format($payroll->salary, 0, ',', '.') }}</p>
                            </div>
                    
                            <div class="form-group">
                                <label class="form-label">Bonuses</label>
                                <p>{{ 'Rp ' . number_format($payroll->bonuses, 0, ',', '.') }}</p>
                            </div>
                    
                            <div class="form-group">
                                <label class="form-label">Deductions</label>
                                <p>{{ 'Rp ' . number_format($payroll->deductions, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Net Salary</label>
                                <p>{{ 'Rp ' . number_format($payroll->net_salary, 0, ',', '.') }}</p>
                            </div>
                    
                            <div class="form-group">
                                <label class="form-label">Pay Date</label>
                                <p>{{ $payroll->pay_date }}</p>
                            </div>
                    
                        </div>
                    </div>
                </div>
        
                <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back to List</a>
                <button id="btn-print" href="#" class="btn btn-success"><span class="bi bi-printer"></span> Print</button>
                
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('btn-print').addEventListener('click', function() {
        var printContent = document.getElementById("print-area").innerHTML;
        var originalContent = document.body.innerHTML;

        // Replace the body with the print content
        document.body.innerHTML = printContent;
            
        // Open the print dialog
        window.print();
            
        // Restore the original content after printing
        document.body.innerHTML = originalContent;
    });
    </script>
</script>

@endsection