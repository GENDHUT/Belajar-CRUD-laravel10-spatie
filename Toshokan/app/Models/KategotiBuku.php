<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategotiBuku extends Model
{
    use HasFactory;
    protected $table ='kategoti_bukus';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_kategori'];

    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'kategori_buku_relasis', 'kategori_id', 'buku_id');
    }   

    

}
