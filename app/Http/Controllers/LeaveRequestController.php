<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        if (session('role')  == 'HR') {
            $leaveRequests = LeaveRequest::all();
        } else {
            $leaveRequests = LeaveRequest::where('employee_id', session('employee_id'))->get();
        }
        
        return view('leave_requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        $employees = Employee::all();

        return view('leave_requests.create', compact('employees'));
    }

    public function store(Request $request)
    {
        if (session('role') != 'HR') {
            // Kalau bukan HR, maka employee_id diambil dari session.
            $request->merge(['employee_id' => session('employee_id')]);
        }

        // Ketika pertama kali membuat request cuti, statusnya adalah pending
        $request->merge(['status' => 'pending']);

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        LeaveRequest::create($request->all());

        return redirect()->route('leave-requests.index')->with('success', 'Leave Request Created Successfully');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        return view('leave_requests.show', compact('leaveRequest'));
    }

    public function edit(LeaveRequest $leaveRequest)
    {
        $employees = Employee::all();
        $statuses = ['pending', 'confirmed', 'rejected'];

        return view('leave_requests.edit', compact('leaveRequest', 'employees', 'statuses'));
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        $leaveRequest->update($request->all());

        return redirect()->route('leave-requests.index')->with('success', 'Leave Request Updated Successfully');
    }

    public function confirm(int $id)
    {
        LeaveRequest::findOrFail($id)->update([
            'status' => 'confirmed',
        ]);

        // Jika sudah diconfirm, masukan dalam absensi jenis cuti.
        
        
        return redirect()->route('leave-requests.index')->with('success', 'Leave Request Updated Successfully');
    }

    public function reject(int $id)
    {
        LeaveRequest::findOrFail($id)->update([
            'status' => 'rejected',
        ]);
        
        return redirect()->route('leave-requests.index')->with('success', 'Leave Request Updated Successfully');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return redirect()->route('leave-requests.index')->with('success', 'Leave Request Deleted Successfully');
    }
}
