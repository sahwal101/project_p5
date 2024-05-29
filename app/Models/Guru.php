<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $fillable = ['nip','nama_guru', 'jenis_kelamin', 'agama','tempat_lahir','tanggal_lahir','foto'];
    protected $visible = ['nip','nama_guru', 'jenis_kelamin', 'agama','tempat_lahir','tanggal_lahir','foto'];

public function mapel()
{
    return $this->hasMany(Mapel::class, 'id_mapel');
}

public function Kelas()
{
    return $this->hasMany(Kelas::class, 'id_kelas');
}

}
