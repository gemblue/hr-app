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
                    <a href="{{ route('leave-requests.create') }}" class="btn btn-primary mb-3 ms-auto">New Leave Request</a>
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
                            <th>Leave Type</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveRequests as $leaveRequest)
                            <tr>
                                <td>{{ $leaveRequest->employee->fullname }}</td>
                                <td>{{ $leaveRequest->leave_type }}</td>
                                <td>
                                    @if($leaveRequest->status == 'pending')
                                        <span class="text-warning">{{ ucfirst($leaveRequest->status) }}</span>
                                    @elseif($leaveRequest->status == 'confirmed')
                                        <span class="text-success">{{ ucfirst($leaveRequest->status) }}</span>
                                    @elseif($leaveRequest->status == 'rejected')
                                        <span class="text-danger">{{ ucfirst($leaveRequest->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d, M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d, M Y') }}</td>
                                <td>
                                    @if (session('role') == 'HR')
                                        @if(in_array($leaveRequest->status, ['pending', 'rejected']))
                                            <a onclick="return confirm('Sure?');" href="{{ route('leave-requests.confirm', $leaveRequest->id) }}" class="btn btn-success btn-sm">Confirm</a>
                                        @else 
                                            <a onclick="return confirm('Sure?');" href="{{ route('leave-requests.reject', $leaveRequest->id) }}" class="btn btn-warning btn-sm">Reject</a>
                                        @endif

                                        <a href="{{ route('leave-requests.edit', $leaveRequest->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <form action="{{ route('leave-requests.destroy', $leaveRequest->id) }}" method="POST" style="display:inline-block;">
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