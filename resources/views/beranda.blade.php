@extends('homepage.index')
@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2">Dashboard</h2>
    </div>
    <div class="search-field d-none d-xl-block">
        {{-- <form class="d-flex align-items-center h-100" action="{{ route('master') }}" method="GET">
            <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                    <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-white border-0" name="search" placeholder="Search ..."  value="{{ request('search') }}">
            </div>
        </form> --}}
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content tab-transparent-content">
                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="row">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card">
                                      @if (count($data)>0)
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
                                                                                    class="btn btn-secondary btn-rounded"
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
                                                                                <a href="/{{ $item->id }}/kirim-data"
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
                                                <tr>
                                                    <td colspan="6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align: center;"><h4>Data Kosong</h4></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                            @endif
                                        {{-- <div class="card-body">
                                            <h4 class="card-title">Basic Table</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Profile</th>
                                                        <th>VatNo.</th>
                                                        <th>Created</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Jacob</td>
                                                        <td>53275531</td>
                                                        <td>12 May 2017</td>
                                                        <td><label class="badge badge-danger">Pending</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Messsy</td>
                                                        <td>53275532</td>
                                                        <td>15 May 2017</td>
                                                        <td><label class="badge badge-warning">In progress</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>John</td>
                                                        <td>53275533</td>
                                                        <td>14 May 2017</td>
                                                        <td><label class="badge badge-info">Fixed</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Peter</td>
                                                        <td>53275534</td>
                                                        <td>16 May 2017</td>
                                                        <td><label class="badge badge-success">Completed</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dave</td>
                                                        <td>53275535</td>
                                                        <td>20 May 2017</td>
                                                        <td><label class="badge badge-warning">In progress</label></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> --}}
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
