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
                                                @can('sekretaris')
                                                <a href="{{ route('tambah-keluar') }}"><button type="button"
                                                    class="btn btn-primary btn-fw">Tambah Data</button>
                                            </a>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> Nomor Agenda </th>
                                                        <th> Nomor Surat </th>
                                                        <th> Perihal </th>
                                                        <th> Kategori Surat </th>
                                                        <th> Tujuan Surat </th>
                                                        <th> Lampiran </th>
                                                        <th> Tgl Surat Keluar </th>
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
                                                            <td>{{ $sek->lampiran }}</td>
                                                            <td>{{ $sek->tanggal }}</td>
                                                            <td>{{ $sek->status }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-primary btn-rounded"
                                                                        data-toggle="modal" data-target="#myModal"
                                                                        target="blank">
                                                                        Lihat File
                                                                    </a>
                                                                    {{-- modal --}}
                                                                    <div class="modal fade" id="myModal" tabindex="-1"
                                                                        role="dialog" aria-labelledby="myModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="myModalLabel">Masukkan Password
                                                                                        Dekripsi</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="decryptForm"
                                                                                        action="/dekripsi/{{ $data->id }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="password">Password</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="pass_id"
                                                                                                name="pass_id"
                                                                                                value="{{ $data->pass_id }}"
                                                                                                hidden>
                                                                                            <input type="password"
                                                                                                class="form-control"
                                                                                                id="password"
                                                                                                name="password" required>
                                                                                        </div>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">Submit</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </td>
                                                            <td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mr-1">
                                                                        {{-- <a href="/{{ $sek->id }}/detail-surat"
                                                                            class="btn btn-primary btn-rounded">
                                                                            <i class="mdi mdi-eye"
                                                                                style="font-size: 15px;"></i>
                                                                        </a> --}}
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
                                            @elsecan('ketua')
                                            <a href="{{ route('tambah-keluar') }}"><button type="button"
                                                class="btn btn-primary btn-fw">Tambah Data</button>
                                        </a>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Nomor Agenda </th>
                                                    <th> Nomor Surat </th>
                                                    <th> Perihal </th>
                                                    <th> Kategori Surat </th>
                                                    <th> Tujuan Surat </th>
                                                    <th> Lampiran </th>
                                                    <th> Tgl Surat Keluar</th>
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
                                                        <td>{{ $ket->lampiran }}</td>
                                                        <td>{{ $ket->tanggal }}</td>
                                                        <td>{{ $ket->status }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary btn-rounded"
                                                            data-toggle="modal" data-target="#myModal"
                                                            target="blank">
                                                            Lihat File
                                                        </a>
                                                        {{-- modal --}}
                                                        <div class="modal fade" id="myModal" tabindex="-1"
                                                            role="dialog" aria-labelledby="myModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="myModalLabel">Masukkan Password
                                                                            Dekripsi</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span
                                                                                aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="decryptForm"
                                                                            action="/dekripsi/{{ $data->id }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="password">Password</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="pass_id"
                                                                                    name="pass_id"
                                                                                    value="{{ $data->pass_id }}"
                                                                                    hidden>
                                                                                <input type="password"
                                                                                    class="form-control"
                                                                                    id="password"
                                                                                    name="password" required>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
    </div>
@endsection
