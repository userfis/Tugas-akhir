@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Arsip Surat Keluar </h2>
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
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th> ID </th>
                                                            <th> Nomor Agenda </th>
                                                            <th> Nomor Surat </th>
                                                            <th> Perihal </th>
                                                            <th> Asal Surat </th>
                                                            <th> Lampiran </th>
                                                            <th> Tanggal Arsip </th>
                                                            <th> Kode Rak </th>
                                                            <th>pass_id</th>
                                                            <th>File</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($arsip as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->nomor_agenda }}</td>
                                                                <td>{{ $item->nomor_surat }}</td>
                                                                <td>{{ $item->perihal }}</td>
                                                                <td>{{ $item->asal_surat }}</td>
                                                                <td>{{ $item->lampiran }}</td>
                                                                <td>{{ $item->tanggal_arsip }}</td>
                                                                <td>{{ $item->nama_rak }}</td>
                                                                <td>{{ $item->pass_id }}</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-primary btn-rounded"
                                                                        data-toggle="modal" data-target="#myModal{{ $item->data_id }}">
                                                                        Lihat File
                                                                    </a>

                                                                    <div class="modal fade" id="myModal{{ $item->data_id }}" tabindex="-1"
                                                                        role="dialog" aria-labelledby="myModalLabel{{ $item->data_id }}"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="myModalLabel{{ $item->data_id }}">Masukkan Password
                                                                                        Dekripsi</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="decryptForm{{ $item->data_id }}"
                                                                                        action="/dekripsi/{{ $item->data_id }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <div class="form-group">
                                                                                            <label for="password">Password</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="pass_id"
                                                                                                name="pass_id" value="{{ $item->pass_id }}" hidden>
                                                                                            <input type="password"
                                                                                                class="form-control"
                                                                                                id="password{{ $item->data_id }}"
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
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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
