<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'jumlah', 'total_harga', 'completed_at'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}

