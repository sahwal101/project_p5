<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Function_;
use PhpParser\Node\Stmt\Return_;

class Mapel extends Model
{
    use HasFactory;
    protected $fillable = ['nama_mapel','kode_mapel','id_guru'];
    protected $visible = ['nama_mapel','kode_mapel','id_guru'];

    PUBLIC Function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
