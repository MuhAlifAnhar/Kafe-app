<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Payment\Order;
use App\Models\Payment\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Mengambil data produk dan kuantitas dari permintaan
        $productIds = $request->input('product_ids', []);
        $quantities = $request->input('quantities', []);

        // Validasi jumlah produk dan kuantitas
        // Pastikan bahwa kedua input adalah array dan memiliki jumlah elemen yang sama
        if (!is_array($productIds) || !is_array($quantities) || count($productIds) !== count($quantities)) {
            return redirect()->back()->with('error', 'Jumlah produk dan kuantitas tidak sesuai.');
        }

        // Inisialisasi variabel untuk menyimpan total harga dan transaksi
        $totalPrice = 0;
        $transactions = [];
        $itemDetails = []; // Array untuk menyimpan detail item

        // Loop melalui setiap produk untuk memproses transaksi
        foreach ($productIds as $index => $productId) {
            $quantity = $quantities[$index]; // Ambil kuantitas produk saat ini
            $order = Order::where('produk_id', $productId)
                ->where('user_id', Auth::user()->id)
                ->first(); // Cari order berdasarkan produk dan pengguna

            // Jika order tidak ditemukan, kembali dengan pesan kesalahan
            if (!$order) {
                return redirect()->back()->with('error', 'Order dengan produk_id ' . $productId . ' tidak ditemukan.');
            }

            // Jika kuantitas yang diminta melebihi stok, kembali dengan pesan kesalahan
            if ($order->quantity < $quantity) {
                return redirect()->back()->with('error', 'Jumlah kuantitas untuk produk_id ' . $productId . ' melebihi stok.');
            }

            // Ambil harga per unit produk
            $itemPrice = $order->product->price;
            $totalPrice += $itemPrice * $quantity; // Tambahkan ke total harga

            // Tambahkan detail item untuk Midtrans
            $itemDetails[] = [
                'id' => $productId,
                'price' => $itemPrice,
                'quantity' => $quantity,
                'name' => $order->product->name, // Nama produk
            ];

            // Buat transaksi baru
            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $itemPrice * $quantity,
                'status' => 'pending', // Set status awal sebagai 'pending'
            ]);

            $transactions[] = $transaction; // Tambahkan transaksi ke array transaksi

            // Kurangi kuantitas pada order
            $order->quantity -= $quantity;
            if ($order->quantity <= 0) {
                $order->delete(); // Hapus order jika kuantitas 0 atau kurang
            } else {
                $order->save(); // Simpan perubahan jika kuantitas masih tersisa
            }
        }

        // Konfigurasi pengaturan Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        // Siapkan parameter untuk transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(), // ID unik untuk setiap transaksi
                'gross_amount' => $totalPrice, // Jumlah total harga
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name, // Nama pelanggan
                'email' => Auth::user()->email, // Email pelanggan
            ],
            'item_details' => $itemDetails, // Detail item untuk Midtrans
        ];

        try {
            // Buat Snap Token untuk pembayaran dengan Midtrans
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan saat membuat Snap Token, kembali dengan pesan kesalahan
            return redirect()->back()->with('error', 'Gagal membuat Snap Token: ' . $e->getMessage());
        }

        // Simpan Snap Token ke dalam setiap transaksi yang dibuat
        foreach ($transactions as $transaction) {
            $transaction->snap_token = $snapToken;
            $transaction->save(); // Simpan transaksi dengan Snap Token
        }

        // Redirect ke halaman checkout dengan ID transaksi pertama
        return redirect()->route('checkout.show', ['transactionId' => $transactions[0]->id]);
    }



    public function showCheckout($transactionId)
    {
        $transaction = Transaction::find($transactionId);

        if (!$transaction) {
            return redirect()->route('landing')->with('error', 'Transaction not found.');
        }

        $product = $transaction->product;

        if (!$product) {
            return redirect()->route('landing')->with('error', 'Product not found for this transaction.');
        }

        // Calculate the total price based on quantity and price
        $totalPrice = $transaction->quantity * $product->price;

        return view('checkout', [
            'transaction' => $transaction,
            'product' => $product,
            'totalPrice' => $totalPrice,
        ]);
    }




    public function success($transactionId)
    {
        // Temukan transaksi berdasarkan ID
        $transaction = Transaction::find($transactionId);

        // Periksa apakah transaksi ditemukan
        if (!$transaction) {
            return redirect()->route('landing')->with('error', 'Transaction not found.');
        }

        // Perbarui status transaksi menjadi 'success'
        $transaction->status = 'success';
        $transaction->save();

        // Kembalikan tampilan 'success'
        return view('success');
    }
}
