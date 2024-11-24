<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisi = Divisi::orderby('created_at', 'desc')->get();
        return view('layouts.divisi.index', [
            'divisi' => $divisi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama divisi harus diisi'
        ]);

        $divisi = new Divisi($validate);
        $divisi->save();

        return redirect()->route('divisi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $divisi = Divisi::find($id);
        return view('layouts.divisi.edit', [
            'divisi' => $divisi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $oldDivisi = Divisi::find($id);

        $validate = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Nama divisi harus diisi'
        ]);

        $divisi = Divisi::find($id);
        $divisi->update($validate);

        return redirect()->route('divisi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $divisi = Divisi::find($id);
        $divisi->delete();

        return redirect()->back();
    }
}
