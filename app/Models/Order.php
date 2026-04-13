<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // field yang boleh diisi
    protected $fillable = [
        'user_id', //relasi ke user
        'customer_name',
        'phone',
        'address',
        'items',
        'weight',
        'service',
        'price',
        'total',
        'status',
        'pickup_date',
        'estimated_pickup',
        'is_confirmed',
        'confirmed_at',
    ];

    // casting tipe data
    protected function casts(): array
    {
        return [
            'weight'           => 'decimal:2',
            'price'            => 'decimal:2',
            'total'            => 'decimal:2',
            'pickup_date'      => 'datetime',
            'estimated_pickup' => 'datetime',
            'confirmed_at'     => 'datetime',
            'is_confirmed'     => 'boolean',
        ];
    }

    // relasi: setiap order milik 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // menentukan class badge berdasarkan status (untuk tampilan UI)
    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'pending'    => 'badge-warning',
            'in_process' => 'badge-info',
            'ready'      => 'badge-success',
            'completed'  => 'badge-secondary',
            default      => 'badge-light',
        };
    }

    // Mengubah status jadi teks yang user-friendly
    public function getStatusLabel(): string
    {
        return match ($this->status) {
            'pending'    => 'Menunggu Pickup',
            'in_process' => 'Sedang Diproses',
            'ready'      => 'Siap Diambil',
            'completed'  => 'Selesai',
            default      => $this->status,
        };
    }
}
