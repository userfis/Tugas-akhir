@extends('homepage.index')
@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit data</h4>
                <form class="forms-sample" action="/{{ $data->id }}/update-data" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" id="nomor_surat" placeholder=""
                            fdprocessedid="ynbjs" value="{{ $data->nomor_surat }}">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" placeholder=""
                            fdprocessedid="a8ntcq" value="{{ $data->judul }}">
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" name="tahun" class="form-control" id="tahun" placeholder=""
                            fdprocessedid="zukfe7" value="{{ $data->tahun }}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="divisi_id">Divisi</label>
                        <input type="text" name="divisi_id" class="form-control" id="divisi_id" placeholder=""
                            fdprocessedid="zukfe7" value="{{ $data->divisi->id }}" readonly>
                    </div> --}}
                    <div class="form-group">
                        <label for="divisi_id">Divisi</label>
                        <select class="form-control" name="divisi_id" id="divisi_id" fdprocessedid="677jv">
                            @foreach ($divisi as $item)    
                            {{-- <option value="{{ $item->id }}">{{ $item->divisi }}</option> --}}
                            <option value="{{ $item->id }}" {{ $item->id == $data->divisi_id ? 'selected' : '' }}>
                                {{ $item->divisi }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">Upload PDF</label>
                        <input type="file" class="form-control file-upload-info" name="file" id="file"
                            placeholder="Upload PDF" fdprocessedid="w1iqnm">
                            <label for="file">file yang sudah diunggah :<a href="/storage/{{ $data->file }}"
                                target="_blank">{{ $data->judul }}.pdf</label>
                    </div>
                    
                    <input type="text" name="data_id" id="data_id" value="1" hidden>
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    <button class="btn btn-light" fdprocessedid="p0f3cn">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
