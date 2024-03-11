<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Divisi;
use App\Models\jenisData;

class Data extends Model
{
    use HasFactory;
    protected $table = 'data';
    protected $guarded = ['id'];

    public function divisi(){
        return $this->belongsTo(Divisi::class);
    }

    public function jenis_data(){
        return $this->belongsTo(jenisData::class);
    }
}
