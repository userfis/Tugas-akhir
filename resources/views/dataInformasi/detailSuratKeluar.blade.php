@extends('homepage.index')

@section('page-header')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
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
            @if (is_null($arsip))
            <div class="form-group border-bottom">
                <label for="tindakan" class="text-black"><strong>Status Arsip</strong></label>
                <p class="text-black">Surat Belum Diarsip</p>
            </div>
            @elseif (!is_null($arsip))
            <label for="tindakan" class="text-black"><strong>Status Arsip</strong></label>
                <p class="text-black">Surat Sudah Diarsip</p>
            @endif
        </div>
    </div>
</div>
@endsection
