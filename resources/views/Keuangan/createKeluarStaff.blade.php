@extends('homepage.index')

@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data</h4>
                <form class="forms-sample" action="{{ route('create-keluar-staff') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal Surat Keluar</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder=""
                            fdprocessedid="a8ntcq" value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomor_agenda">Nomor Agenda</label>
                        <input type="text" name="nomor_agenda" class="form-control" id="nomor_agenda" placeholder=""
                            fdprocessedid="a8ntcq" value="{{ old('nomor_agenda') }}">
                        @error('nomor_agenda')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" id="nomor_surat" placeholder=""
                            fdprocessedid="ynbjs" value="{{ old('nomor_surat') }}">
                        @error('nomor_surat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="asal_surat">Tujuan Surat</label>
                        <input type="text" name="asal_surat" class="form-control" id="asal_surat" placeholder=""
                            fdprocessedid="zukfe7" value="{{ old('asal_surat') }}">
                        @error('asal_surat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input type="text" name="perihal" class="form-control" id="perihal" placeholder=""
                            fdprocessedid="zukfe7" value="{{ old('perihal') }}">
                        @error('perihal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lampiran">Lampiran</label>
                        <input type="text" name="lampiran" class="form-control" id="lampiran" placeholder=""
                            fdprocessedid="zukfe7" value="{{ old('lampiran') }}">
                        @error('lampiran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tindakan">Tindakan</label>
                        <input type="text" name="tindakan" class="form-control" id="tindakan" placeholder=""
                            fdprocessedid="zukfe7" value="{{ old('tindakan') }}">
                        @error('tindakan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori_id">Kategori Surat</label>
                        <select class="form-control" name="kategori_id" id="kategori_id" fdprocessedid="677jv">
                            <option value="">pilih</option>
                            @foreach ($kategori as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->kategori_surat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Upload PDF</label>
                        <input type="file" class="form-control file-upload-info" name="file" id="file"
                           placeholder="Upload PDF" fdprocessedid="w1iqnm">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <input type="text" name="data_id" id="data_id" value="2" hidden>
                    @can('staffDat')
                    <input type="text" name="disposisi" id="disposisi" value="Staff Data & Informasi " hidden>
                    @elsecan('staffKeu')
                    <input type="text" name="disposisi" id="disposisi" value="Staff Keuangan" hidden>
                    @elsecan('staffHuk')
                    <input type="text" name="disposisi" id="disposisi" value="Staff Hukum" hidden>
                    @elsecan('staffTek')
                    <input type="text" name="disposisi" id="disposisi" value="Staff Teknis" hidden>
                    @endcan
                    <input type="text" name="status" id="status" value="Proses Pengecekan" hidden>
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    <a href="{{ route('masuk') }}" class="btn btn-light" fdprocessedid="p0f3cn">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
