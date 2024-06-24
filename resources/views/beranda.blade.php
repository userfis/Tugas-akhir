@extends('homepage.index')

@section('page-header')
<div class="d-xl-flex justify-content-between align-items-start">
    <h2 class="text-dark font-weight-bold mb-2">Dashboard</h2>
</div>
<div class="search-field d-none d-xl-block">
    {{-- 
    <form class="d-flex align-items-center h-100" action="{{ route('master') }}" method="GET">
        <div class="input-group">
            <div class="input-group-prepend bg-transparent">
                <i class="input-group-text border-0 mdi mdi-magnify"></i>
            </div>
            <input type="text" class="form-control bg-white border-0" name="search" placeholder="Search ..."  value="{{ request('search') }}">
        </div>
    </form> 
    --}}
</div>
<style>
   .square-card {
        height: 200px; /* Sesuaikan dengan ketinggian yang diinginkan */
        background-color: #e74c3c; /* Warna merah */
        color: #fff; /* Warna teks putih */
        border-radius: 15px;
    }

    .square-card .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0; /* Menghapus padding di dalam card-body */
    }

    .square-card .icon-md {
        font-size: 48px; /* Sesuaikan ukuran ikon */
        color: #fff; /* Warna ikon putih */
    }
</style>
<div class="row justify-content-center">
    
    <div class="col-md-3 col-lg-3">
        <div class="card square-card">
            <div class="card-body text-center">
                <h5 class="mb-2 font-weight-normal">Jumlah Surat Masuk</h5>
                <h2 class="mb-4 font-weight-bold">{{ $data }}</h2>
                <div id="circle-progress-1" class="dashboard-progress d-flex align-items-center justify-content-center item-parent">
                    <i class="mdi mdi-email-outline icon-md absolute-center"></i>
                </div>
                <p class="mt-4 mb-0">Surat Masuk Hari Ini</p>
                <h3 class="mb-0 font-weight-bold mt-2">{{ $dathar }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3">
        <div class="card square-card" style="background-color:#8ae34a;">
            <div class="card-body text-center">
                <h5 class="mb-2 text-white font-weight-normal">Jumlah Surat Keluar</h5>
                <h2 class="mb-4 text-white font-weight-bold">{{ $keluar }}</h2>
                <div id="circle-progress-1" class="dashboard-progress d-flex align-items-center justify-content-center item-parent">
                    <i class="mdi mdi-email-open icon-md absolute-center text-white"></i>
                </div>
                <p class="mt-4 mb-0">Surat Keluar Hari Ini</p>
                <h3 class="mb-0 font-weight-bold mt-2 text-white">{{ $kelhar }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3">
        <div class="card square-card" style="background-color: #d7a74c;">
            <div class="card-body text-center">
                <h5 class="mb-2 text-white font-weight-normal">Di Arsipkan</h5>
                <h2 class="mb-4 text-white font-weight-bold">{{ $arsip }}</h2>
                <div id="circle-progress-2" class="dashboard-progress d-flex align-items-center justify-content-center item-parent">
                    <i class="mdi mdi-file icon-md absolute-center text-white"></i>
                </div>
                <p class="mt-4 mb-0">Diarsipkan Hari Ini</p>
                <h3 class="mb-0 font-weight-bold mt-2 text-white">{{ $arhar }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3">
        <div class="card square-card" style="background-color: #5fa3da;">
            <div class="card-body text-center">
                <h5 class="mb-2 text-white font-weight-normal">Disposisi</h5>
                <h2 class="mb-4 text-white font-weight-bold">{{ $dis }}</h2>
                <div id="circle-progress-3" class="dashboard-progress d-flex align-items-center justify-content-center item-parent">
                    <i class="mdi mdi-account-multiple icon-md absolute-center text-white"></i>
                </div>
                <p class="mt-4 mb-0">Disposisi Hari Ini</p>
                <h3 class="mb-0 font-weight-bold mt-2 text-white">{{ $dishar }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection

