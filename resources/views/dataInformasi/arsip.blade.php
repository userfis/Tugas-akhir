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
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($arsip as $arsip)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                {{-- @if ($arsip->data) --}}
                                                                    <td>{{ $arsip->nomor_agenda }}</td>
                                                                    <td>{{ $arsip->nomor_surat }}</td>
                                                                    <td>{{ $arsip->perihal }}</td>
                                                                    {{-- <td>{{ $arsip->kategori_surat }}</td> --}}
                                                                    <td>{{ $arsip->asal_surat }}</td>
                                                                    <td>{{ $arsip->lampiran }}</td>
                                                                    <td>{{ $arsip->tanggal_arsip }}</td>
                                                                    <td>{{ $arsip->nama_rak }}</td>
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
