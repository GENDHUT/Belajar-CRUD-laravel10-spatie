<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';

    protected $fillable = [
        'pelanggan_id',
        'tanggal_penjualan',
        'total_harga'
    ];

    public function details()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }

    // Relasi ke pelanggan (jika ada)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
