<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class PayrollsController extends Controller
{
    // Display a listing of the payrolls
    public function index()
    {
        if (session('role')  == 'HR') {
            $payrolls = Payroll::with('employee')->get();
        } else {
            $payrolls = Payroll::with('employee')->where('employee_id', session('employee_id'))->get();
        }

        return view('payrolls.index', compact('payrolls'));
    }

    // Show the form for creating a new payroll
    public function create()
    {
        $employees = Employee::all(); // Get all employees to associate with payroll
        return view('payrolls.create', compact('employees'));
    }

    // Store a newly created payroll in the database
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary' => 'required|numeric',
            'bonuses' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
            'pay_date' => 'required|date',
        ]);

        Payroll::create($request->all());

        return redirect()->route('payrolls.index')->with('success', 'Payroll record created successfully.');
    }

    // Show the form for editing the specified payroll
    public function edit($id, LeaveRequest $leaveRequest)
    {
        $payroll = Payroll::findOrFail($id);
        $employees = Employee::all();

        return view('payrolls.edit', compact('leaveRequest', 'payroll', 'employees'));
    }

    // Display the specified slip
    public function show($id)
    {
        $payroll = Payroll::findOrFail($id);
        return view('payrolls.show', compact('payroll'));
    }

    // Update the specified payroll in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary' => 'required|numeric',
            'bonuses' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
            'pay_date' => 'required|date',
        ]);

        $payroll = Payroll::findOrFail($id);
        $payroll->update($request->all());

        return redirect()->route('payrolls.index')->with('success', 'Payroll record updated successfully.');
    }

    // Remove the specified payroll from the database
    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        return redirect()->route('payrolls.index')->with('success', 'Payroll record deleted successfully.');
    }
}
