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
                                                                                {{ $ket->status }}
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
                                                                        <a href="#" class="btn btn-primary btn-rounded"
                                                                        data-toggle="modal" data-target="#myModal{{ $ket->id }}">
                                                                        Lihat File
                                                                    </a>
                                                            
                                                                    <div class="modal fade" id="myModal{{ $ket->id }}" tabindex="-1"
                                                                        role="dialog" aria-labelledby="myModalLabel{{ $ket->id }}"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="myModalLabel{{ $ket->id }}">Masukkan Password
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
                                                                                        action="/dekripsi/{{ $ket->id }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="password">Password</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="pass_id"
                                                                                                name="pass_id" value="{{ $ket->pass_id }}" hidden>
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
                                                                        @if ($ket->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $ket->id }}/terima-smp"
                                                                                method="POST" class="forms-sample"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="status"
                                                                                    value="Selesai Disposisi">
                                                                                <button type="button" class="btn btn-info"
                                                                                    onclick="submitStatusForm()">Terima
                                                                                    Surat</button>
                                                                            </form>
                                                                            <script>
                                                                                function submitStatusForm() {
                                                                                    document.getElementById('submitForm').submit();
                                                                                }
                                                                            </script>
                                                                        @elseif ($ket->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $ket->id }}/pimpinan/konfirm-smp"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
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
                                                                        @endif
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
                                                                {{-- <th> Disposisi </th> --}}
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
                                                                    {{-- <td>{{ $sek->disposisi }}</td> --}}
                                                                    <td>{{ $sek->tanggal }}</td>
                                                                    <td>
                                                                        @if ($sek->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $sek->status }}
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
                                                                        <a href="#" class="btn btn-primary btn-rounded"
                                                                        data-toggle="modal" data-target="#myModal{{ $sek->id }}">
                                                                        Lihat File
                                                                    </a>
                                                            
                                                                    <div class="modal fade" id="myModal{{ $sek->id }}" tabindex="-1"
                                                                        role="dialog" aria-labelledby="myModalLabel{{ $sek->id }}"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="myModalLabel{{ $sek->id }}">Masukkan Password
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
                                                                                        action="/dekripsi/{{ $sek->id }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="password">Password</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="pass_id"
                                                                                                name="pass_id" value="{{ $sek->pass_id }}" hidden>
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
                                                                        @if ($sek->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $sek->id }}/terima-smp"
                                                                                method="POST" class="forms-sample"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="status"
                                                                                    value="Selesai Disposisi">
                                                                                <button type="button" class="btn btn-info"
                                                                                    onclick="submitStatusForm()">Terima
                                                                                    Surat</button>
                                                                            </form>
                                                                            <script>
                                                                                function submitStatusForm() {
                                                                                    document.getElementById('submitForm').submit();
                                                                                }
                                                                            </script>
                                                                        @elseif ($sek->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $sek->id }}/pimpinan/konfirm-smp"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
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
                                                                        @endif
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
