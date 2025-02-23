<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'Menus';
    // protected $primaryKey = 'menu_id';

    protected $fillable = [
        'nama_menu',
        'harga',
        
    ];
    // public function details()
    // {
    //     return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    // }
}
