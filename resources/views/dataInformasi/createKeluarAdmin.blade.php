@extends('homepage.index')
@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data</h4>
                <form class="forms-sample" action="{{ route('create-SK') }}" method="POST" enctype="multipart/form-data">
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
                            fdprocessedid="a8ntcq" value="00{{ $agenda + 1 }}" readonly>
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
                        <label for="sifat">Sifat</label>
                        <select class="form-control" name="sifat" id="sifat">
                            <option>pilih</option>
                            <option value="Penting">Penting</option>
                            <option value="Biasa">Biasa</option>
                            <option value="Segera">Segera</option>
                            <option value="Sangat Segera">Sangat Segera</option>
                        </select>
                        @error('sifat')
                            <span class="text-danger">{{ $message }}</span>
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
                        <label for="disposisi">Bagian Disposisi</label>
                        <select class="form-control" name="disposisi" id="disposisi" fdprocessedid="677jv">
                            <option value="">pilih</option>
                            <option value="Ketua KPU" {{ old('disposisi') == 'Ketua KPU' ? 'selected' : '' }}>Ketua KPU</option>
                            <option value="Sekretaris" {{ old('disposisi') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                            <option value="Staff Data & Informasi" {{ old('disposisi') == 'Staff Data & Informasi' ? 'selected' : '' }}>Staff Data & Informasi</option>
                            <option value="Staff Keuangan" {{ old('disposisi') == 'Staff Keuangan' ? 'selected' : '' }}>Staff Keuangan</option>
                            <option value="Staff Hukum" {{ old('disposisi') == 'Staff Hukum' ? 'selected' : '' }}>Staff Hukum</option>
                            <option value="Staff Teknis" {{ old('disposisi') == 'Staff Teknis' ? 'selected' : '' }}>Staff Teknis</option>
                        </select>
                        @error('disposisi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Upload PDF</label>
                        <input type="file" class="form-control file-upload-info" name="file" id="file" placeholder="Upload PDF" fdprocessedid="w1iqnm">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <input type="text" name="data_id" id="data_id" value="2" hidden>
                    <input type="text" name="data_id" id="pass_id" value="2" hidden>
                    <input type="text" name="status" id="status" value="Proses Pengecekan" hidden>
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
