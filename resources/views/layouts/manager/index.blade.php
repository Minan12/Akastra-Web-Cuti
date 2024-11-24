@extends('main')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Pengajuan Cuti Karyawan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Daftar Pengajuan Cuti Karyawan</div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>NRP</th>
                                    <th>Nama Divisi</th>
                                    <th>Jabatan</th>
                                    <th>Jatah Cuti</th>
                                    <th>Hari Cuti</th>
                                    <th>Tanggal Mulai Cuti</th>
                                    <th>Tanggal Akhir Cuti</th>
                                    <th>Tujuan Cuti</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @foreach ($pengajuanCuti as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->user->nrp}}</td>
                                        <td>{{$item->user->divisi->name}}</td>
                                        <td>{{$item->user->jabatan}}</td>
                                        <td>{{$item->user->jatah_cuti}}</td>
                                        <td>{{$item->jumlah_cuti}}</td>
                                        <td>{{$item->tgl_mulai_cuti}}</td>
                                        <td>{{$item->tgl_akhir_cuti}}</td>
                                        <td>{{$item->tujuan_cuti}}</td>
                                        <td>
                                            <form action="{{ route('manager/approve', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning" style="width: 70px;">Approve</button>
                                            </form>

                                            <form action="{{ route('manager/reject', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger" style="width: 70px;">Reject</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
