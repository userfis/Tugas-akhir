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
                                                @can('superadmin')
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th> ID </th>
                                                                <th> Nomor Surat </th>
                                                                <th> Nama Data </th>
                                                                <th> konfirmasi </th>
                                                                <th> Pesan </th>
                                                                <th> Waktu </th>
                                                                <th> Action </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                @foreach ($data as $data)
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $data->nomor_surat }}</td>
                                                                    <td>{{ $data->judul }}</td>
                                                                    <td>{{ $data->status }}</td>
                                                                    <td>{{ $data->pesan }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}
                                                                    </td>

                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="mr-1">
                                                                                <a href="/storage/{{ $data->file }}"
                                                                                    class="btn btn-secondary btn-rounded"
                                                                                    target="blank">
                                                                                    <i class="mdi mdi-eye"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div class="mr-1">
                                                                                <a href="/{{ $data->id }}/edit-data"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-tooltip-edit"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <a href="{{ route('tambah') }}"><button type="button"
                                                            class="btn btn-primary btn-fw">Tambah Data</button>
                                                    </a>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th> ID </th>
                                                                <th> Nomor Agenda </th>
                                                                <th> Nomor Surat </th>
                                                                <th> Kategori Surat </th>
                                                                <th> Pengirim </th>
                                                                <th> Lampiran </th>
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
                                                                    <td>{{ $data->lampiran }}</td>
                                                                    <td>{{ $data->tanggal }}</td>
                                                                    <td>{{ $data->status }}</td>
                                                                    <td>
                                                                        <a href="/storage/{{ $data->file }}"
                                                                            class="btn btn-primary btn-rounded" target="blank">
                                                                            Lihat File
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="mr-1">
                                                                                <a href="/{{ $data->id }}/detail-surat"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-eye"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div class="mr-1">
                                                                                <a href="/{{ $data->id }}/edit-data"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-tooltip-edit"
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
