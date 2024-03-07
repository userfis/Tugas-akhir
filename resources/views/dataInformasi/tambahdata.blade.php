@extends('homepage.index')
@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data</h4>
                <form class="forms-sample" action="" method="">
                    <div class="form-group">
                        <label for="exampleInputName1">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" id="exampleInputName1" placeholder=""
                            fdprocessedid="ynbjs">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Judul</label>
                        <input type="text" name="judul" class="form-control" id="exampleInputEmail3" placeholder=""
                            fdprocessedid="a8ntcq">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Tahun</label>
                        <input type="text" name="tahun" class="form-control" id="exampleInputPassword4" placeholder=""
                            fdprocessedid="zukfe7">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Divisi</label>
                        <select class="form-control" name="divisi" id="exampleSelectGender" fdprocessedid="677jv">
                            @foreach ($data as $data)    
                            <option value="{{ $data->id }}">{{ $data->divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Input Data : PDF</label>
                        {{-- <input type="file" name="file" class="file-upload-default" id="file"> --}}
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" name="file" id="file" disabled="" placeholder=""
                                fdprocessedid="u8v88o">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"
                                    fdprocessedid="07yfyp">Upload</button>
                            </span>
                        </div>
                    </div>
                    <input type="text" name="data_id" id="data_id" value="1">
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    <button class="btn btn-light" fdprocessedid="p0f3cn">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
