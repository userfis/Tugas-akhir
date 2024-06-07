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
                                                <a href="{{ route('tambah-user') }}"><button type="button"
                                                    class="btn btn-primary btn-fw">Tambah Data</button>
                                                </a>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th> ID </th>
                                                            <th> Nama </th>
                                                            <th> Email </th>
                                                            <th> Username </th>
                                                            <th> Role </th>
                                                            <th> Reset Password </th>
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $data)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $data->nama}}</td>
                                                                <td>{{ $data->email}}</td>
                                                                <td>{{ $data->username}}</td>
                                                                <td>
                                                                @if ($data->is_admin == '0')
                                                                    Admin TU
                                                                @elseif ($data->is_admin == '1')
                                                                    Ketua
                                                                @elseif ($data->is_admin == '2')
                                                                    Sekretaris
                                                                @elseif ($data->is_admin == '3')
                                                                    Staff Data & Informasi
                                                                @elseif ($data->is_admin == '4')
                                                                    Staff Hukum
                                                                @elseif ($data->is_admin == '5')
                                                                    Staff Keuangan
                                                                @elseif ($data->is_admin == '6')
                                                                    Staff Teknis
                                                                @endif
                                                                </td>
                                                                <td>
                                                                                <button type="submit"
                                                                                    class="btn btn-info"
                                                                                    fdprocessedid="91w77s">
                                                                                    Reset Password
                                                                                </button>
                                                                </td>

                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="mr-1">
                                                                            <a href="/{{ $data->id }}/edit-user"
                                                                                class="btn btn-primary btn-rounded">
                                                                                <i class="mdi mdi-tooltip-edit"
                                                                                    style="font-size: 15px;"></i>
                                                                            </a>
                                                                        </div>
                                                                        {{-- @foreach ($rak as $item)                                                                                                                                                   --}}

                                                                        {{-- @endforeach --}}

                                                                        <div>
                                                                            <form action=""
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
