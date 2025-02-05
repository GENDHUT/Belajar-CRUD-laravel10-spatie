<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoComment extends Model
{
    use HasFactory;
    protected $table = 'foto_comments';

    protected $fillable = [
        'foto_id',
        'user_id',
        'isi_komentar',
    ];

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'foto_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
