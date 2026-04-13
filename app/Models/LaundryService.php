<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;
    // field yang boleh diisi (mass assigment)
    protected $fillable = [
        'name', // nama layanan
        'price_per_kg', //harga per kg
        'description', // deskripsi layanan
        'is_active', // status aktif / tidak
        'sort_order', //urutan tampil
    ];

    // casting tipe data otomatis
    protected function casts(): array
    {
        return [
            'price_per_kg' => 'decimal:2', //angka desimal (2 angka di belakang)
            'is_active'    => 'boolean', // true / false
            'sort_order'   => 'integer', // angka bulat
        ];
    }

    // scope : ambil hanya layanan yang aktif
    public function scopeActive($query)
    {
        // hanya yang aktif dan urutkan berdasarkan urutan
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    // Accessor: format harga jadi rupiah
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price_per_kg, 0, ',', '.');
    }
}
