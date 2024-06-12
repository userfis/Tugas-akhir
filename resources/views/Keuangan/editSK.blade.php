@extends('homepage.index')

@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data</h4>
                <form class="forms-sample" action="/{{ $data->id }}/update/edit-sk" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="tanggal">Tanggal Surat Keluar</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder=""
                            value="{{ old('tanggal', $data->tanggal) }}">
                        @error('tanggal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomor_agenda">Nomor Agenda</label>
                        <input type="text" name="nomor_agenda" class="form-control" id="nomor_agenda" placeholder=""
                            value="{{ old('nomor_agenda', $data->nomor_agenda) }}">
                        @error('nomor_agenda')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" id="nomor_surat" placeholder=""
                            value="{{ old('nomor_surat', $data->nomor_surat) }}">
                        @error('nomor_surat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="asal_surat">Asal Surat</label>
                        <input type="text" name="asal_surat" class="form-control" id="asal_surat" placeholder=""
                            value="{{ old('asal_surat', $data->asal_surat) }}">
                        @error('asal_surat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input type="text" name="perihal" class="form-control" id="perihal" placeholder=""
                            value="{{ old('perihal', $data->perihal) }}">
                        @error('perihal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lampiran">Lampiran</label>
                        <input type="text" name="lampiran" class="form-control" id="lampiran" placeholder=""
                            value="{{ old('lampiran', $data->lampiran) }}">
                        @error('lampiran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tindakan">Tindakan</label>
                        <input type="text" name="tindakan" class="form-control" id="tindakan" placeholder=""
                            value="{{ old('tindakan', $data->tindakan) }}">
                        @error('tindakan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori_id">Kategori Surat</label>
                        <select class="form-control" name="kategori_id" id="kategori_id">
                            <option value="">pilih</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id', $data->kategori_id) == $kat->id ? 'selected' : '' }}>{{ $kat->kategori_surat }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Upload PDF</label>
                        <input type="file" class="form-control file-upload-info" name="file" id="file" placeholder="Upload PDF">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <input type="text" class="form-control file-upload-info" name="status" id="status" hidden>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('masuk') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
