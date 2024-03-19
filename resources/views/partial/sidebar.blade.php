<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        {{-- <li class="nav-item">
        <a class="nav-link" href="index.html">
          <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
                <span class="menu-title">Data & Informasi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('master') }}">Master Data</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('masuk') }}">Data Masuk</a></li>

                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#keuangan" aria-expanded="false" aria-controls="keuangan">
                <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
                <span class="menu-title">Keuangan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="keuangan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('master-keuangan') }}">Master Data</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('masuk-keuangan') }}">Data Masuk</a></li>
                </ul>
            </div>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="icon-bg"><i class="mdi mdi-database menu-icon"></i></span>
                <span class="menu-title">Data & Informasi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic"> <!-- pastikan id unik -->
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('master') }}">Master Data</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('masuk') }}">Data Masuk</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#keuangan" aria-expanded="false" aria-controls="keuangan">
                <span class="icon-bg"><i class="mdi mdi-bank menu-icon"></i></span>
                <span class="menu-title">Keuangan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="keuangan"> <!-- pastikan id unik -->
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('master-keuangan') }}">Master Data</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('masuk-keuangan') }}">Data Masuk</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#teknis" aria-expanded="false" aria-controls="teknis">
                <span class="icon-bg"><i class="mdi mdi-clipboard-text menu-icon"></i></span>
                <span class="menu-title">Teknis</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="teknis"> <!-- pastikan id unik -->
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('master-teknis') }}">Master Data</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('masuk-teknis') }}">Data Masuk</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#hukum" aria-expanded="false" aria-controls="hukum">
                <span class="icon-bg"><i class="mdi mdi-scale-balance menu-icon"></i></span>
                <span class="menu-title">Hukum</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="hukum"> <!-- pastikan id unik -->
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('master-hukum') }}">Master Data</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('masuk-hukum') }}">Data Masuk</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('keluar') }}">
                <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                <span class="menu-title">Surat Keluar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
                <span class="menu-title">Charts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="icon-bg"><i class="mdi mdi-table-large menu-icon"></i></span>
                <span class="menu-title">Tables</span>
            </a>
        </li>
        <li class="nav-item">
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
        </li>

        <li class="nav-item sidebar-user-actions">
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
        </li>
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
    </ul>
</nav>
