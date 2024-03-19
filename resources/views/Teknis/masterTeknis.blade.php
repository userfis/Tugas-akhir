@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Master Data {{ $Halaman }} </h2>
    </div>
    <div class="search-field d-none d-xl-block">
        <form class="d-flex align-items-center h-100" action="#">
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-white border-0" placeholder="Search products">
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
                                            @can('superadmin')
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> Nomor Surat </th>
                                                        <th> Nama Data </th>
                                                        <th> status </th>
                                                        <th> Waktu </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->nomor_surat }}</td>
                                                            <td>{{ $item->judul }}</td>
                                                            <td>{{ $item->status }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mr-1">
                                                                        <a href="/storage/{{ $item->file }}"
                                                                            class="btn btn-primary btn-rounded"
                                                                            target="blank">
                                                                            <i class="mdi mdi-eye"
                                                                                style="font-size: 15px;"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="mr-1">
                                                                        <a href="/{{ $item->id }}/edit-data"
                                                                            class="btn btn-primary btn-rounded">
                                                                            <i class="mdi mdi-tooltip-edit"
                                                                                style="font-size: 15px;"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class='mr-1'>
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
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Nomor Surat </th>
                                                    <th> Nama Data </th>
                                                    <th> status </th>
                                                    <th> Waktu </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->nomor_surat }}</td>
                                                        <td>{{ $item->judul }}</td>
                                                        <td>{{ $item->status }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                @if ($item->status == 'kirim data')
                                                                    <div class="mr-1">
                                                                        <a href="/storage/{{ $item->file }}"
                                                                            class="btn btn-secondary btn-rounded"
                                                                            target="blank">
                                                                            <i class="mdi mdi-eye"
                                                                                style="font-size: 15px;"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="mr-1">
                                                                        <a href="#"
                                                                            class="btn btn-primary btn-rounded">
                                                                            <i class="mdi mdi-send"
                                                                                style="font-size: 15px;"></i>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div class="mr-1">
                                                                        <a href="/storage/{{ $item->file }}"
                                                                            class="btn btn-secondary btn-rounded"
                                                                            target="blank">
                                                                            <i class="mdi mdi-eye"
                                                                                style="font-size: 15px;"></i>
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
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
@endsection
