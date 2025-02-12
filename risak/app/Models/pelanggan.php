<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;
    protected $table ='pelanggans';
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'nomor_telpon'
    ];

}
