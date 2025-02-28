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
                <h3>Tasks</h3>
                <p class="text-subtitle text-muted">Manage tasks data.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item">Tasks</li>
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
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3 ms-auto">New Task</a>
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
                            <th>Title</th>
                            <th>Assigned To</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->employee->fullname }}</td>
                                <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d F Y') }}</td>
                                <td>
                                    @if($task->status == 'pending')
                                        <span class="text-warning">Pending</span>
                                    @elseif($task->status == 'done')
                                        <span class="text-success">Done</span>
                                    @elseif($task->status == 'on progress')
                                        <span class="text-info">On Progress</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('tasks.show', $task->id) }}">View</a>
                                    
                                    @if ($task->status == 'pending')
                                        <a class="btn btn-success btn-sm" href="{{ route('tasks.done', $task->id) }}">Mark as Done</a>
                                    @else 
                                        <a class="btn btn-warning btn-sm" href="{{ route('tasks.pending', $task->id) }}">Mark as Pending</a>
                                    @endif
                                    
                                    @if (session('role') == 'HR')
                                        <a class="btn btn-warning btn-sm" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
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