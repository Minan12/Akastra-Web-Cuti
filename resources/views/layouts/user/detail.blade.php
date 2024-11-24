
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
        <link rel="icon" type="image/png" href="/img/favicon.png">

        <!-- General CSS Files -->
        <link rel="stylesheet" href="/modules/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/modules/fontawesome/css/all.min.css">

        <!-- CSS Libraries -->
        <link rel="stylesheet" href="/modules/jqvmap/dist/jqvmap.min.css">
        <link rel="stylesheet" href="/modules/summernote/summernote-bs4.css">
        <link rel="stylesheet" href="/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">


        <!-- CSS Files -->
        <link rel="stylesheet" href="/css/components.css"/>
        <link rel="stylesheet" href="/css/components.css.map"/>
        <link rel="stylesheet" href="/css/components.min.css"/>
        <link rel="stylesheet" href="/css/components.min.css.map"/>
        <link rel="stylesheet" href="/css/custom.css"/>
        <link rel="stylesheet" href="/css/custom.css.map"/>
        <link rel="stylesheet" href="/css/style.css"/>
        <link rel="stylesheet" href="/css/style.css.map"/>
        <link rel="stylesheet" href="/css/style.min.css"/>
        <link rel="stylesheet" href="/css/style.min.css.map"/>

        <link rel="stylesheet" href="/modules/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/modules/fontawesome/css/all.min.css">

        <!-- CSS Libraries -->
        <link rel="stylesheet" href="/modules/bootstrap-daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" href="/modules/select2/dist/css/select2.min.css">
        {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
        <link rel="stylesheet" href="/modules/jquery-selectric/selectric.css">
        <link rel="stylesheet" href="/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
        <link rel="stylesheet" href="/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

        <!-- Template CSS -->
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/components.css">

        {{-- Skins CSS --}}
        <link rel="stylesheet" href="/css/skins/reverse.css"/>
        <link rel="stylesheet" href="/css/skins/reverse.css.map"/>

        @stack('styles')
    </head>

    <body>
        <div class="container">
                <section class="section">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 style="align-items: right"></h4>
                                <div class="card-header-action">
                                    <div class="buttons">
                                        <a href="{{ route('user/exportpdf' ,$user->id) }}" class="btn btn-primary">Export Pdf</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive p-3 text-center">
                                    <h2 class="text-center">Detail User</h2>
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 col-sm-12">
                                            <p><strong>Nama :</strong> {{ $user->name }}</p>
                                            <p><strong>Email :</strong> {{ $user->email }}</p>
                                            <p><strong>NRP :</strong> {{ $user->nrp }}</p>
                                            <p><strong>Divisi :</strong> {{ $user->divisi->name }}</p>
                                            <p><strong>Jabatan :</strong> {{ $user->jabatan }}</p>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <p><strong>Jatah Cuti Belum terpakai :</strong> {{ $user->jatah_cuti }} hari</p>
                                            <p><strong>Jatah Cuti terpakai :</strong> {{ $user->cuti_terpakai }} hari</p>
                                            <p><strong>Alfa :</strong> {{ $user->alfa }} hari</p>
                                            <p><strong>Tanggal Lahir :</strong> {{ $user->tgl_lahir }}</p>
                                            <p><strong>Role :</strong> {{ $user->role->name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cek apakah user memiliki jatah cuti -->
                                {{-- @if($cutiHistory->isEmpty())
                                    <p>User ini belum memiliki riwayat jatah cuti.</p>
                                @else --}}
                                <div class="table-responsive p-3">
                                    <table class="table table-striped table-md">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Mulai Cuti</th>
                                            <th>Tanggal Akhir Cuti</th>
                                            <th>Tujuan Cuti</th>
                                            <th>Jenis Cuti</th>
                                            <th>Status</th>
                                        </tr>
                                        <tbody>
                                            @foreach ($cutiHistory as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$item->tgl_mulai_cuti}}</td>
                                                <td>{{$item->tgl_akhir_cuti}}</td>
                                                <td>{{$item->tujuan_cuti}}</td>
                                                <td>{{$item->cuti->name}}</td>
                                                <td>{{$item->status}}</td>
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

        <!-- General JS Scripts -->
        <script src="/modules/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="/modules/popper.js"></script>
        <script src="/modules/tooltip.js"></script>
        <script src="/modules/bootstrap/js/bootstrap.min.js"></script>
        <script src="/modules/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="/modules/moment.min.js"></script>
        <script src="/js/stisla.js"></script>

        <!-- JS Libraies -->
        <script src="/modules/jquery.sparkline.min.js"></script>
        <script src="/modules/chart.min.js"></script>
        <script src="/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
        <script src="/modules/summernote/summernote-bs4.js"></script>
        <script src="/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
        <script src="/modules/cleave-js/dist/cleave.min.js"></script>
        <script src="/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
        <script src="/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
        <script src="/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="/modules/select2/dist/js/select2.full.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
        {{-- <script src="/modules/jquery-selectric/jquery.selectric.min.js"></script> --}}

        <!-- Page Specific JS File -->
        <script src="/js/page/index.js"></script>
        <script src="/js/page/forms-advanced-forms.js"></script>

            <!-- Template JS File -->
        <script src="/js/bundle.js"></script>
        <script src="/js/custom.js"></script>
        <script src="/js/scripts.js"></script>
        <script src="/js/stisla.js"></script>
        {{-- <script src="/js/fetching-data.js"></script> --}}
    </body>
    </html>
