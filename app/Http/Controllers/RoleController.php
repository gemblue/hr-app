<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Display a list of all roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Show the form to create a new role
    public function create()
    {
        return view('roles.create');
    }

    // Store a newly created role
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:roles,title|max:255',
            'description' => 'nullable',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    // Show the form for editing a role
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Update the specified role
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'title' => 'required|max:255|unique:roles,title,' . $role->id,
            'description' => 'nullable',
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    // Delete a role
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
