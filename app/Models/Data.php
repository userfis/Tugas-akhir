<?php

namespace App\Models;

use App\Models\Email;
use App\Models\Divisi;
use App\Models\jenisData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function email(){
        return $this->hasMany(Email::class);
    }
}
