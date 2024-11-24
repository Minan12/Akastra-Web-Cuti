<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\JatahCuti;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class JatahCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $jatahcuti = JatahCuti::with(['user.divisi', 'cuti'])->orderby('created_at', 'desc')->get();

        $user = auth()->user();

        if ($user->role == 'manager' || $user->role == 'hr') {
            $jatahcuti = JatahCuti::with(['user.divisi', 'cuti'])->orderby('created_at', 'desc')->get();
        } else {
            // User biasa hanya bisa melihat pengajuan cuti mereka sendiri
            $jatahcuti = JatahCuti::with(['user.divisi', 'cuti'])
                ->where('user_id', $user->id)
                ->orderby('created_at', 'desc')
                ->get();
        }

        return view('layouts.karyawan.index', [
            'jatahcuti' => $jatahcuti
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::orderby('created_at', 'asc')->get();
        $cuti = Cuti::orderby('created_at', 'desc')->get();

        return view('layouts.karyawan.create', [
            'user' => $user,
            'cuti' => $cuti
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'tgl_mulai_cuti' => 'required|date',
            'tgl_akhir_cuti' => 'required|date|after_or_equal:tgl_mulai_cuti',
            'tujuan_cuti' => 'required|string|max:255',
            'cuti_id' => 'required|exists:cutis,id',
        ], [
            'tgl_mulai_cuti.required' => 'Tanggal mulai cuti harus diisi',
            'tgl_akhir_cuti.required' => 'Tanggal akhir cuti harus diisi',
            'tgl_akhir_cuti.after_or_equal' => 'Tanggal akhir cuti harus setelah atau sama dengan tanggal mulai cuti',
            'tujuan_cuti.required' => 'Tujuan cuti harus diisi',
            'cuti_id.required' => 'Jenis cuti harus dipilih',
            'cuti_id.exists' => 'Jenis cuti yang dipilih tidak valid',
        ]);

        $tglMulai = Carbon::parse($validate['tgl_mulai_cuti']);
        $tglAkhir = Carbon::parse($validate['tgl_akhir_cuti']);
        $jumlahcuti = $tglMulai->diffInDays($tglAkhir) + 1;

        $validate['user_id'] = auth()->id();

        $validate['jumlah_cuti'] = $jumlahcuti;

        $jatahCuti = new JatahCuti($validate);
        $jatahCuti->save();

        return redirect()->route('jatahcuti');
    }

    public function approve(Request $request, $id)
    {
        // Dapatkan pengajuan cuti berdasarkan ID
        $leave = JatahCuti::find($id);

        // Dapatkan user yang sedang login
        $manager = auth()->user();

        if ($leave && $leave->status == 'pending') {
            // Dapatkan user yang mengajukan cuti
            $employee = User::find($leave->user_id);

            // Cek apakah manager dan employee berada di divisi yang sama
            if ($manager->divisi_id !== $employee->divisi_id) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk meng-approve cuti dari divisi lain.');
            }

            // Convert the date strings to Carbon instances
            $startDate = Carbon::parse($leave->tgl_mulai_cuti);
            $endDate = Carbon::parse($leave->tgl_akhir_cuti);

            // Mengurangi jatah cuti
            $usedDays = $endDate->diffInDays($startDate) + 1;

            // Cek apakah karyawan memiliki jatah cuti yang cukup
            if ($employee->jatah_cuti < $usedDays) {
                Alert::error('Error', 'Jatah Cuti tidak cukup');
                return redirect()->back();
            }

            // Kurangi jatah cuti dan tambah cuti terpakai
            $employee->jatah_cuti -= $usedDays;
            $employee->cuti_terpakai += $usedDays;

            // Simpan perubahan pada data karyawan dan pengajuan cuti
            $employee->save();

            // Update status pengajuan cuti menjadi 'approved'
            $leave->status = 'approved';
            $leave->save();

            Alert::success('Success', 'Data berhasil di Approved');

            return redirect()->back();
        }

        Alert::error('Error', 'Terjadi Kesalahan Pada sistem');
        return redirect()->back();
        // ->with('error', 'Leave request not found or already processed.')
    }

    public function reject(Request $request, $id)
    {

        // Dapatkan pengajuan cuti berdasarkan ID
        $leave = JatahCuti::find($id);

        // Dapatkan user yang sedang login
        $manager = auth()->user();

        if ($leave && $leave->status == 'pending') {
            // Dapatkan user yang mengajukan cuti
            $employee = User::find($leave->user_id);

            // Cek apakah manager dan employee berada di divisi yang sama
            if ($manager->divisi_id !== $employee->divisi_id) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menolak cuti dari divisi lain.');
            }

            // Update status pengajuan cuti menjadi 'rejected'
            $leave->status = 'rejected';
            $leave->save();

            Alert::success('Success', 'Cuti telah ditolak');

            return redirect()->back();
            // ->with('success', 'Cuti telah ditolak.')
        }
        Alert::success('Success', 'Cuti telah ditolak');

        return redirect()->back();
        // ->with('success', 'Cuti telah ditolak.')
    }

    public function details($id)
    {

        // Mendapatkan user yang sedang login
        $user = auth()->user();

        // Mengambil data cuti berdasarkan id pengajuan cuti
        $jatahcuti = JatahCuti::with(['user.divisi', 'cuti'])
            ->where('id', $id)
            ->where('user_id', $user->id) // Pastikan user hanya melihat cuti yang mereka ajukan
            ->first();

        // Jika data cuti tidak ditemukan atau user mencoba mengakses data milik orang lain
        if (!$jatahcuti) {
            abort(404, 'Data pengajuan cuti tidak ditemukan atau Anda tidak berhak mengakses data ini.');
        }

        // Return view untuk menampilkan detail cuti
        return view('layouts.karyawan.details', [
            'jatahcuti' => $jatahcuti
        ]);
    }

    public function exportpdf($id)
    {
        // Mendapatkan user yang sedang login
        $user = auth()->user();

        // Mengambil data jatah cuti berdasarkan id pengajuan cuti
        $jatahcuti = JatahCuti::with(['user.divisi', 'cuti'])
            ->where('id', $id)
            ->where('user_id', $user->id) // Pastikan user hanya melihat cuti yang mereka ajukan
            ->first();

        // Jika data tidak ditemukan, tampilkan error
        if (!$jatahcuti) {
            abort(404, 'Data pengajuan cuti tidak ditemukan atau Anda tidak berhak mengakses data ini.');
        }

        // Load view untuk PDF dan kirim data jatah cuti ke view
        $pdf = PDF::loadView('layouts.jatahcuti.exportpdf', compact('jatahcuti'));

        // Set nama file dan download file PDF
        return $pdf->download('detail_cuti_' . $jatahcuti->user->name . '.pdf');
    }

    public function manager()
    {
        $manager = auth()->user();

        // Mengambil pengajuan cuti yang statusnya masih pending dan hanya dari user yang berada di divisi yang sama dengan manager
        $pengajuanCuti = JatahCuti::where('status', 'pending')
            ->whereHas('user', function ($query) use ($manager) {
                $query->where('divisi_id', $manager->divisi_id);
            })
            ->with(['user.divisi', 'cuti'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('layouts.manager.index', [
            'pengajuanCuti' => $pengajuanCuti
        ]);
    }
}
