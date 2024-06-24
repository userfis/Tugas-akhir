@extends('homepage.index')
@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kirim surat keluar</h4>
                {{-- <div class="form-group">
                    <label for="nomor_surat">Nomor Surat</label>
                    <input type="text" name="nomor_surat" class="form-control" id="nomor_surat" placeholder=""
                        fdprocessedid="ynbjs" value="{{ $data->nomor_surat }}" readonly>
                </div>
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" id="judul" placeholder=""
                        fdprocessedid="a8ntcq" value="{{ $data->judul }}" readonly>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="text" name="tahun" class="form-control" id="tahun" placeholder=""
                        fdprocessedid="zukfe7" value="{{ $data->tahun }}" readonly>
                </div>
                <div class="form-group">
                    <label for="file">File PDF</label>
                    <label for="file">file yang sudah diunggah :<a href="/storage/{{ $data->file }}" target="_blank">
                            {{ $data->judul }}.pdf</label></a>
                </div> --}}
                <form action="/{{ $data->id }}/send-kirim-email" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email tujuan</label>
                        {{-- <input type="text" name="status" id="status" value="data sudah dikirim" hidden> --}}
                        <input type="text" name="surat_id" id="surat_id" value="{{ $data->id }}" hidden>
                        <input type="text" name="email" class="form-control" id="email" placeholder=""
                            fdprocessedid="zukfe7">
                    </div>
                    <div class="form-group">
                        <label for="email">Deskripsi</label>
                        <textarea type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="" fdprocessedid="zukfe7"
                            style="height: 100px;"></textarea>
                    </div>
                    <div class="form-group">
                    <label for="email">Password Dekripsi Surat Keluar</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder=""
                    fdprocessedid="zukfe7">
                </div>
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    <button class="btn btn-light" fdprocessedid="p0f3cn">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel" text ="">Masukkan Password Dekripsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/{{ $data->id }}/send-kirim-email" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <script>
        function togglePesanInput() {
            var statusSelect = document.getElementById('status');
            var pesanForm = document.getElementById('pesan');

            if (statusSelect.value === 'ditolak') {
                pesanForm.style.display = 'block';
            } else {
                pesanForm.style.display = 'none';
            }
        }
    </script> --}}
@endsection
