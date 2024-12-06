<?php

namespace App\Models\Payment;

use App\Models\Payment\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'order_statuses';

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'transaction_id',
        'user',
        'product',
        'price',
        'quantity',
        'tanggal',
        'status'
    ];

    // Jika Anda menggunakan timestamps, hapus baris berikut
    public $timestamps = false;

    // Definisikan relasi dengan model Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    // Definisikan aksesori untuk status dengan enum jika diperlukan
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Misalnya, mengubah status menjadi format kapitalisasi
    }
}
