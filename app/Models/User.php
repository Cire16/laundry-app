<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Field yang boleh diisi (mass assigment)
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
    ];

    // Field yang disembunyikan (tidak ditampilkan)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // casting (auto ubah tipe data)
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', //jadi format tanggal
            'password' => 'hashed', // otomatis di-hash
        ];
    }

    // relasi: 1 user punya banyak order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // cek apakah user adalah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    //cek apakah user adalah customer
    public function isUser()
    {
        return $this->role === 'user';
    }
}
