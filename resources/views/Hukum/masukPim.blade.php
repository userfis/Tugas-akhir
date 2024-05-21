@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Data Masuk {{ $Halaman }} </h2>
    </div>
    {{-- <div class="search-field d-none d-xl-block">
        <form class="d-flex align-items-center h-100" action="#">
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-white border-0" placeholder="Search products">
            </div>
        </form>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content tab-transparent-content">
                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="row">
                                <div class="col-lg-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                @can('ketua')
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th> ID </th>
                                                                <th> Nomor Agenda </th>
                                                                <th> Nomor Surat </th>
                                                                <th> Perihal </th>
                                                                <th> Kategori Surat </th>
                                                                <th> Pengirim </th>
                                                                <th> Disposisi </th>
                                                                <th> Tgl Surat </th>
                                                                <th> Status </th>
                                                                <th> Berkas </th>
                                                                <th> Action </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($ket as $ket)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $ket->nomor_agenda }}</td>
                                                                    <td>{{ $ket->nomor_surat }}</td>
                                                                    <td>{{ $ket->perihal }}</td>
                                                                    <td>{{ $ket->kategori->kategori_surat }}</td>
                                                                    <td>{{ $ket->asal_surat }}</td>
                                                                    <td>{{ $ket->disposisi }}</td>
                                                                    <td>{{ $ket->tanggal }}</td>
                                                                    <td>
                                                                        @if ($ket->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $data->status }}
                                                                            </span>
                                                                        @elseif ($ket->status == 'Proses Pengecekan')
                                                                            <span class="badge badge-info"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fas fa-spinner"></i>
                                                                                {{ $ket->status }}
                                                                            </span>
                                                                        @elseif($ket->status == 'Diajukan')
                                                                            <span class="badge badge-warning"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-regular fa-paper-plane"></i>
                                                                                {{ $ket->status }}
                                                                            </span>
                                                                        @elseif($ket->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $ket->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="/storage/{{ $ket->file }}"
                                                                            class="btn btn-primary btn-rounded" target="blank">
                                                                            Lihat File
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="mr-1">
                                                                                <a href="/{{ $ket->id }}/detail-surat"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-eye"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div class="mr-1">
                                                                                <a href="/{{ $ket->id }}/edit-data"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-tooltip-edit"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div>
                                                                                <form action="/{{ $ket->id }}/hapus"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger btn-rounded btn-icon"
                                                                                        fdprocessedid="91w77s">
                                                                                        <i class="mdi mdi-delete"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @elsecan('sekretaris')
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th> ID </th>
                                                                <th> Nomor Agenda </th>
                                                                <th> Nomor Surat </th>
                                                                <th> Perihal </th>
                                                                <th> Kategori Surat </th>
                                                                <th> Pengirim </th>
                                                                <th> Disposisi </th>
                                                                <th> Tgl Surat </th>
                                                                <th> Status </th>
                                                                <th> Berkas </th>
                                                                <th> Action </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($sek as $sek)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $sek->nomor_agenda }}</td>
                                                                    <td>{{ $sek->nomor_surat }}</td>
                                                                    <td>{{ $sek->perihal }}</td>
                                                                    <td>{{ $sek->kategori->kategori_surat }}</td>
                                                                    <td>{{ $sek->asal_surat }}</td>
                                                                    <td>{{ $sek->disposisi }}</td>
                                                                    <td>{{ $sek->tanggal }}</td>
                                                                    <td>
                                                                        @if ($sek->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $data->status }}
                                                                            </span>
                                                                        @elseif ($sek->status == 'Proses Pengecekan')
                                                                            <span class="badge badge-info"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fas fa-spinner"></i>
                                                                                {{ $sek->status }}
                                                                            </span>
                                                                        @elseif($sek->status == 'Diajukan')
                                                                            <span class="badge badge-warning"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-regular fa-paper-plane"></i>
                                                                                {{ $sek->status }}
                                                                            </span>
                                                                        @elseif($sek->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $sek->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="/storage/{{ $sek->file }}"
                                                                            class="btn btn-primary btn-rounded" target="blank">
                                                                            Lihat File
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="mr-1">
                                                                                <a href="/{{ $sek->id }}/detail-surat"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-eye"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div class="mr-1">
                                                                                <a href="/{{ $sek->id }}/edit-data"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-tooltip-edit"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div>
                                                                                <form action="/{{ $sek->id }}/hapus"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger btn-rounded btn-icon"
                                                                                        fdprocessedid="91w77s">
                                                                                        <i class="mdi mdi-delete"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
