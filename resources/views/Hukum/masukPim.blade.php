@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Data Surat Masuk </h2>
    </div>
    <div class="search-field d-xl-block mb-0">
        <form class="d-flex align-items-center h-100" action="{{ route('masuk-pim-search') }}" method="GET">
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    {{-- <i class="input-group-text border-0 mdi mdi-magnify"></i> --}}
                </div>
                <input type="text" class="form-control bg-white border-0" name="query"
                    placeholder="Cari berdasarkan nomor surat atau perihal">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>
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
                                                            @foreach ($ket as $k)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $k->nomor_agenda }}</td>
                                                                    <td>{{ $k->nomor_surat }}</td>
                                                                    <td>{{ $k->perihal }}</td>
                                                                    <td>{{ $k->kategori->kategori_surat }}</td>
                                                                    <td>{{ $k->asal_surat }}</td>
                                                                    <td>{{ $k->disposisi }}</td>
                                                                    <td>{{ $k->tanggal }}</td>
                                                                    <td>
                                                                        @if ($k->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $k->status }}
                                                                            </span>
                                                                        @elseif ($k->status == 'Proses Pengecekan')
                                                                            <span class="badge badge-info"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fas fa-spinner"></i>
                                                                                {{ $k->status }}
                                                                            </span>
                                                                        @elseif($k->status == 'Diajukan')
                                                                            <span class="badge badge-warning"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-regular fa-paper-plane"></i>
                                                                                {{ $k->status }}
                                                                            </span>
                                                                        @elseif($k->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $k->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-rounded"
                                                                        data-toggle="modal" data-target="#myModal{{ $k->id }}">
                                                                        Lihat File
                                                                    </a>
                                                            
                                                                    <div class="modal fade" id="myModal{{ $k->id }}" tabindex="-1"
                                                                        role="dialog" aria-labelledby="myModalLabel{{ $k->id }}"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="myModalLabel{{ $k->id }}">Masukkan Password
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
                                                                                        action="/dekripsi/{{ $k->id }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="password">Password</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="pass_id"
                                                                                                name="pass_id" value="{{ $k->pass_id }}" hidden>
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
                                                                        @if ($k->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $k->id }}/terima-smp"
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
                                                                        @elseif ($k->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $k->id }}/pimpinan/konfirm-smp"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <form action="/{{ $k->id }}/hapus"
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
                                                            @foreach ($sek as $s)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $s->nomor_agenda }}</td>
                                                                    <td>{{ $s->nomor_surat }}</td>
                                                                    <td>{{ $s->perihal }}</td>
                                                                    <td>{{ $s->kategori->kategori_surat }}</td>
                                                                    <td>{{ $s->asal_surat }}</td>
                                                                    {{-- <td>{{ $s->disposisi }}</td> --}}
                                                                    <td>{{ $s->tanggal }}</td>
                                                                    <td>
                                                                        @if ($s->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $s->status }}
                                                                            </span>
                                                                        @elseif ($s->status == 'Proses Pengecekan')
                                                                            <span class="badge badge-info"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fas fa-spinner"></i>
                                                                                {{ $s->status }}
                                                                            </span>
                                                                        @elseif($s->status == 'Diajukan')
                                                                            <span class="badge badge-warning"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-regular fa-paper-plane"></i>
                                                                                {{ $s->status }}
                                                                            </span>
                                                                        @elseif($s->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $s->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-rounded"
                                                                        data-toggle="modal" data-target="#myModal{{ $s->id }}">
                                                                        Lihat File
                                                                    </a>
                                                            
                                                                    <div class="modal fade" id="myModal{{ $s->id }}" tabindex="-1"
                                                                        role="dialog" aria-labelledby="myModalLabel{{ $s->id }}"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="myModalLabel{{ $s->id }}">Masukkan Password
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
                                                                                        action="/dekripsi/{{ $s->id }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="password">Password</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="pass_id"
                                                                                                name="pass_id" value="{{ $s->pass_id }}" hidden>
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
                                                                        @if ($s->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $s->id }}/terima-smp"
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
                                                                        @elseif ($s->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $s->id }}/pimpinan/konfirm-smp"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <form action="/{{ $s->id }}/hapus"
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
                                            <br>
                                            @can('ketua')
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    {{ $ket->links('pagination::bootstrap-4') }}
                                                </ul>
                                            </nav>
                                            @elsecan('sekretaris')
                                            <br>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    {{ $sek->links('pagination::bootstrap-4') }}
                                                </ul>
                                            </nav>
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
