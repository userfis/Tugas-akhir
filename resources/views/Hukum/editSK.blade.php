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
                            <label for="tanggal" class="text-black"><strong>Tanggal Surat Keluar</strong></label>
                            <p class="text-black">{{ $data->tanggal }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="nomor_agenda" class="text-black"><strong>Nomor Agenda</strong></label>
                            <p class="text-black">{{ $data->nomor_agenda }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="nomor_agenda" class="text-black"><strong>Sifat</strong></label>
                            <p class="text-black">{{ $data->sifat }}</p>
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
                            <label for="nomor_agenda" class="text-black"><strong>Dari Disposisi</strong></label>
                            <p class="text-black">{{ $data->disposisi }}</p>
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
                    </form>
                </div>
            @elsecan('ketua')
                <div class="card-body">
                    <form class="forms-sample" action="/{{ $data->id }}/update-skp" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <h3 class="card-title">Detail Surat</h3>
                        <div class="form-group border-bottom">
                            <label for="tanggal" class="text-black"><strong>Tanggal Surat Keluar</strong></label>
                            <p class="text-black">{{ $data->tanggal }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="nomor_agenda" class="text-black"><strong>Nomor Agenda</strong></label>
                            <p class="text-black">{{ $data->nomor_agenda }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="sifat" class="text-black"><strong>Sifat</strong></label>
                            <p class="text-black">{{ $data->sifat }}</p>
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
                            <label for="nomor_agenda" class="text-black"><strong>Dari Disposisi</strong></label>
                            <p class="text-black">{{ $data->disposisi }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="status" class="text-black"><strong>Status</strong></label>
                            <p class="text-black">{{ $data->status }}</p>
                        </div>

                        <div class="form-group border-bottom">
                            <label for="status" class="text-black"><strong>Tindakan</strong></label>
                            <p class="text-black">{{ $data->tindakan }}</p>
                        </div>

                        {{-- <div class="form-group border-bottom">
                            <label for="tindakan" class="text-black"><strong>Tindakan</strong></label>
                            <select class="form-control" name="tindakan" id="tindakan">
                                <option value="">pilih</option>
                                <option value="Perbaiki">Perbaiki</option>
                                <option value="Berkas Siap Dikirim">Berkas Siap Dikirim</option>
                            </select>
                        </div> --}}
                        
                        <!-- Input pesan akan muncul di sini jika opsi "Perbaiki" dipilih -->
                        <div class="form-group">
                            <label for="tindakan" class="text-black"><strong>Tindakan</strong></label>
                            <select class="form-control" name="tindakan" id="tindakan">
                                <option value="">Pilih</option>
                                <option value="Perbaiki">Perbaiki</option>
                                <option value="Berkas Siap Dikirim">Berkas Siap Dikirim</option>
                            </select>
                        </div>
                        
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
                                } else if (tindakanValue === 'Berkas Siap Dikirim') {
                                    statusInput.value = 'Berkas Siap Dikirim';
                                    pesanInput.style.display = 'block'; // Tampilkan input pesan
                                } else {
                                    statusInput.value = '';
                                    pesanInput.style.display = 'none'; // Sembunyikan input pesan
                                }
                            });
                        </script>
                        <br>
                        <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
@endsection
