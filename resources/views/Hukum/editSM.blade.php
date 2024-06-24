@extends('homepage.index')

@section('page-header')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        @can('sekretaris')
        <div class="card-body">
            <form class="forms-sample" action="/{{ $data->id }}/update-sm" method="POST" enctype="multipart/form-data">
             @csrf
            <h3 class="card-title">Detail Surat</h3>
            <div class="form-group border-bottom">
                <label for="tanggal" class="text-black"><strong>Tanggal Surat masuk</strong></label>
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
                <label for="sifat" class="text-black"><strong>Sifat</strong></label>
                <p class="text-black">{{ $data->sifat }}</p>
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
                <label for="tindakan" class="text-black"><strong>Tindakan</strong></label>
                <select class="form-control" name="tindakan" id="tindakan" fdprocessedid="677jv">
                    <option>pilih</option>
                    <option value="Cek Kembali">Cek Kembali</option>
                    <option value="Ajukan Ke Ketua KPU">Ajukan Ke Ketua KPU</option>
                </select>
            </div>
            
            <div id="pesan">
                <label for="tindakan" class="text-black"><strong>Pesan</strong></label>
                <input type="text" name="pesan" class="form-control" id="pesan" placeholder="">
            </div>
            
            <!-- Input status -->
            <input type="text" name="status" class="form-control" id="status" value="Diajukan" hidden>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function(){
                    // Sembunyikan form input pesan secara default
                    $('#pesan').hide();
            
                    // Tangani perubahan pada select
                    $('#tindakan').change(function(){
                        var selectedOption = $(this).val();
            
                        // Jika opsi yang dipilih adalah "Cek Kembali", tampilkan form input pesan
                        if(selectedOption == 'Cek Kembali'){
                            $('#pesan').show();
                            $('#status').val('Cek Kembali');
                        } else {
                            // Jika opsi yang dipilih bukan "Cek Kembali", sembunyikan form input pesan
                            $('#pesan').hide();
                            // Atur kembali nilai input status ke nilai default (misalnya, "Diajukan")
                            $('#status').val('Diajukan');
                        }
                    });
                });
            </script>
            {{-- <div class="form-group border-bottom">
                <label for="disposisi" class="text-black"><strong>Disposisi</strong></label>
                @if($data->disposisi)
                    <p class="text-black">{{ $data->disposisi }}</p>
                @else
                    <p class="text-black">Belum ada disposisi</p>
                @endif
            </div>

            <div class="form-group border-bottom">
                <label for="pesan" class="text-black"><strong>Catatan</strong></label>
                @if($data->pesan)
                <p class="text-black">{{ $data->pesan }}</p>
            @else
                <p class="text-black">Belum ada Catatan</p>
            @endif
            </div>
             --}}
            <br>
            <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
        </form>
        </div>
        @elsecan('ketua')  
        <div class="card-body">
            <form class="forms-sample" action="/{{ $data->id }}/update-smp" method="POST" enctype="multipart/form-data">
             @csrf
            <h3 class="card-title">Detail Surat</h3>
            <div class="form-group border-bottom">
                <label for="tanggal" class="text-black"><strong>Tanggal Surat Masuk</strong></label>
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
                <label for="sifat" class="text-black"><strong>Sifat</strong></label>
                <p class="text-black">{{ $data->sifat }}</p>
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
                <label for="disposisi" class="text-black"><strong>Disposisi</strong></label>
                <select class="form-control" name="disposisi" id="disposisi" fdprocessedid="677jv">
                    <option>pilih</option>
                        <option value="Ketua KPU">Ketua KPU</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Staff Keuangan">Staff Keuangan</option>
                        <option value="Staff Hukum">Staff Hukum</option>
                        <option value="Staff Teknis">Staff Teknis</option>
                        <option value="Staff Data & Informasi">Staff Data & Informasi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pesan" class="text-black"><strong>Catatan</strong></label>
                <input type="text" name="pesan" class="form-control" id="pesan" placeholder=""
                    fdprocessedid="zukfe7">
            </div>

            <input type="text" name="status" class="form-control" id="status" placeholder=""
                            fdprocessedid="zukfe7" value="Disposisi" hidden>

            {{-- <div class="form-group border-bottom">
                <label for="disposisi" class="text-black"><strong>Disposisi</strong></label>
                @if($data->disposisi)
                    <p class="text-black">{{ $data->disposisi }}</p>
                @else
                    <p class="text-black">Belum ada disposisi</p>
                @endif
            </div>

            <div class="form-group border-bottom">
                <label for="pesan" class="text-black"><strong>Catatan</strong></label>
                @if($data->pesan)
                <p class="text-black">{{ $data->pesan }}</p>
            @else
                <p class="text-black">Belum ada Catatan</p>
            @endif
            </div>
             --}}
            <br>
            <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
        </form>
        </div>
        @endcan
    </div>
</div>
@endsection
