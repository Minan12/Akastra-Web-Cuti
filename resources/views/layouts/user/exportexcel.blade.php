{{-- <h1 class="text-center">REKAP CUTI TAHUNAN</h1>

<table class="table" style="zoom: 0.8">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">NRP</th>
            <th scope="col">Divisi </th>
            <th scope="col">Jabatan</th>
            <th scope="col">Jatah Cuti</th>
            <th scope="col">Cuti Terpakai</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($user as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->nrp}}</td>
                <td>{{$item->divisi->name}}</td>
                <td>{{$item->jabatan}}</td>
                <td>{{$item->jatah_cuti}}</td>
                <td>{{$item->cuti_terpakai}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p><strong>HRD</strong></p>  --}}


<div class="max-w-6xl mx-auto bg-white rounded shadow-lg">
    <div class="p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Rekap Cuti Tahunan Karyawan</h1>
    </div>
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">NRP</th>
                <th scope="col">Divisi </th>
                <th scope="col">Jabatan</th>
                <th scope="col">Jatah Cuti</th>
                <th scope="col">Cuti Terpakai</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($user as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->nrp}}</td>
                    <td>{{$item->divisi->name}}</td>
                    <td>{{$item->jabatan}}</td>
                    <td>{{$item->jatah_cuti}}</td>
                    <td>{{$item->cuti_terpakai}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 text-right">
        <div class="inline-block border border-gray-300 p-2">
            <p class="font-bold">HRD</p>
            <div class="h-16"></div>
        </div>
    </div>
</div>
