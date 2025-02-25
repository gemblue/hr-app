<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PresencesController extends Controller
{
    public function index()
    {
        if (session('role')  == 'HR') {
            $attendances = Presence::with('employee')->get();
        } else {
            $attendances = Presence::with('employee')->where('employee_id', session('employee_id'))->get();
        }
        
        return view('presences.index', compact('attendances'));
    }

    // Show the form to create a new attendance record
    public function create()
    {
        $employees = Employee::all();

        return view('presences.create', compact('employees'));
    }

    // Store a newly created attendance record
    public function store(Request $request)
    {
        if (session('role')  == 'HR') {

            $validator = Validator::make($request->all(), [
                'employee_id' => 'required|exists:employees,id',
                'check_in' => 'required|date',
                'check_out' => 'nullable|date|after_or_equal:check_in',
                'status' => 'required|in:present,absent,leave'
            ]);

            if ($validator->fails()) {
                return redirect()->route('presences.index')->withErrors($validator)->withInput();
            }

            Presence::create([
                'employee_id' => $request->employee_id,
                'check_in' => Carbon::parse($request->check_in)->format('Y-m-d H:i:s'),
                'check_out' => Carbon::parse($request->check_out)->format('Y-m-d H:i:s'),
                'date' => date('Y-m-d H:i:s'),
                'status' => $request->status
            ]);

        } else {

            // Mode karyawan biasa, cuma absen sederhana
            Presence::create([
                'employee_id' => session('employee_id'),
                'check_in' => Carbon::now()->format('Y-m-d H:i:s'),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date' => date('Y-m-d H:i:s'),
                'status' => 'present'
            ]);
            
        }

        return redirect()->route('presences.index')->with('success', 'Recorded successfully');
    }

    // Show the form for editing an attendance record
    public function edit(Presence $presence)
    {
        $employees = Employee::all();
        return view('presences.edit', compact('presence', 'employees'));
    }

    // Update the specified attendance record
    public function update(Request $request, Presence $presence)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'check_in' => 'required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
            'status' => 'required|in:present,absent,leave',
        ]);

        $presence->update($request->all());

        return redirect()->route('presences.index')->with('success', 'Updated successfully');
    }

    // Delete an attendance record
    public function destroy(Presence $presence)
    {
        $presence->delete();

        return redirect()->route('presences.index')->with('success', 'Deleted successfully');
    }
}
