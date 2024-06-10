@extends('homepage.index')

@section('page-header')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-2">{{ $halaman }} </h2>
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
                                                <button type="button" class="btn btn-primary btn-fw" data-toggle="modal"
                                                    data-target="#tambahrak">
                                                    Tambah Kategori
                                                </button>
                                                <style>
                                                    /* Mengatur warna teks di dalam modal menjadi hitam */
                                                    .modal-body,
                                                    .modal-title {
                                                        color: black;
                                                    }
                                                </style>
                                                <div class="modal fade" id="tambahrak" tabindex="-1" role="dialog"
                                                    aria-labelledby="tambahrakLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="tambahrakLabel">Tambah Jenis Rak
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('tambah-rak') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="pemilik_rak">Pemilik Rak</label>
                                                                        <div class="input-group">
                                                                            <select class="custom-select" id="pemilik_rak"
                                                                                name="pemilik_rak">
                                                                                <option selected disabled>Pilih Pemilik Rak
                                                                                </option>
                                                                                <option value="Ketua KPU">Ketua KPU</option>
                                                                                <option value="Sekretaris">Sekretaris
                                                                                </option>
                                                                                <option value="Staff Data & Informasi">Staff
                                                                                    Data & Informasi</option>
                                                                                <option value="Staff Keuangan">Staff
                                                                                    Keuangan</option>
                                                                                <option value="Staff Hukum">Staff Hukum
                                                                                </option>
                                                                                <option value="Staff Teknis">Staff Teknis
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kategoriNama">Kode Rak</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nama_rak" name="nama_rak" required>
                                                                    </div>
                                                                    <!-- Tambahkan input lain sesuai kebutuhan -->
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th> ID </th>
                                                            <th> Pemilik Rak </th>
                                                            <th> Kode Rak </th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($rak as $rak)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $rak->pemilik_rak }}</td>
                                                                <td>{{ $rak->nama_rak }}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="mr-1">
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-rounded"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#modal-form"
                                                                                data-id="{{ $rak->id }}"
                                                                                data-nama_rak="{{ $rak->nama_rak }}"
                                                                                data-pemilik_rak="{{ $rak->pemilik_rak }}">
                                                                                <i class="mdi mdi-tooltip-edit" style="font-size: 15px"></i>
                                                                            </button>
                                                                        </div>
                                                                        {{-- @foreach ($rak as $item)                                                                                                                                                   --}}

                                                                        {{-- @endforeach --}}


                                                                        {{-- <div>
                                                                            <form action="/{{ $rak->id }}/hapus/rak"
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
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="editrakLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editrakLabel">Edit Jenis Rak</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Update form action to include route with ID -->
                <form action="" method="POST" enctype="multipart/form-data" id="edit-form">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="rak-id" name="id">
                        <div class="form-group">
                            <label for="pemilik_rak">Pemilik Rak</label>
                            <div class="input-group">
                                <select class="custom-select" id="pemilik_rak" name="pemilik_rak">
                                    <option selected disabled>Pilih Pemilik Rak</option>
                                    <option value="Ketua KPU">Ketua KPU</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Staff Data & Informasi">Staff Data & Informasi</option>
                                    <option value="Staff Keuangan">Staff Keuangan</option>
                                    <option value="Staff Hukum">Staff Hukum</option>
                                    <option value="Staff Teknis">Staff Teknis</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_rak">Kode Rak</label>
                            <input type="text" class="form-control" id="nama_rak" name="nama_rak" required>
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
        $('button[data-bs-toggle="modal"]').click(function() {
            var id = $(this).data('id');
            var namaRak = $(this).data('nama_rak');
            var pemilikRak = $(this).data('pemilik_rak');

            $('#modal-form #rak-id').val(id);
            $('#modal-form #nama_rak').val(namaRak);
            $('#modal-form #pemilik_rak').val(pemilikRak);

            // Update form action to include the correct route
            $('#edit-form').attr('action', '/rak/update/' + id);
        });
    });
</script>
@endsection
