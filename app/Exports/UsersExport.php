<?php

namespace App\Exports;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $request;

    public function __construct($request)
    {

        $this->request = $request;
    }

    public function view(): View
    {
        $request = $this->request;

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


        return view('layouts.user.exportexcel', [
            'request' => [
                'search' => $search,
                'divisi_req' => $divisi_req,
                'jabatans' => $jabatans,
            ],
            'user' => $user
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A2:G2' => ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]],
            'A2:G' . $sheet->getHighestRow() => ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]],
        ];
    }
}
