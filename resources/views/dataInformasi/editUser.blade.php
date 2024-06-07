@extends('homepage.index')
@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data User</h4>
                <form class="forms-sample" action="/{{ $user->id }}/update-user" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="text-black">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="" fdprocessedid="a8ntcq" value="{{ $user->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-black">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="" fdprocessedid="a8ntcq" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="username" class="text-black">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="" fdprocessedid="a8ntcq" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="is_admin" class="text-black">Role</label>
                        <select class="form-control" name="is_admin" id="is_admin">
                            <option value="" disabled>Pilih</option>
                            <option value="0" {{ old('is_admin', $user->is_admin) == 0 ? 'selected' : '' }}>Admin TU</option>
                            <option value="1" {{ old('is_admin', $user->is_admin) == 1 ? 'selected' : '' }}>Ketua KPU</option>
                            <option value="2" {{ old('is_admin', $user->is_admin) == 2 ? 'selected' : '' }}>Sekretaris</option>
                            <option value="3" {{ old('is_admin', $user->is_admin) == 3 ? 'selected' : '' }}>Staff Data & Informasi</option>
                            <option value="4" {{ old('is_admin', $user->is_admin) == 4 ? 'selected' : '' }}>Staff Hukum</option>
                            <option value="5" {{ old('is_admin', $user->is_admin) == 5 ? 'selected' : '' }}>Staff Keuangan</option>
                            <option value="6" {{ old('is_admin', $user->is_admin) == 6 ? 'selected' : '' }}>Staff Teknis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="current_password" class="text-black">Password Lama</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" placeholder="">
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-black">Password Baru</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="text-black">Konfirmasi Password Baru</label>
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
