<?php

namespace App\Models\Payment;

use App\Models\User;
use App\Models\Backend\Product;
use App\Models\Payment\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model, jika berbeda dari default (misalnya 'transactions')
    protected $table = 'transactions';

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'quantity',
        'status',
        'snap_token'
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Definisikan relasi dengan model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Definisikan relasi dengan model OrderStatus
    public function orderStatuses()
    {
        return $this->hasMany(OrderStatus::class, 'transaction_id');
    }
}
