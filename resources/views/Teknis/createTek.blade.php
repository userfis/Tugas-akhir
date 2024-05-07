@extends('homepage.index')
@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Teknis</h4>
                <form class="forms-sample" action="{{ route('create-teknis') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" id="nomor_surat" placeholder=""
                            fdprocessedid="ynbjs">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" placeholder=""
                            fdprocessedid="a8ntcq">
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" name="tahun" class="form-control" id="tahun" placeholder=""
                            fdprocessedid="zukfe7">
                    </div>
                    <div class="form-group">
                        <label for="divisi_id">Divisi</label>
                        <select class="form-control" name="divisi_id" id="divisi_id" fdprocessedid="677jv">
                            {{-- <option value="">pilih</option> --}}
                            @foreach ($data as $data)
                                <option value="{{ $data->id }}">{{ $data->divisi }}</option>
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
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    <button class="btn btn-light" fdprocessedid="p0f3cn">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
