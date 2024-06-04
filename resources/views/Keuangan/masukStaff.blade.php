@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Data Masuk {{ auth()->user()->nama }} </h2>
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
                                                            @foreach ($keu as $keu)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $keu->nomor_agenda }}</td>
                                                                    <td>{{ $keu->nomor_surat }}</td>
                                                                    <td>{{ $keu->kategori->kategori_surat }}</td>
                                                                    <td>{{ $keu->asal_surat }}</td>
                                                                    <td>{{ $keu->disposisi }}</td>
                                                                    <td>{{ $keu->tanggal }}</td>
                                                                    <td>
                                                                        @if ($keu->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $keu->status }}
                                                                            </span>
                                                                        @elseif($keu->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $keu->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="/storage/{{ $keu->file }}"
                                                                            class="btn btn-primary btn-rounded" target="blank">
                                                                            Lihat File
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                    <td>
                                                                        @if ($keu->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $keu->id }}/terima-sm"
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
                                                                        @elseif ($keu->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $keu->id }}/staff/konfirm-sm"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <form action="/{{ $keu->id }}/hapus"
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
                                                            @foreach ($huk as $huk)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $huk->nomor_agenda }}</td>
                                                                    <td>{{ $huk->nomor_surat }}</td>
                                                                    <td>{{ $huk->kategori->kategori_surat }}</td>
                                                                    <td>{{ $huk->asal_surat }}</td>
                                                                    <td>{{ $huk->disposisi }}</td>
                                                                    <td>{{ $huk->tanggal }}</td>
                                                                    <td>
                                                                        @if ($huk->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $huk->status }}
                                                                            </span>
                                                                        @elseif($huk->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $huk->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-rounded"
                                                                            data-toggle="modal" data-target="#myModal">
                                                                            Lihat File
                                                                        </a>

                                                                        <!-- Modal -->
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
                                                                                            action="/dekripsi/{{ $huk->id }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="password">Password</label>
                                                                                                    <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="pass_id"
                                                                                                    name="pass_id" value="{{ $huk->pass_id }}" hidden>
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
                                                                        @if ($huk->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $huk->id }}/terima-sm"
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
                                                                        @elseif ($huk->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $huk->id }}/staff/konfirm-sm"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <form action="/{{ $huk->id }}/hapus"
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
                                                            @foreach ($data as $data)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $data->nomor_agenda }}</td>
                                                                    <td>{{ $data->nomor_surat }}</td>
                                                                    <td>{{ $data->kategori->kategori_surat }}</td>
                                                                    <td>{{ $data->asal_surat }}</td>
                                                                    <td>{{ $data->disposisi }}</td>
                                                                    <td>{{ $data->tanggal }}</td>
                                                                    <td>
                                                                        @if ($data->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $data->status }}
                                                                            </span>
                                                                        @elseif($data->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $data->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="/storage/{{ $data->file }}"
                                                                            class="btn btn-primary btn-rounded" target="blank">
                                                                            Lihat File
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        @if ($data->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $data->id }}/terima-sm"
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
                                                                        @elseif ($data->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $data->id }}/staff/konfirm-sm"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <form action="/{{ $data->id }}/hapus"
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
                                                            @foreach ($tek as $tek)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $tek->nomor_agenda }}</td>
                                                                    <td>{{ $tek->nomor_surat }}</td>
                                                                    <td>{{ $tek->kategori->kategori_surat }}</td>
                                                                    <td>{{ $tek->asal_surat }}</td>
                                                                    <td>{{ $tek->disposisi }}</td>
                                                                    <td>{{ $tek->tanggal }}</td>
                                                                    <td>
                                                                        @if ($tek->status == 'Selesai Disposisi')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $tek->status }}
                                                                            </span>
                                                                        @elseif($tek->status == 'Disposisi')
                                                                            <span class="badge badge-danger"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="fa-solid fa-share"></i></i>
                                                                                {{ $tek->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="/storage/{{ $tek->file }}"
                                                                            class="btn btn-primary btn-rounded"
                                                                            target="blank">
                                                                            Lihat File
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        @if ($tek->status == 'Disposisi')
                                                                            <form id="submitForm"
                                                                                action="/{{ $tek->id }}/terima-sm"
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
                                                                        @elseif ($tek->status == 'Selesai Disposisi')
                                                                            <div class="d-flex">
                                                                                <div class="mr-1">
                                                                                    <a href="/{{ $tek->id }}/staff/konfirm-sm"
                                                                                        class="btn btn-primary btn-rounded">
                                                                                        <i class="mdi mdi-eye"
                                                                                            style="font-size: 15px;"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <form action="/{{ $tek->id }}/hapus"
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
