<?php

namespace App\Http\Controllers\Payment;

use PDF;
use Illuminate\Http\Request;
use App\Models\Payment\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transactions = Transaction::with('product')->where('user_id', Auth::user()->id)->get();

        return view('transactions', compact('transactions'));
    }

    // Menampilkan laporan transaksi
    public function laporan()
    {
        $transactions = Transaction::with('product')->where('user_id', Auth::user()->id)->get();
        return view('laporan.index', compact('transactions'));
    }


    // Method untuk mencetak laporan dalam bentuk PDF
    public function cetakPDF()
    {
        $transactions = Transaction::with('product')->where('user_id', Auth::user()->id)->get();

        // Menyiapkan data untuk dikirim ke view PDF
        $data = [
            'title' => 'Laporan Transaksi',
            'date' => date('d F Y'),
            'transactions' => $transactions
        ];

        // Menggunakan package PDF untuk membuat PDF
        $pdf = PDF::loadView('laporan.pdf', $data);

        // Mengembalikan hasil PDF sebagai stream
        return $pdf->stream('Laporan Transaksi.pdf', ['Attachment' => false]);
    }

    // Method untuk menghasilkan invoice transaksi tertentu
    public function generateInvoice(Request $request)
    {
        $transactionId = $request->input('transaction_id');
        $transaction = Transaction::with('product')->find($transactionId);

        // Periksa apakah transaksi ditemukan
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Proses pembuatan invoice menggunakan PDF
        $pdf = PDF::loadView('laporan.invoice', compact('transaction'));

        return $pdf->download('invoice-' . $transaction->id . '.pdf');
    }
}
