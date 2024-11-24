@extends('main')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jenis Cuti</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Jenis Cuti</div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="align-items: right"></h4>
                        <div class="card-header-action">
                            <div class="buttons">
                                <a href="{{ route('cuti/create') }}" class="btn btn-primary">Tambah + </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @foreach ($cuti as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <a href="{{ route('cuti/edit', $item->id) }}" class="btn btn-warning" style="width: 70px;">Edit </a>
                                            <a href="{{ route('cuti/destroy', $item->id) }}" class="btn btn-danger" style="width: 70px;">Delete </a>
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
