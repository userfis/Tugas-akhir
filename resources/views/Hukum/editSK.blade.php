@extends('homepage.index')

@section('page-header')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            @can('sekretaris')
                <div class="card-body">
                    <form class="forms-sample" action="/{{ $data->id }}/update-sk" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="card-title">Detail Surat</h3>
                        <div class="form-group border-bottom">
                            <label for="tanggal" class="text-black"><strong>Tanggal</strong></label>
                            <p class="text-black">{{ $data->tanggal }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="nomor_agenda" class="text-black"><strong>Nomor Agenda</strong></label>
                            <p class="text-black">{{ $data->nomor_agenda }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="nomor_surat" class="text-black"><strong>Nomor Surat</strong></label>
                            <p class="text-black">{{ $data->nomor_surat }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="asal_surat" class="text-black"><strong>Tujuan Surat</strong></label>
                            <p class="text-black">{{ $data->asal_surat }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="perihal" class="text-black"><strong>Perihal</strong></label>
                            <p class="text-black">{{ $data->perihal }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="lampiran" class="text-black"><strong>Lampiran</strong></label>
                            <p class="text-black">{{ $data->lampiran }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="kategori_surat" class="text-black"><strong>Kategori Surat</strong></label>
                            <p class="text-black">{{ $data->kategori->kategori_surat }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="status" class="text-black"><strong>Status</strong></label>
                            <p class="text-black">{{ $data->status }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="tindakan" class="text-black"><strong>Tindakan</strong></label>
                            <select class="form-control" name="tindakan" id="tindakan">
                                <option value="">pilih</option>
                                <option value="Perbaiki">Perbaiki</option>
                                <option value="Ajukan Ke Ketua KPU">Ajukan Ke Ketua KPU</option>
                            </select>
                        </div>
                        <input type="text" name="status" class="form-control" id="status" placeholder="" value="Diajukan" hidden>
                        
                        <script>
                            document.getElementById('tindakan').addEventListener('change', function() {
                                var tindakanValue = this.value;
                                var statusInput = document.getElementById('status');
                                
                                if (tindakanValue === 'Perbaiki') {
                                    statusInput.value = 'Perbaiki';
                                } else if (tindakanValue === 'Ajukan Ke Ketua KPU') {
                                    statusInput.value = 'Diajukan';
                                } else {
                                    statusInput.value = '';
                                }
                            });
                        </script>
                        <br>
                        <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                        <a href="{{ route('masuk') }}" class="btn btn-primary" fdprocessedid="p0f3cn">Kembali</a>
                    </form>
                </div>
            @elsecan('ketua')
                <div class="card-body">
                    <form class="forms-sample" action="/{{ $data->id }}/update-skp" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <h3 class="card-title">Detail Surat</h3>
                        <div class="form-group border-bottom">
                            <label for="tanggal" class="text-black"><strong>Tanggal</strong></label>
                            <p class="text-black">{{ $data->tanggal }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="nomor_agenda" class="text-black"><strong>Nomor Agenda</strong></label>
                            <p class="text-black">{{ $data->nomor_agenda }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="nomor_surat" class="text-black"><strong>Nomor Surat</strong></label>
                            <p class="text-black">{{ $data->nomor_surat }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="asal_surat" class="text-black"><strong>Asal Surat</strong></label>
                            <p class="text-black">{{ $data->asal_surat }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="perihal" class="text-black"><strong>Perihal</strong></label>
                            <p class="text-black">{{ $data->perihal }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="lampiran" class="text-black"><strong>Lampiran</strong></label>
                            <p class="text-black">{{ $data->lampiran }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="kategori_surat" class="text-black"><strong>Kategori Surat</strong></label>
                            <p class="text-black">{{ $data->kategori->kategori_surat }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="status" class="text-black"><strong>Status</strong></label>
                            <p class="text-black">{{ $data->status }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="status" class="text-black"><strong>Tindakan</strong></label>
                            <p class="text-black">{{ $data->tindakan }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="tindakan" class="text-black"><strong>Tindakan</strong></label>
                            <select class="form-control" name="tindakan" id="tindakan">
                                <option value="">pilih</option>
                                <option value="Perbaiki">Perbaiki</option>
                                <option value="Ajukan Ke Ketua KPU">Ajukan Ke Ketua KPU</option>
                            </select>
                        </div>
                        
                        <!-- Input pesan akan muncul di sini jika opsi "Perbaiki" dipilih -->
                        <div class="form-group" id="pesanInput" style="display: none;">
                            <label for="pesan" class="text-black"><strong>Catatan</strong></label>
                            <input type="text" name="pesan" class="form-control" id="pesan" placeholder="">
                        </div>
                        
                        <input type="text" name="status" class="form-control" id="status" value="Diajukan" hidden>
                        
                        <script>
                            document.getElementById('tindakan').addEventListener('change', function() {
                                var tindakanValue = this.value;
                                var statusInput = document.getElementById('status');
                                var pesanInput = document.getElementById('pesanInput');
                        
                                if (tindakanValue === 'Perbaiki') {
                                    statusInput.value = 'Perbaiki';
                                    pesanInput.style.display = 'block'; // Tampilkan input pesan
                                } else if (tindakanValue === 'Ajukan Ke Ketua KPU') {
                                    statusInput.value = 'Diajukan';
                                    pesanInput.style.display = 'none'; // Sembunyikan input pesan
                                } else {
                                    statusInput.value = '';
                                    pesanInput.style.display = 'none'; // Sembunyikan input pesan
                                }
                            });
                        </script>

                        {{-- <div class="form-group border-bottom">
                <label for="disposisi" class="text-black"><strong>Disposisi</strong></label>
                @if ($data->disposisi)
                    <p class="text-black">{{ $data->disposisi }}</p>
                @else
                    <p class="text-black">Belum ada disposisi</p>
                @endif
            </div>

            <div class="form-group border-bottom">
                <label for="pesan" class="text-black"><strong>Catatan</strong></label>
                @if ($data->pesan)
                <p class="text-black">{{ $data->pesan }}</p>
            @else
                <p class="text-black">Belum ada Catatan</p>
            @endif
            </div>
             --}}
                        <br>
                        <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                        <a href="{{ route('masuk') }}" class="btn btn-primary" fdprocessedid="p0f3cn">Kembali</a>
                    </form>
                </div>
            @endcan
        </div>
    </div>
@endsection
