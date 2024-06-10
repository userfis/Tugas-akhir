@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Data Masuk {{ $Halaman }} </h2>
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
                                                        @foreach ($arsip as $arsip)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $arsip->nomor_agenda }}</td>
                                                                    <td>{{ $arsip->nomor_surat }}</td>
                                                                    <td>{{ $arsip->perihal }}</td>
                                                                    <td>{{ $arsip->asal_surat }}</td>
                                                                    <td>{{ $arsip->lampiran }}</td>
                                                                    <td>{{ $arsip->tanggal_arsip }}</td>
                                                                    <td>{{ $arsip->nama_rak }}</td>
                                                                    <td>{{ $arsip->pass_id }}</td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-rounded"
                                                                            data-toggle="modal" data-target="#myModal">
                                                                            Lihat File
                                                                        </a>

                                                                        
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
                                                                                            action="/dekripsi/{{ $arsip->id }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="password">Password</label>
                                                                                                    <input type="text"
                                                                                                    class="form-control"
                                                                                                    id="pass_id"
                                                                                                    name="pass_id" value="{{ $arsip->pass_id }}" hidden>
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

                                                                {{-- @else --}}
                                                                {{-- @endif --}}
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
