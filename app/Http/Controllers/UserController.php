<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Divisi;
use App\Models\JatahCuti;
use App\Models\Role;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        $divisi = Divisi::all();

        $jabatan = User::select('jabatan')->distinct()->orderBy('jabatan', 'asc')->get();

        $search = $request->input('search');
        $divisi_req = $request->input('divisi_req');
        $jabatans = $request->input('jabatan');


        $users = User::with(['role', 'divisi', 'jatahcuti'])
            ->orderby('created_at', 'desc');

        if ($request['search']) {
            $users->where('name', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('nrp', $request['search']);
        }

        if ($request['divisi_req']) {
            $users->whereHas('divisi', function ($divisi) use ($request) {
                $divisi->where('name', 'LIKE', '%' . $request['divisi_req'] . '%');
            });
        }

        if ($request['jabatan']) {
            $users->where('jabatan', $request['jabatan']);
        }

        $user = $users->get();


        return view('layouts.user.index', [
            'user' => $user,
            'divisi' => $divisi,
            'jabatan' => $jabatan,
            'request' => [
                'search' => $search,
                'divisi_req' => $divisi_req,
                'jabatans' => $jabatans,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisi = Divisi::orderby('name', 'asc')->get();
        $role = Role::orderby('name', 'desc')->get();

        return view('layouts.user.create', [
            'divisi' => $divisi,
            'role' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nrp' => 'required',
            'divisi_id' => 'required',
            'jabatan' => 'required',
            'jatah_cuti' => 'required',
            'alfa' => 'required',
            'tgl_lahir' => 'required',
            'role_id' => 'required',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'nrp.required' => 'nrp harus diisi',
            'divisi_id.required' => 'divisi harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'jatah_cuti.required' => 'Jatah Cuti harus diisi',
            'alfa.required' => 'Alfa harus diisi',
            'tgl_lahir.required' => 'tanggal lahir harus diisi',
            'role_id.required' => 'role harus diisi',
        ]);

        $user = new User($validate);
        $user->save();
        // \Log::info('data :' . $user);

        return redirect()->route('user');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $divisi = Divisi::orderby('name', 'asc')->get();
        $role = Role::orderby('name', 'asc')->get();

        return view('layouts.user.edit', [
            'user' => $user,
            'divisi' => $divisi,
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        try {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'nrp' => 'required',
                'divisi_id' => 'required',
                'jabatan' => 'required',
                'jatah_cuti' => 'required|integer',
                'alfa' => 'required|integer',
                'tgl_lahir' => 'required|date',
                'role_id' => 'required',
            ];

            // Hanya validasi password jika diisi
            if ($request->filled('password')) {
                $rules['password'] = 'min:6';
            }

            $validate = $request->validate($rules);

            // Hanya update password jika diisi
            if ($request->filled('password')) {
                $validate['password'] = bcrypt($request->password);
            } else {
                unset($validate['password']);
            }

            $user->update($validate);

            return redirect()->route('user')->with('success', 'User berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // \Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui user. Silakan coba lagi.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }

    /**
     * Get the details of the user cuti
     */
    public function detailuser($id)
    {
        //ambil user bedasarkan ID
        $user = User::with(['role', 'divisi'])->findorFail($id);

        // Ambil data jatah cuti berdasarkan user_id
        $cutiHistory = JatahCuti::with('cuti')->where('user_id', $id)->get();

        return view('layouts.user.detail', [
            'user' => $user,
            'cutiHistory' => $cutiHistory,
        ]);
    }

    public function exportpdf($id)
    {
        // Ambil data user berdasarkan ID dengan relasi yang diperlukan
        $user = User::with(['role', 'divisi'])->findorFail($id);

        // Ambil data jatah cuti berdasarkan user_id
        $cutiHistory = JatahCuti::with('cuti')->where('user_id', $id)->get();

        // Load view dengan data user dan jatah cuti untuk PDF
        $pdf = PDF::loadView('layouts.user.exportpdf', [
            'user' => $user,
            'cutiHistory' => $cutiHistory,
        ]);

        // Download PDF
        return $pdf->download('user_' . $user->name . '.pdf');
    }

    public function excel()
    {
        return view('layouts.user.exportexcel');
    }

    public function exportUserByDivisi($divisi_id)
    {
        return Excel::download(new UsersExport($divisi_id), 'user_divisi_' . $divisi_id . 'user.xlsx');
    }

    public function export(Request $request)
    {
        return Excel::download(new UsersExport($request), 'user_export.xlsx');
    }
}
