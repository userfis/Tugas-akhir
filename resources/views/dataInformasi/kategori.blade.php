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
                                                <button type="button" class="btn btn-primary btn-fw" data-toggle="modal" data-target="#tambahKategoriModal">
                                                    Tambah Kategori
                                                </button>
                                                <style>
                                                    /* Mengatur warna teks di dalam modal menjadi hitam */
                                                    .modal-body, .modal-title {
                                                        color: black;
                                                    }
                                                </style>
                                               <div class="modal fade" id="tambahKategoriModal" tabindex="-1" role="dialog" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('tambah-kategori') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="kategoriNama">Nama Kategori</label>
                                                                    <input type="text" class="form-control" id="kategori_surat" name="kategori_surat" required>
                                                                </div>
                                                                <!-- Tambahkan input lain sesuai kebutuhan -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th> ID </th>
                                                            <th> Nama Kategori </th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($kategori as $kat)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $kat->kategori_surat}}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="mr-1">
                                                                            <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#modal-form" data-id="{{ $kat->id }}" data-kategori_surat="{{ $kat->kategori_surat }}">
                                                                                <i class="mdi mdi-tooltip-edit"
                                                                                style="font-size: 15px;"></i>
                                                                            </button>
                                                                        </div>
                                                                        {{-- <div>
                                                                            <form action="/{{ $kat->id }}/hapus/kategori"
                                                                                method="POST">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="btn btn-danger btn-rounded btn-icon"
                                                                                    fdprocessedid="91w77s">
                                                                                    <i class="mdi mdi-delete"
                                                                                        style="font-size: 15px;"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div> --}}
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
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="editKategoriLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriLabel">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" id="edit-form">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="kat-id" name="id">
                        <div class="form-group">
                            <label for="kategori_surat">Kategori Surat</label>
                            <input type="text" class="form-control" id="kategori_surat" name="kategori_surat" required>
                        </div>
                        <!-- Tambahkan input lain sesuai kebutuhan -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('button[data-toggle="modal"]').click(function() {
                var id = $(this).data('id');
                var kategoriSurat = $(this).data('kategori_surat');

                $('#modal-form #kat-id').val(id);
                $('#modal-form #kategori_surat').val(kategoriSurat);

                // Update form action to include the correct route
                $('#edit-form').attr('action', '/update/kategori/' + id);
            });
        });
    </script>
@endsection
