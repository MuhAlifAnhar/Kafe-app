<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Models\Payment\OrderStatus;
use App\Models\Payment\Transaction;
use App\Http\Controllers\Controller;

class OrderStatusController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel transactions
        $transactions = Transaction::with('user', 'product') // Mengambil data pengguna dan produk terkait
            ->get();

        // Kirim data ke view
        return view('order_status.index', compact('transactions'));
    }

    public function create(Request $request, $id)
    {
        // Validasi input status dan status_pesanan
        $request->validate([
            'status' => 'required|in:pending,in_process,completed,failed',
            'status_pesanan' => 'required|in:not_shipped,shipped',
        ]);

        // Temukan transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Tambahkan data ke tabel order_status
        OrderStatus::create([
            'transaction_id' => $id, // ID transaksi
            'user' => $transaction->user->name ?? 'Unknown', // Nama pengguna atau nilai default
            'product' => $transaction->product->name ?? 'Unknown', // Nama produk atau nilai default
            'price' => $transaction->price,
            'quantity' => $transaction->quantity,
            'tanggal' => $transaction->created_at->format('Y-m-d'), // Format tanggal
            'status' => $transaction->status,
            'status_pesanan' => $request->input('status_pesanan'), // Status pesanan
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('order_status.index')->with('success', 'Data pesanan berhasil ditambahkan');
    }

    // File: app/Http/Controllers/OrderStatusController.php

    // public function updateStatusPengiriman(Request $request, $id)
    // {
    //     // Validasi input status pengiriman
    //     $request->validate([
    //         'status_pesanan' => 'required|in:not_shipped,shipped',
    //     ]);

    //     // Temukan OrderStatus berdasarkan ID
    //     $orderStatus = OrderStatus::where('transaction_id', $id)->firstOrFail();

    //     // Update status pengiriman
    //     $orderStatus->status_pesanan = $request->input('status_pesanan');
    //     $orderStatus->save();

    //     // Redirect dengan pesan sukses
    //     return redirect()->route('order_status.index')->with('success', 'Status pengiriman berhasil diperbarui');
    // }
}
