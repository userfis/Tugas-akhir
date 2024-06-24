@extends('homepage.index')

@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Surat Keluar</h4>
                <form class="forms-sample" action="/{{ $data->id }}/update-data-sk" method="POST" enctype="multipart/form-data">
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
                            value="{{ old('nomor_agenda', $data->nomor_agenda) }}" readonly>
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
                        <label for="sifat">Sifat</label>
                        <select class="form-control" name="sifat" id="sifat">
                            <option value="">Pilih</option>
                            <option value="Penting" {{ $data->sifat == 'Penting' ? 'selected' : '' }}>Penting</option>
                            <option value="Biasa" {{ $data->sifat == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                            <option value="Segera" {{ $data->sifat == 'Segera' ? 'selected' : '' }}>Segera</option>
                            <option value="Sangat Segera" {{ $data->sifat == 'Sangat Segera' ? 'selected' : '' }}>Sangat Segera</option>
                        </select>
                        @error('sifat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="asal_surat">Tujuan Surat</label>
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
                        <select class="form-control" name="kategori_id" id="kategori_id" fdprocessedid="677jv">
                            <option value="">pilih</option>
                            @foreach ($kategori as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $data->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
                            <option value="Ketua KPU" {{ old('disposisi', $data->disposisi) == 'Ketua KPU' ? 'selected' : '' }}>Ketua KPU</option>
                            <option value="Sekretaris" {{ old('disposisi', $data->disposisi) == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                            <option value="Staff Data & Informasi" {{ old('disposisi', $data->disposisi) == 'Staff Data & Informasi' ? 'selected' : '' }}>Staff Data & Informasi</option>
                            <option value="Staff Keuangan" {{ old('disposisi', $data->disposisi) == 'Staff Keuangan' ? 'selected' : '' }}>Staff Keuangan</option>
                            <option value="Staff Hukum" {{ old('disposisi', $data->disposisi) == 'Staff Hukum' ? 'selected' : '' }}>Staff Hukum</option>
                            <option value="Staff Teknis" {{ old('disposisi', $data->disposisi) == 'Staff Teknis' ? 'selected' : '' }}>Staff Teknis</option>
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
                    <input type="text" name="data_id" id="data_id" value="{{ $data->data_id }}" hidden>
                    {{-- <input type="text" name="pass_id" id="pass_id" value="{{ $data->pass_id }}" hidden> --}}
                    <input type="text" name="status" id="status" value="Proses Pengecekan" hidden>
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    <a href="{{ route('masuk') }}" class="btn btn-light" fdprocessedid="p0f3cn">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
