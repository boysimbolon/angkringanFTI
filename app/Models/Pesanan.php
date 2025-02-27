<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pemesan','menu1','menu2', 'jumlah1','jumlah2', 'total_harga','status','mode_pembayaran','catatan'];

    public function menu1()
    {
        return $this->belongsTo(Menu::class, 'menu1', 'id');
    }
    public function menu2()
    {
        return $this->belongsTo(Menu::class, 'menu2','id');
    }
}
