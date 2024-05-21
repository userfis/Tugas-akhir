<?php

namespace App\Models;

use App\Models\Rak;
use App\Models\Data;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arsip extends Model
{
    use HasFactory;
    protected $table = 'arsips';
    protected $guarded = ['id'];

    public function rak(){
        return $this->belongsTo(Rak::class);
    }

    public function data(){
        return $this->belongsTo(Data::class,'surat_id', 'id');
    }
}
