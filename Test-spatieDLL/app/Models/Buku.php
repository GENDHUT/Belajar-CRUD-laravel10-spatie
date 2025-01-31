<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Buku extends Model
    {
        use HasFactory;
        
        protected $table = 'buku';

        protected $fillable = [
            'judul',
            'penerbit',
            'penulis',
            'tahun_terbit',
            'deskripsi',
            'gambar',
            'status',
        ];

        public function ulasan()
        {
            return $this->hasMany(UlasanBuku::class, 'buku_id'); 
        }

        public function kategori()
    {
        return $this->belongsToMany(KategotiBuku::class, 'kategori_buku_relasis', 'buku_id', 'kategori_id');
    }


    }
