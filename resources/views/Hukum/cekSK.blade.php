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
                                                                <th> Tgl Surat Keluar </th>
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
                                                                        @if ($k->status == 'Berkas Siap Dikirim')
                                                                            <span class="badge badge-success"
                                                                                style="font-size: 0.8rem;">
                                                                                <i class="mdi mdi-check"></i>
                                                                                {{ $sek->status }}
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
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="/storage/{{ $k->file }}"
                                                                            class="btn btn-primary btn-rounded" target="blank">
                                                                            Lihat File
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            {{-- <div class="mr-1">
                                                                                <a href="/{{ $k->id }}/detail-surat"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-eye"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div> --}}
                                                                            <div class="mr-1">
                                                                                <a href="/{{ $k->id }}/confirm-sk"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-tooltip-edit"
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
                                                                <th> Disposisi </th>
                                                                <th> Tgl Surat Keluar </th>
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
                                                                    <td>{{ $s->disposisi }}</td>
                                                                    <td>{{ $s->tanggal }}</td>
                                                                    <td>
                                                                        @if ($s->status == 'Berkas Siap Dikirim')
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
                                                                    @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="/storage/{{ $s->file }}"
                                                                            class="btn btn-primary btn-rounded" target="blank">
                                                                            Lihat File
                                                                        </a>
                                                                    </td>

                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <div class="mr-1">
                                                                                <a href="/{{ $s->id }}/confirm-sk"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-eye"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div>
                                                                            {{-- <div class="mr-1">
                                                                                <a href="/{{ $s->id }}/edit-data"
                                                                                    class="btn btn-primary btn-rounded">
                                                                                    <i class="mdi mdi-tooltip-edit"
                                                                                        style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </div> --}}
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
