@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Arsip Surat Masuk </h2>
    </div>
    <div class="search-field d-xl-block mb-0">
        <form class="d-flex align-items-center h-100" action="{{ route('search-arsip') }}" method="GET">
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
    <div>
        <a href="{{ route('exportExcel-sm') }}" class="btn btn-success">Export Excel</a>
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
                                                            
                                                            <th> Nomor Agenda </th>
                                                            <th> Nomor Surat </th>
                                                            <th> Perihal </th>
                                                            <th> Asal Surat </th>
                                                            <th> Lampiran </th>
                                                            <th> Tanggal Arsip </th>
                                                            <th> Kode Rak </th>
                                                            <th>File</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        @foreach ($arsip as $t)
                                                       
                                                        <td>{{ $t->nomor_agenda }}</td>
                                                        <td>{{ $t->nomor_surat }}</td>
                                                        <td>{{ $t->perihal }}</td>
                                                        <td>{{ $t->asal_surat }}</td>
                                                        <td>{{ $t->lampiran }}</td>
                                                        <td>{{ $t->arsip->tanggal_arsip }}</td>
                                                        <td>{{ $t->arsip->rak->nama_rak }}</td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary btn-rounded"
                                                                data-toggle="modal" data-target="#myModal{{ $t->id }}">
                                                                Lihat File
                                                            </a>

                                                            <div class="modal fade" id="myModal{{ $t->id }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="myModalLabel{{ $t->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="myModalLabel{{ $t->id }}">Masukkan Password
                                                                                Dekripsi</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="decryptForm{{ $t->id }}"
                                                                                action="/dekripsi/{{ $t->id }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <div class="form-group">
                                                                                    <label for="password">Password</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="pass_id"
                                                                                        name="pass_id" value="{{ $t->pass_id }}" hidden>
                                                                                    <input type="password"
                                                                                        class="form-control"
                                                                                        id="password{{ $t->id }}"
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
                                            <br>
                                            <ul class="pagination justify-content-center">
                                                {{ $arsip->links('pagination::bootstrap-4') }}
                                            </ul>
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
