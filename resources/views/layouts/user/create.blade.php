@extends('main')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('user') }}">User</a></div>
                    <div class="breadcrumb-item">Tambah</div>
                </div>
            </div>

            <div class="card">
                <form action="{{ route('user/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Tambah User</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="Email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" id="password"
                                    placeholder="Password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nrp">NRP</label>
                                <input type="text" class="form-control" name="nrp" id="nrp"
                                    placeholder="NRP">
                                @error('nrp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Divisi</label>
                                <select class="form-control" name="divisi_id" id="divisi_id" aria-label="Default select example">
                                    <option value="" selected>Pilih</option>
                                    @foreach ($divisi as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('divisi_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" id="jabatan"
                                    placeholder="Jabatan">
                                @error('jabatan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jatah_cuti">Jatah Cuti</label>
                                <input type="number" class="form-control" name="jatah_cuti" id="jatah_cuti"
                                    placeholder="Jatah Cuti">
                                @error('jatah_cuti')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alfa">Alfa</label>
                                <input type="number" class="form-control" name="alfa" id="alfa"
                                    placeholder="Alfa">
                                @error('alfa')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker" name="tgl_lahir" id="tgl_lahir" placeholder="tgl Lahir">
                                @error('tgl_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Role</label>
                                <select class="form-control" name="role_id" id="role_id" aria-label="Default select example">
                                    <option value="" selected>Pilih</option>
                                    @foreach ($role as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="/modules/select2/dist/js/select2.full.min.js"></script>
@endsection
