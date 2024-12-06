<?php

namespace App\Models\Payment;

use App\Models\User;
use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produk_id',
        'total_harga',
        'quantity',
        'status'
    ];

    /**
     * Define the relationship with the User model.
     *
     * An order belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define the relationship with the Product model.
     *
     * An order belongs to a product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }
}
