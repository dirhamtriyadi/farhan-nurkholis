<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';

    protected $fillable = [
        'stock_barang_id',
        'created_by',
        'updated_by',
        'tanggal',
        'kuantitas',
        'keterangan',
    ];

    public function stockBarang()
    {
        return $this->belongsTo(StockBarang::class, 'stock_barang_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
