<?php

namespace App\Models;

use App\Models\Data;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;
    protected $table = 'emails';
    protected $guarded = ['id'];

    public function surat(){
            return $this->belongsTo(Data::class, 'surat_id');
    }
}
