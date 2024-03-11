<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisis';
    protected $guarded = ['id'];

    public function data(){
        return $this->hasMany(Data::class);
    }
}
