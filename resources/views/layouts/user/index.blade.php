@extends('main')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">User</div>
                </div>
            </div>
            {{-- style="align-items: right" --}}
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row d-flex align-items-center justify-content-between">
                            <form class="d-flex flex-wrap">
                                <div class="col mb-2">
                                    <div class="card-header-action">
                                        <input type="search" id="inputPassword6" name="search" value="{{$request['search']}}" class="form-control" placeholder="nrp"
                                        style="height: 40px; width: 200px; font-size: 16px; padding: 10px;">
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <select name="divisi_req" class="form-control" value="{{$request['divisi_req']}}">
                                            <option value="">-- Pilih Divisi --</option>
                                            @foreach($divisi as $divisis)
                                                <option value="{{ $divisis->name }}" {{ request('divisi') == $divisis->name ? 'selected' : '' }}>{{ $divisis->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <select name="jabatan" class="form-control" value="{{$request['jabatans']}}">
                                            <option value="">-- Pilih Jabatan --</option>
                                            @foreach($jabatan as $data)
                                                <option value="{{ $data->jabatan }}" {{ request('user') == $data->jabatan ? 'selected' : '' }}>{{ $data->jabatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col mb-2 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary rounded text-white mt-2 mr-2" style="height: 40px" id="search_btn">Search</button>
                                </div>
                            </form>
                            {{-- <div class="col mb-2">
                                <div class="card-header-action">
                                    <div class="buttons">
                                        <a href="{{ route('user/exportexcel',
                                        [
                                        'search' => $request['search'],
                                        'divisi_req' => $request['divisi_req']
                                        ]
                                        ) }}" class="btn btn-success">Export Excel</a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col mb-2">
                                <div class="card-header-action">
                                    <div class="buttons">
                                        <a href="{{ route('user/create') }}" class="btn btn-primary">Tambah + </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>NRP</th>
                                    <th>Nama Divisi</th>
                                    <th>Jabatan</th>
                                    <th>Jatah Cuti</th>
                                    <th>Cuti Terpakai</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->nrp}}</td>
                                        <td>{{$item->divisi ? $item->divisi->name : '-'}}</td>
                                        <td>{{$item->jabatan}}</td>
                                        <td>{{$item->jatah_cuti}}</td>
                                        <td>{{$item->cuti_terpakai}}</td>
                                        <td>{{$item->tgl_lahir}}</td>
                                        <td>{{$item->role ? $item->role->name : '-'}}</td>
                                        <td>
                                            <a href="{{ route('user/edit', $item->id) }}" class="btn btn-warning m-2" style="width: 70px;">Edit </a>
                                            <a href="{{ route('user/destroy', $item->id) }}" class="btn btn-danger m-2" style="width: 70px;">Delete </a>
                                            <a href="{{ route('user/detailuser', $item->id) }}" class="btn btn-info m-2" style="width: 70px;">View </a>
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
