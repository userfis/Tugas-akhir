<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        @can('superadmin')
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master">
                <span class="icon-bg"><i class="mdi mdi-database menu-icon"></i></span>
                <span class="menu-title">Master</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="master"> <!-- pastikan id unik -->
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('arsip') }}">Arsip Surat</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Disposisi</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Kategori Surat</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="icon-bg"><i class="mdi mdi-database menu-icon"></i></span>
                <span class="menu-title">Surat</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic"> <!-- pastikan id unik -->
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('masuk') }}">surat masuk</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('surat-keluar') }}">surat keluar</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Data</span>
            </a>
        </li>
        
        @elsecan('staffKeu')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff-sm') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Masuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff-sk') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Keluar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Unggah Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Arsip Data</span>
            </a>
        </li>
        

        @elsecan('staffHuk')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff-sm') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Masuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff-sk') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Keluar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Unggah Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Arsip Data</span>
            </a>
        </li>
        

        @elsecan('staffDat')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff-sm') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Masuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff-sk') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Keluar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Unggah Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Arsip Data</span>
            </a>
        </li>
        

        @elsecan('staffTek')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff-sm') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Masuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('staff-sk') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Keluar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Unggah Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Arsip Data</span>
            </a>
        </li>
        

        @elsecan('sekretaris')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cek-sm') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Cek Surat Masuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cek-sk') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Cek Surat Keluar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('masuk-hukum') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Masuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pimpinan-sk') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Keluar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Cek Data Masuk</span>
            </a>
        </li>
    

        @elsecan('ketua')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cek-sm') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Cek Surat Masuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cek-sk') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Cek Surat Keluar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('masuk-hukum') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Masuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pimpinan-sk') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Keluar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Cek Data Masuk</span>
            </a>
        </li>
        @endcan
        
    </ul>
</nav>




{{-- <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
                <span class="menu-title">Charts</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="icon-bg"><i class="mdi mdi-table-large menu-icon"></i></span>
                <span class="menu-title">Tables</span>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
            </div>
        </li> --}}

        {{-- <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">
                <a href="#" class="nav-link"><i class="mdi mdi-settings menu-icon"></i>
                    <span class="menu-title">Settings</span>
                </a>
            </div>
        </li>
        <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">
                <a href="#" class="nav-link"><i class="mdi mdi-speedometer menu-icon"></i>
                    <span class="menu-title">Take Tour</span></a>
            </div>
        </li> --}}
        {{-- <li class="nav-item sidebar-user-actions">
        <div class="sidebar-user-menu">
          <a href="#" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
            <span class="menu-title">Log Out</span></a>
        </div>
      </li> --}}
        {{-- <li class="nav-item sidebar-user-actions">
        <div class="sidebar-user-menu">
          <form action="/logout" method="POST">
            <button type="submit" class="nav-link" style="border: none; background: none; padding: 0; margin: 0;">
              <i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title">Log Out</span>
            </button>
          </form>
        </div>
      </li> --}}
