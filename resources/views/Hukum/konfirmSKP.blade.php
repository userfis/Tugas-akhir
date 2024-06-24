@extends('homepage.index')

@section('page-header')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form class="forms-sample" action="/{{ $data->id }}/pimpinan/update-skp" method="POST" enctype="multipart/form-data">
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
                <label for="tindakan" class="text-black"><strong>Tindakan</strong></label>
                <p class="text-black">{{ $data->tindakan }}</p>
            </div>

            <div class="form-group border-bottom">
                <label for="status" class="text-black"><strong>Status</strong></label>
                <p class="text-black">{{ $data->status }}</p>
            </div>

            <div class="form-group border-bottom">
                <label for="disposisi" class="text-black"><strong>Disposisi</strong></label>
                    <p class="text-black">{{ $data->disposisi }}</p>
            </div>

            <div class="form-group border-bottom">
                <label for="pesan" class="text-black"><strong>Pesan</strong></label>
                <p class="text-black">{{ $data->pesan }}</p>
            </div>

            @if ($data->status == 'Berkas Siap Dikirim' && is_null($arsip))
                        <input type="text" name="surat_id" id="surat_id" value="{{ $data->id }}" hidden>
                        <input type="date" name="tanggal_arsip" id="tanggal_arsip" value="" hidden>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var today = new Date();
                                var year = today.getFullYear();
                                var month = ("0" + (today.getMonth() + 1)).slice(-2);
                                var day = ("0" + today.getDate()).slice(-2);
                                var formattedDate = year + "-" + month + "-" + day;

                                document.getElementById('tanggal_arsip').value = formattedDate;
                            });
                        </script>
                        <div class="form-group border-bottom">
                            <label for="rak_id" class="text-black"><strong>Pilih Lokasi Arsip</strong></label>
                            <select class="form-control" name="rak_id" id="rak_id" fdprocessedid="677jv">
                                <option>pilih</option>
                                @foreach ($rak as $rak)
                                    @can('ketua')
                                        @if ($rak->pemilik_rak == 'Ketua KPU')
                                            <option value="{{ $rak->id }}">{{ $rak->nama_rak }}</option>
                                        @endif
                                    @elsecan('sekretaris')
                                        @if ($rak->pemilik_rak == 'Sekretaris')
                                            <option value="{{ $rak->id }}">{{ $rak->nama_rak }}</option>
                                        @endif
                                    @endcan
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary mr-2" fdprocessedid="cha8ou">Submit</button>
                    @elseif ($data->status != 'Berkas Siap Dikirim')
                        <div class="form-group border-bottom">
                            <label for="rak_id" class="text-black"><strong>Status Arsip</strong></label>
                            <p class="text-black">Surat Belum Diarsip</p>
                        </div>
                    @elseif(!is_null($arsip))
                    <div class="form-group border-bottom">
                        <label for="rak_id" class="text-black"><strong>Status Arsip</strong></label>
                        <p class="text-black">Surat Sudah Diarsip</p>
                    </div>
                    @endif
           
            </form>
        </div>
    </div>
</div>
@endsection
