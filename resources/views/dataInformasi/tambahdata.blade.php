@extends('homepage.index')
@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data</h4>
                <form class="forms-sample" action="{{ route('tambah_data') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder=""
                            fdprocessedid="a8ntcq">
                    </div>
                    <div class="form-group">
                        <label for="nomor_agenda">Nomor Agenda</label>
                        <input type="text" name="nomor_agenda" class="form-control" id="nomor_agenda" placeholder=""
                            fdprocessedid="a8ntcq">
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" id="nomor_surat" placeholder=""
                            fdprocessedid="ynbjs">
                    </div>
                    <div class="form-group">
                        <label for="asal_surat">Asal Surat</label>
                        <input type="text" name="asal_surat" class="form-control" id="asal_surat" placeholder=""
                            fdprocessedid="zukfe7">
                    </div>
                    <div class="form-group">
                        <label for="perihal">perihal</label>
                        <input type="text" name="perihal" class="form-control" id="perihal" placeholder=""
                            fdprocessedid="zukfe7">
                    </div>
                    <div class="form-group">
                        <label for="lampiran">Lampiran</label>
                        <input type="text" name="lampiran" class="form-control" id="lampiran" placeholder=""
                            fdprocessedid="zukfe7">
                    </div>
                    <div class="form-group">
                        <label for="tindakan">Tindakan</label>
                        <input type="text" name="tindakan" class="form-control" id="tindakan" placeholder=""
                            fdprocessedid="zukfe7">
                    </div>
                    <div class="form-group">
                        <label for="kategori_id">Kategori Surat</label>
                        <select class="form-control" name="kategori_id" id="kategori_id" fdprocessedid="677jv">
                            <option>pilih</option>
                            @foreach ($kategori as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->kategori_surat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">Upload PDF</label>
                        <input type="file" class="form-control file-upload-info" name="file" id="file"
                           placeholder="Upload PDF" fdprocessedid="w1iqnm">
                    </div>
                    <br>
                    <input type="text" name="data_id" id="data_id" value="1" hidden>
                    <input type="text" name="status" id="status" value="Proses Pengecekan" hidden>
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    <a href="{{ route('masuk') }}" class="btn btn-light" fdprocessedid="p0f3cn">Cancel</a>
                </form>
                    {{-- <button class="btn btn-light" fdprocessedid="p0f3cn">Cancel</button> --}}
            </div>
        </div>
    </div>
@endsection
