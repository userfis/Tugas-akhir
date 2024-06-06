@extends('homepage.index')
@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data User</h4>
                <form class="forms-sample" action="{{ route('create-user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="text-black">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="" fdprocessedid="a8ntcq" value="{{ old('nama') }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-black">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="" fdprocessedid="a8ntcq" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="username" class="text-black">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="" fdprocessedid="a8ntcq" value="{{ old('username') }}">
                    </div>
                    <div class="form-group">
                        <label for="is_admin" class="text-black">Role</label>
                        <select class="form-control" name="is_admin" id="is_admin" fdprocessedid="677jv">
                            <option>pilih</option>
                            <option value="1">Ketua KPU</option>
                            <option value="2">Sekretaris</option>
                            <option value="3">Staff Data & Informasi</option>
                            <option value="4">Staff Hukum</option>
                            <option value="5">Staff Keuangan</option>
                            <option value="6">Staff Teknis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-black">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="" fdprocessedid="a8ntcq">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="text-black">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="" fdprocessedid="a8ntcq">
                    </div>
                    
                    <br>
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    <a href="{{ route('masuk') }}" class="btn btn-light" fdprocessedid="p0f3cn">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
