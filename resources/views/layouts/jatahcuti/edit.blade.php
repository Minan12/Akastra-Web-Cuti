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
                <form action="{{ route('edit/update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Edit User</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tgl_mulai_cuti">Tanggal Mulai Cutir</label>
                                <input type="text" class="form-control datepicker" name="tgl_mulai_cuti" id="tgl_mulai_cuti" placeholder="tanggal mulai cuti" value="{{$jatahcuti->tgl_mulai_cuti}}">
                                @error('tanggal mulai cuti')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tgl_akhir_cuti">Tanggal Akhir Cuti</label>
                                <input type="text" class="form-control datepicker" name="tgl_akhir_cuti" id="tgl_akhir_cuti" placeholder="tanggal akhir cuti" value="{{$jatahcuti->tgl_akhir_cuti}}">
                                @error('tanggal akhir cuti')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tujuan_cuti">Tujuan Cuti</label>
                                <input type="text" class="form-control" name="tujuan_cuti" id="tujuan_cuti"
                                    placeholder="tujuan cuti" value="{{$jatahcuti->tujuan_cuti}}">
                                @error('tujuan_cuti')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Jenis Cuti</label>
                                <select class="form-control" name="cuti_id" id="cuti_id" aria-label="Default select example">
                                    <option value="{{$jatahcuti->cuti_id}}" selected>{{$jatahcuti->cuti->name}}</option>
                                    @foreach ($cuti as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @error('cuti_id')
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
