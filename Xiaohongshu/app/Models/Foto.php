<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'judul_foto',
        'deskripsi_foto',
        'tanggal_unggah',
        'lokasi_file',
        'album_id',
        'user_id',
    ];

    public function album(){
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(FotoLike::class, 'foto_id');
    }

    public function comments()
    {
        return $this->hasMany(FotoComment::class, 'foto_id');
    }   


}
