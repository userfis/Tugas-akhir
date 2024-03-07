@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2"> Master Data </h2>
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
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> Nomor Surat </th>
                                                        <th> Nama Data </th>
                                                        <th> Pesan </th>
                                                        <th> Waktu </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>20002-1999</td>
                                                        <td>Lorem ipsum dolor sit amet.</td>
                                                        <td>proses</td>
                                                        <td>5 menit</td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-info btn-rounded btn-icon">
                                                                <i class="mdi mdi-eye" style="font-size: 15px;"></i>
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-primary btn-rounded btn-icon">
                                                                <i class="mdi mdi-send" style="font-size: 15px;"></i>
                                                            </button>
                                                            {{-- <button type="button" class="btn btn-danger btn-rounded btn-icon" fdprocessedid="91w77s">
                                                            <i class="mdi mdi-delete" style="font-size: 15px;"></i>
                                                          </button> --}}
                                                        </td>
                                                    </tr>
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
@endsection
