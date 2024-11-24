@extends('main')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengajuan Cuti</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Pengajuan Cuti</div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        @if ($jatahcuti->isNotEmpty())
                            <h4>Jatah Cuti : {{ $jatahcuti->first()->user->jatah_cuti }}</h4>
                            <h4>Cuti Terpakai : {{$jatahcuti->first()->user->cuti_terpakai}}</h4>
                        @endif
                        <h4 style="align-items: right"></h4>
                        <div class="card-header-action">
                            <div class="buttons">
                                <a href="{{ route('jatahcuti/create') }}" class="btn btn-primary">Tambah + </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Mulai Cuti</th>
                                    <th>Tanggal Akhir Cuti</th>
                                    <th>Tujuan Cuti</th>
                                    <th>Jumlah Hari</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @foreach ($jatahcuti as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->tgl_mulai_cuti}}</td>
                                        <td>{{$item->tgl_akhir_cuti}}</td>
                                        <td>{{$item->tujuan_cuti}}</td>
                                        <td>{{$item->jumlah_cuti}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>
                                            <a href="{{ route('jatahcuti/detailcuti', $item->id) }}" class="btn btn-info m-2" style="width: 70px;">View </a>
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
