@extends('main')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('user') }}">User</a></div>
                    <div class="breadcrumb-item">Edit</div>
                </div>
            </div>

            <div class="card">
                <form action="{{ route('user/update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Edit User</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Nama" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Masukkan password baru jika ingin mengubah">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nrp">NRP</label>
                                <input type="text" class="form-control" name="nrp" id="nrp"
                                    placeholder="NRP" value="{{ old('nrp', $user->nrp) }}">
                                @error('nrp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="divisi_id">Divisi</label>
                                <select class="form-control" name="divisi_id" id="divisi_id">
                                    @foreach ($divisi as $div)
                                        <option value="{{ $div->id }}" {{ $user->divisi_id == $div->id ? 'selected' : '' }}>
                                            {{ $div->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('divisi_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" id="jabatan"
                                    placeholder="Jabatan" value="{{ old('jabatan', $user->jabatan) }}">
                                @error('jabatan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jatah_cuti">Jatah Cuti</label>
                                <input type="number" class="form-control" name="jatah_cuti" id="jatah_cuti"
                                    placeholder="Jatah Cuti" value="{{ old('jatah_cuti', $user->jatah_cuti) }}">
                                @error('jatah_cuti')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alfa">Alfa</label>
                                <input type="number" class="form-control" name="alfa" id="alfa"
                                    placeholder="Alfa" value="{{ old('alfa', $user->alfa) }}">
                                @error('alfa')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                    value="{{ old('tgl_lahir', $user->tgl_lahir) }}">
                                @error('tgl_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="role_id">Role</label>
                                <select class="form-control" name="role_id" id="role_id">
                                    @foreach ($role as $r)
                                        <option value="{{ $r->id }}" {{ $user->role_id == $r->id ? 'selected' : '' }}>
                                            {{ $r->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
