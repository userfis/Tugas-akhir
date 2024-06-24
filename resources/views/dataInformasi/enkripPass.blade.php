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
                                                <style>
                                                    .modal-body,
                                                    .modal-title {
                                                        color: black;
                                                    }
                                                </style>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th> ID </th>
                                                            <th> Jenis Surat </th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pass as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->jenis_surat }}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="mr-1">
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-rounded"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#modal-form"
                                                                                data-id="{{ $item->id }}"
                                                                                data-jenis_surat="{{ $item->jenis_surat }}"
                                                                                data-password="{{ $item->password }}">
                                                                                
                                                                                <i class="mdi mdi-tooltip-edit" style="font-size: 15px"></i>
                                                                            </button>
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
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="editrakLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editrakLabel">Edit Password</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pass.update', ['id' => '__id__']) }}" method="POST" enctype="multipart/form-data"
                    id="edit-form">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="jenis_surat">Jenis Surat</label>
                            <input type="text" class="form-control" id="jenis_surat" name="jenis_surat" readonly>
                        </div>
                        <div class="form-group">
                            <label for="old_password">Password Lama</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                            {{-- @error('old_password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            {{-- @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required>
                            {{-- @error('confirm_password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                var jenisSurat = $(this).data('jenis_surat');
        
                $('#modal-form #id').val(id);
                $('#modal-form #jenis_surat').val(jenisSurat);
                
                // Reset fields
                $('#modal-form #old_password').val('');
                $('#modal-form #password').val('');
                $('#modal-form #confirm_password').val('');
        
                // Update form action to include the correct route
                $('#edit-form').attr('action', '/pass/update/' + id);
            });
        });
        </script>
@endsection
