<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::orderby('created_at', 'desc')->get();
        return view('layouts.role.index', [
            'role' => $role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama Role harus diisi',
        ]);

        $role = new Role($validate);
        $role->save();

        return redirect()->route('role');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('layouts.role.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $oldRole = Role::find($id);

        $validate = $request->validate([
            'name' => ' required',
        ], [
            'name.required' => 'Nama Role harus diisi'
        ]);

        $role = Role::find($id);
        $role->update($validate);

        return redirect()->route('role');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {

        $role = Role::find($id);
        $role->delete();

        return redirect()->back();
    }
}
