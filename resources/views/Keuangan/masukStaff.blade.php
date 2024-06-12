@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-3"> Data Surat Masuk </h2>
    </div>
    <div class="search-field d-xl-block mb-0">
        <form class="d-flex align-items-center h-100" action="{{ route('masuk-search-staff') }}" method="GET">
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
                                                @can('staffKeu')
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th> ID </th>
                                                                <th> Nomor Agenda </th>
                                                                <th> Nomor Surat </th>
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
                                                            @foreach ($keu as $k)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $k->nomor_agenda }}</td>
                                                                    <td>{{ $k->nomor_surat }}</td>
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
                                                                            data-toggle="modal"
                                                                            data-target="#myModal{{ $k->id }}">
                                                                            Lihat File
                                                                        </a>

                                                                        <div class="modal fade" id="myModal{{ $k->id }}"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-labelledby="myModalLabel{{ $k->id }}"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myModalLabel{{ $k->id }}">
                                                                                            Masukkan Password
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
                                                                                                    name="pass_id"
                                                                                                    value="{{ $k->pass_id }}"
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
                                                                        @if ($k->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $k->id }}/terima-sm"
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
                                                                                    <a href="/{{ $k->id }}/staff/konfirm-sm"
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
                                                @elsecan('staffHuk')
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th> ID </th>
                                                                <th> Nomor Agenda </th>
                                                                <th> Nomor Surat </th>
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
                                                            @foreach ($huk as $h)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $h->nomor_agenda }}</td>
                                                                    <td>{{ $h->nomor_surat }}</td>
                                                                    <td>{{ $h->kategori->kategori_surat }}</td>
                                                                    <td>{{ $h->asal_surat }}</td>
                                                                    <td>{{ $h->disposisi }}</td>
                                                                    <td>{{ $h->tanggal }}</td>
                                                                    <td>
                                                                        @if ($h->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $h->status }}
                                                                            </span>
                                                                        @elseif($h->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $h->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-rounded"
                                                                            data-toggle="modal"
                                                                            data-target="#myModal{{ $h->id }}">
                                                                            Lihat File
                                                                        </a>

                                                                        <div class="modal fade" id="myModal{{ $h->id }}"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-labelledby="myModalLabel{{ $h->id }}"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myModalLabel{{ $h->id }}">
                                                                                            Masukkan Password
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
                                                                                            action="/dekripsi/{{ $h->id }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="password">Password</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="pass_id"
                                                                                                    name="pass_id"
                                                                                                    value="{{ $h->pass_id }}"
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
                                                                        @if ($h->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $h->id }}/terima-sm"
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
                                                                        @elseif ($h->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $h->id }}/staff/konfirm-sm"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <form action="/{{ $h->id }}/hapus"
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
                                                @elsecan('staffDat')
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th> ID </th>
                                                                <th> Nomor Agenda </th>
                                                                <th> Nomor Surat </th>
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
                                                            @foreach ($data as $item)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $item->nomor_agenda }}</td>
                                                                    <td>{{ $item->nomor_surat }}</td>
                                                                    <td>{{ $item->kategori->kategori_surat }}</td>
                                                                    <td>{{ $item->asal_surat }}</td>
                                                                    <td>{{ $item->disposisi }}</td>
                                                                    <td>{{ $item->tanggal }}</td>
                                                                    <td>
                                                                        @if ($item->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $item->status }}
                                                                            </span>
                                                                        @elseif($item->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $item->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-rounded"
                                                                            data-toggle="modal"
                                                                            data-target="#myModal{{ $item->id }}">
                                                                            Lihat File
                                                                        </a>

                                                                        <div class="modal fade"
                                                                            id="myModal{{ $item->id }}" tabindex="-1"
                                                                            role="dialog"
                                                                            aria-labelledby="myModalLabel{{ $item->id }}"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myModalLabel{{ $item->id }}">
                                                                                            Masukkan Password
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
                                                                                            action="/dekripsi/{{ $item->id }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="password">Password</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="pass_id"
                                                                                                    name="pass_id"
                                                                                                    value="{{ $item->pass_id }}"
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
                                                                        @if ($item->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $item->id }}/terima-sm"
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
                                                                        @elseif ($item->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $item->id }}/staff/konfirm-sm"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <form action="/{{ $item->id }}/hapus"
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
                                                @elsecan('staffTek')
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th> ID </th>
                                                                <th> Nomor Agenda </th>
                                                                <th> Nomor Surat </th>
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
                                                            @foreach ($tek as $t)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $t->nomor_agenda }}</td>
                                                                    <td>{{ $t->nomor_surat }}</td>
                                                                    <td>{{ $t->kategori->kategori_surat }}</td>
                                                                    <td>{{ $t->asal_surat }}</td>
                                                                    <td>{{ $t->disposisi }}</td>
                                                                    <td>{{ $t->tanggal }}</td>
                                                                    <td>
                                                                        @if ($t->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $t->status }}
                                                                            </span>
                                                                        @elseif($t->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $t->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-rounded"
                                                                            data-toggle="modal"
                                                                            data-target="#myModal{{ $t->id }}">
                                                                            Lihat File
                                                                        </a>

                                                                        <div class="modal fade"
                                                                            id="myModal{{ $t->id }}" tabindex="-1"
                                                                            role="dialog"
                                                                            aria-labelledby="myModalLabel{{ $t->id }}"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="myModalLabel{{ $t->id }}">
                                                                                            Masukkan Password
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
                                                                                            action="/dekripsi/{{ $t->id }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="password">Password</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="pass_id"
                                                                                                    name="pass_id"
                                                                                                    value="{{ $t->pass_id }}"
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
                                                                        @if ($t->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $t->id }}/terima-sm"
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
                                                                        @elseif ($t->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $t->id }}/staff/konfirm-sm"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <form action="/{{ $t->id }}/hapus"
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
                                            @can('staffKeu')
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    {{ $keu->links('pagination::bootstrap-4') }}
                                                </ul>
                                            </nav>
                                            @elsecan('staffHuk')
                                            <br>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    {{ $huk->links('pagination::bootstrap-4') }}
                                                </ul>
                                            </nav>
                                            @elsecan('staffDat')
                                            <br>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    {{ $data->links('pagination::bootstrap-4') }}
                                                </ul>
                                            </nav>
                                            @elsecan('staffTek')
                                            <br>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    {{ $tek->links('pagination::bootstrap-4') }}
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
