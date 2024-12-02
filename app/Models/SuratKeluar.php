<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar'; // Nama tabel di database
    protected $fillable = [
        'karyawan_id', 
        'judul', 
        'isi', 
        'tanggal_keluar'
    ];
}
