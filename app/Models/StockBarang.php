<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBarang extends Model
{
    use HasFactory;

    protected $table = 'stock_barang';

    protected $fillable = [
        'created_by',
        'updated_by',
        'nama',
        'jenis',
        'kategori',
        'merk',
        'satuan',
        'kuantitas',
        'keterangan',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
