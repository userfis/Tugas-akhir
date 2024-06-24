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
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="" fdprocessedid="a8ntcq" value="{{ old('nama') }}">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-black">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="" fdprocessedid="a8ntcq" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username" class="text-black">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="" fdprocessedid="a8ntcq" value="{{ old('username') }}">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="is_admin" class="text-black">Role</label>
                        <select class="form-control @error('is_admin') is-invalid @enderror" name="is_admin" id="is_admin" fdprocessedid="677jv">
                            <option value="" {{ old('is_admin', '') === '' ? 'selected' : '' }}>pilih</option>
                            <option value="0" {{ old('is_admin') === 0 ? 'selected' : '' }}>Admin TU</option>
                            <option value="1" {{ old('is_admin') === 1 ? 'selected' : '' }}>Ketua KPU</option>
                            <option value="2" {{ old('is_admin') === 2 ? 'selected' : '' }}>Sekretaris</option>
                            <option value="3" {{ old('is_admin') === 3 ? 'selected' : '' }}>Staff Data & Informasi</option>
                            <option value="4" {{ old('is_admin') === 4 ? 'selected' : '' }}>Staff Hukum</option>
                            <option value="5" {{ old('is_admin') === 5 ? 'selected' : '' }}>Staff Keuangan</option>
                            <option value="6" {{ old('is_admin') === 6 ? 'selected' : '' }}>Staff Teknis</option>
                        </select>
                        @error('is_admin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="" fdprocessedid="a8ntcq">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <br>
                    <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
