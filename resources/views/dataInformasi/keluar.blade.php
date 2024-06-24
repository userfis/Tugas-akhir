@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Data Surat Keluar </h2>
    </div>
    <div class="search-field d-xl-block mb-0">
        <form class="d-flex align-items-center h-100" action="{{ route('keluar-search') }}" method="GET">
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
                                                <a href="{{ route('tambah-SK') }}"><button type="button"
                                                        class="btn btn-primary btn-fw">Tambah Data</button>
                                                </a>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
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
                                                        @foreach ($data as $item)
                                                            <tr>
                                                                <td>{{ $item->nomor_agenda }}</td>
                                                                <td>{{ $item->nomor_surat }}</td>
                                                                <td>{{ $item->perihal }}</td>
                                                                <td>{{ $item->kategori->kategori_surat }}</td>
                                                                <td>{{ $item->asal_surat }}</td>
                                                                <td>{{ $item->lampiran }}</td>
                                                                <td>{{ $item->tanggal }}</td>
                                                                <td>
                                                                    @if ($item->status == 'Berkas Siap Dikirim')
                                                                        <a href="/{{ $item->id }}/kirim-email" class="badge badge-success" 
                                                                            style="font-size: 0.8rem;">
                                                                            <i class="mdi mdi-check"></i>
                                                                            {{ $item->status }}
                                                                        </a>
                                                                    @elseif ($item->status == 'Proses Pengecekan')
                                                                        <span class="badge badge-info"
                                                                            style="font-size: 0.8rem;">
                                                                            <i class="fas fa-spinner"></i>
                                                                            {{ $item->status }}
                                                                        </span>
                                                                    @elseif($item->status == 'Diajukan')
                                                                        <span class="badge badge-warning"
                                                                            style="font-size: 0.8rem;">
                                                                            <i class="fa-regular fa-paper-plane"></i>
                                                                            {{ $item->status }}
                                                                        </span>
                                                                    @elseif($item->status == 'Perbaiki')
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
                                                                    <div class="d-flex">
                                                                        <div class="mr-1">
                                                                            <a href="/{{ $item->id }}/detail-surat-keluar"
                                                                                class="btn btn-primary btn-rounded">
                                                                                <i class="mdi mdi-eye"
                                                                                    style="font-size: 15px;"></i>
                                                                            </a>
                                                                        </div>
                                                                        <div class="mr-1">
                                                                            <a href="/{{ $item->id }}/edit-data-sk"
                                                                                class="btn btn-primary btn-rounded">
                                                                                <i class="mdi mdi-tooltip-edit"
                                                                                    style="font-size: 15px;"></i>
                                                                            </a>
                                                                        </div>
                                                                        @if ($item->status != 'Diajukan' && $item->status != 'Berkas Siap Dikirim')
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
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    {{ $data->links('pagination::bootstrap-4') }}
                                                </ul>
                                            </nav>
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
