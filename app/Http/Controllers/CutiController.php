<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuti = Cuti::orderby('created_at', 'desc')->get();
        return view('layouts.cuti.index', [
            'cuti' => $cuti
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama cuti harus diisi'
        ]);

        $pools = new Cuti($validate);
        $pools->save();

        return redirect()->route('cuti');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cuti = Cuti::find($id);
        return view('layouts.cuti.edit', [
            'cuti' => $cuti
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $oldPools = Cuti::find($id);

        $validate = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama cuti harus diisi'
        ]);

        $cuti = Cuti::find($id);
        $cuti->update($validate);

        return redirect()->route('cuti');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $cuti = Cuti::find($id);
        $cuti->delete();

        return redirect()->back();
    }
}
