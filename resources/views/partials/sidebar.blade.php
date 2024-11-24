<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Akastra</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">AK</a>
        </div>
        <ul class="sidebar-menu">
            @auth
            @if(auth()->user()->role->name == 'hr')
            <li class="menu-header">Menu Utama</li>
            <li class="">
                <a class="nav-link " href="{{ route('user') }}"><i class="fas fa-boxes"></i>
                    <span>User</span></a>
            </li>
            <li class="">
                <a class="nav-link " href="{{ route('divisi') }}"><i class="fas fa-building"></i>
                    <span>Divisi</span></a>
            </li>

            <li class="">
                <a class="nav-link " href="{{ route('cuti') }}"><i class="fas fa-building"></i>
                    <span>Cuti</span></a>
            </li>
            @endif

            @if (in_array(auth()->user()->role->name, ['karyawan', 'manager', 'it', 'hr']))
            <li class="">
                <a class="nav-link " href="{{ route('jatahcuti') }}"><i class="fas fa-building"></i>
                    <span>Pengajuan Cuti</span></a>
            </li>
            @endif

            @if (auth()->user()->role->name == 'manager')
            <li class="">
                <a class="nav-link " href="{{ route('manager') }}"><i class="fas fa-building"></i>
                    <span>Daftar Pengajuan Cuti Staff</span></a>
            </li>
            @endif

            @if (auth()->user()->role->name == 'it')
            <li class="">
                <a class="nav-link " href="{{ route('role') }}"><i class="fas fa-building"></i>
                    <span>Daftar Role</span></a>
            </li>
            @endif
            @endauth
        </ul>
    </aside>
</div>
